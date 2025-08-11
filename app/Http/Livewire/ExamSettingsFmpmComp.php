<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exam06ClassSubject;
use App\Models\Myclass;
use App\Models\MyclassSubject;

use App\Models\Exam01Name;
use App\Models\Exam02Type;
use App\Models\Exam03Part;
use App\Models\Exam05Detail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ExamSettingsFmpmComp extends Component
{
    public $selectedClassId = null;

    // Simple arrays to avoid hydration issues
    public $fullMarks = [];
    public $passMarks = [];
    public $timeInMinutes = [];
    public $configIds = [];

    public $examConfigurations = [];

    // Protected properties to avoid serialization
    public $classes;
    protected $enabledConfigs = [];

    public function mount()
    {
        // Initialize arrays to prevent hydration issues
        $this->fullMarks = [];
        $this->passMarks = [];
        $this->timeInMinutes = [];
        $this->configIds = [];
        $this->examConfigurations = [];

        $this->classes = Myclass::where('is_active', true)->orderBy('id')->get();
    }

    public function getClassesProperty()
    {
        return Myclass::where('is_active', true)->orderBy('id')->get();
    }



    public function selectClass($classId)
    {
        try {
            $this->selectedClassId = $classId;
            $this->resetFormData();
            $this->loadExamConfigurations($classId);
        } catch (\Exception $e) {
            Log::error('Error selecting class: ' . $e->getMessage());
            session()->flash('error', 'Error loading class data: ' . $e->getMessage());
            $this->selectedClassId = null;
            $this->resetFormData();
        }
    }

    protected function resetFormData()
    {
        $this->fullMarks = [];
        $this->passMarks = [];
        $this->timeInMinutes = [];
        $this->configIds = [];
        $this->enabledConfigs = [];
        $this->examConfigurations = [];
    }

    protected function loadExamConfigurations($classId)
    {
        try {
            // Get only subjects that exist in Exam06ClassSubject for this class
            $configuredSubjectIds = Exam06ClassSubject::where('myclass_id', $classId)
                ->distinct()
                ->pluck('subject_id')
                ->toArray();

            if (empty($configuredSubjectIds)) {
                Log::info("No configured subjects found in Exam06ClassSubject for class ID: {$classId}");
                session()->flash('error', 'No subjects are configured for exams in this class. Please configure subjects first in Class Exam Subjects.');
                return;
            }

            // Get only the subjects that are configured in Exam06ClassSubject
            $classSubjects = MyclassSubject::with('subject')
                ->where('myclass_id', $classId)
                ->whereIn('subject_id', $configuredSubjectIds)
                ->where('is_active', true)
                ->orderBy('order_index', 'asc')
                ->get();

            if ($classSubjects->isEmpty()) {
                Log::info("No active subjects found for configured subject IDs in class ID: {$classId}");
                return;
            }

            // Get active exam configurations from Exam05Detail for this class
            $activeExamConfigs = Exam05Detail::where('myclass_id', $classId)
                ->where('is_active', true)
                ->get()
                ->keyBy(fn($item) => "{$item->exam_name_id}_{$item->exam_type_id}_{$item->exam_part_id}");
            // dd($activeExamConfigs);

            // Get existing Exam06ClassSubject configurations with exam detail relationship
            $existingConfigs = Exam06ClassSubject::with('examDetail')
                ->where('myclass_id', $classId)
                ->get()
                ->keyBy(fn($item) => $item->examDetail ?
                    "{$item->subject_id}_{$item->examDetail->exam_name_id}_{$item->examDetail->exam_type_id}_{$item->examDetail->exam_part_id}" :
                    null)
                ->filter(); // Remove null keys
            // dd("Class:". $classId .":". $activeExamConfigs->count() .":". $existingConfigs );
            Log::info("Found " . $classSubjects->count() . " subjects and " . $activeExamConfigs->count() . " active exam configs");

            foreach ($classSubjects as $classSubject) {
                $subjectId = $classSubject->subject_id;
                $this->examConfigurations[$subjectId] = [
                    'subject_id' => $classSubject->subject_id,
                    'subject_name' => $classSubject->subject->name ?? 'Unknown',
                    'class_subject_name' => $classSubject->name
                ];

                // Only load data for combinations that exist in both Exam05Detail AND Exam06ClassSubject
                foreach ($this->getAllExamNames() as $examName) {
                    foreach ($this->getAllExamTypes() as $examType) {
                        foreach ($this->getAllExamParts() as $examPart) {
                            $examConfigKey = "{$examName->id}_{$examType->id}_{$examPart->id}";
                            $flatKey = "{$subjectId}_{$examName->id}_{$examType->id}_{$examPart->id}";

                            // Only process if this combination exists in BOTH Exam05Detail AND Exam06ClassSubject
                            if (isset($activeExamConfigs[$examConfigKey]) && isset($existingConfigs[$flatKey])) {
                                $this->enabledConfigs[$flatKey] = true;

                                $config = $existingConfigs[$flatKey];
                                $this->fullMarks[$flatKey] = $config->full_marks ?? '';
                                $this->passMarks[$flatKey] = $config->pass_marks ?? '';
                                $this->timeInMinutes[$flatKey] = $config->time_in_minutes ?? '';
                                $this->configIds[$flatKey] = $config->id;
                            } else {
                                // Skip combinations that don't exist in Exam06ClassSubject
                                $this->enabledConfigs[$flatKey] = false;
                            }
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Error loading exam configurations: ' . $e->getMessage());
            session()->flash('error', 'Error loading exam configurations: ' . $e->getMessage());
        }
    }

    public function saveConfiguration($subjectId, $examNameId, $examTypeId, $examPartId)
    {
        // Add flash message to confirm method is called
        session()->flash('message', "Save method called with: Subject={$subjectId}, Exam={$examNameId}, Type={$examTypeId}, Part={$examPartId}");

        try {
            $flatKey = "{$subjectId}_{$examNameId}_{$examTypeId}_{$examPartId}";

            Log::info("Saving configuration for key: {$flatKey}");
            Log::info("Form data: ", [
                'fullMarks' => $this->fullMarks[$flatKey] ?? 'not set',
                'passMarks' => $this->passMarks[$flatKey] ?? 'not set',
                'timeInMinutes' => $this->timeInMinutes[$flatKey] ?? 'not set'
            ]);

            // Validation with specific error messages
            $errors = [];

            if (empty($this->fullMarks[$flatKey])) {
                $errors[] = 'Full Marks is required';
            }
            if (empty($this->passMarks[$flatKey])) {
                $errors[] = 'Pass Marks is required';
            }
            if (empty($this->timeInMinutes[$flatKey])) {
                $errors[] = 'Time in Minutes is required';
            }

            if (!empty($errors)) {
                session()->flash('error', 'Validation Error: ' . implode(', ', $errors) . '.');
                return;
            }

            $fullMarks = (int)$this->fullMarks[$flatKey];
            $passMarks = (int)$this->passMarks[$flatKey];
            $timeInMinutes = (int)$this->timeInMinutes[$flatKey];

            // Additional validation with specific messages
            if ($fullMarks <= 0) {
                session()->flash('error', 'Full Marks must be greater than 0.');
                return;
            }
            if ($passMarks <= 0) {
                session()->flash('error', 'Pass Marks must be greater than 0.');
                return;
            }
            if ($timeInMinutes <= 0) {
                session()->flash('error', 'Time must be greater than 0 minutes.');
                return;
            }

            if ($passMarks >= $fullMarks) {
                session()->flash('error', "Pass Marks ({$passMarks}) must be less than Full Marks ({$fullMarks}).");
                return;
            }

            if ($fullMarks > 1000) {
                session()->flash('error', 'Full Marks cannot exceed 1000.');
                return;
            }
            if ($passMarks > 1000) {
                session()->flash('error', 'Pass Marks cannot exceed 1000.');
                return;
            }
            if ($timeInMinutes > 600) {
                session()->flash('error', 'Time cannot exceed 600 minutes (10 hours).');
                return;
            }

            // Get the exam_detail_id from exam05_details table
            // First, find the exam detail record that matches our criteria
            $examDetail = Exam05Detail::where('myclass_id', $this->selectedClassId)
                ->where('exam_name_id', $examNameId)
                ->where('exam_type_id', $examTypeId)
                ->where('exam_part_id', $examPartId)
                ->where('is_active', true)
                ->first();

            if (!$examDetail) {
                session()->flash('error', 'No active exam configuration found for this combination. Please check Exam Details configuration.');
                return;
            }

            // Get related models for display name
            $subjectName = $this->examConfigurations[$subjectId]['subject_name'] ?? 'Unknown';
            $examName = Exam01Name::find($examNameId);
            $examType = Exam02Type::find($examTypeId);
            $examPart = Exam03Part::find($examPartId);

            if (!$examName || !$examType || !$examPart) {
                session()->flash('error', 'Invalid configuration data. Please refresh and try again.');
                return;
            }

            $configData = [
                'name' => "{$subjectName} - {$examName->name} - {$examType->name} - {$examPart->name}",
                'exam_detail_id' => $examDetail->id, // Reference to exam05_details
                'myclass_id' => $this->selectedClassId,
                'subject_id' => $subjectId,
                'full_marks' => $fullMarks,
                'pass_marks' => $passMarks,
                'time_in_minutes' => $timeInMinutes,
                'is_active' => true,
                'user_id' => auth()->id(),
                'session_id' => session('current_session_id', 1),
                'school_id' => session('current_school_id', 1),
            ];

            DB::beginTransaction();

            if ($this->configIds[$flatKey]) {
                // Update existing
                $config = Exam06ClassSubject::findOrFail($this->configIds[$flatKey]);
                $config->update($configData);
                Log::info("Updated configuration ID: {$config->id}");
                session()->flash('message', 'Configuration updated successfully!');
            } else {
                // Create new
                $newConfig = Exam06ClassSubject::create($configData);
                $this->configIds[$flatKey] = $newConfig->id;
                Log::info("Created new configuration ID: {$newConfig->id}");
                session()->flash('message', 'Configuration saved successfully!');
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving configuration: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            session()->flash('error', 'Error saving configuration: ' . $e->getMessage());
        }
    }

    public function deleteConfiguration($subjectId, $examNameId, $examTypeId, $examPartId)
    {
        try {
            $flatKey = "{$subjectId}_{$examNameId}_{$examTypeId}_{$examPartId}";

            if ($this->configIds[$flatKey]) {
                DB::beginTransaction();

                $config = Exam06ClassSubject::findOrFail($this->configIds[$flatKey]);
                $config->delete();

                // Reset form data
                $this->fullMarks[$flatKey] = '';
                $this->passMarks[$flatKey] = '';
                $this->timeInMinutes[$flatKey] = '';
                $this->configIds[$flatKey] = null;

                DB::commit();

                Log::info("Deleted configuration ID: {$config->id}");
                session()->flash('message', 'Configuration deleted successfully!');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting configuration: ' . $e->getMessage());
            session()->flash('error', 'Error deleting configuration: ' . $e->getMessage());
        }
    }



    public function getAllExamNames()
    {
        try {
            return Exam01Name::orderBy('name')->get();
        } catch (\Exception $e) {
            Log::error('Error getting exam names: ' . $e->getMessage());
            return collect();
        }
    }

    public function getAllExamTypes()
    {
        try {
            return Exam02Type::orderBy('name')->get();
        } catch (\Exception $e) {
            Log::error('Error getting exam types: ' . $e->getMessage());
            return collect();
        }
    }

    public function getAllExamParts()
    {
        try {
            return Exam03Part::orderBy('name')->get();
        } catch (\Exception $e) {
            Log::error('Error getting exam parts: ' . $e->getMessage());
            return collect();
        }
    }

    public function getActiveExamConfigurations()
    {
        if (!$this->selectedClassId) {
            return collect();
        }

        try {
            return Exam05Detail::where('myclass_id', $this->selectedClassId)
                ->where('is_active', true)
                ->get()
                ->keyBy(fn($item) => "{$item->exam_name_id}_{$item->exam_type_id}_{$item->exam_part_id}");
        } catch (\Exception $e) {
            Log::error('Error getting active exam configurations: ' . $e->getMessage());
            return collect();
        }
    }

    public function isConfigurationEnabled($examNameId, $examTypeId, $examPartId)
    {
        $activeConfigs = $this->getActiveExamConfigurations();
        $key = "{$examNameId}_{$examTypeId}_{$examPartId}";
        return $activeConfigs->has($key);
    }

    public function checkDatabaseConnection()
    {
        try {
            DB::select('SELECT 1');
            session()->flash('message', 'Database connection successful!');
        } catch (\Exception $e) {
            session()->flash('error', 'Database connection failed: ' . $e->getMessage());
        }
    }

    public function testSave()
    {
        try {
            $testData = [
                'name' => 'Test Configuration',
                'myclass_id' => 1,
                'subject_id' => 1,
                'exam_name_id' => 1,
                'exam_type_id' => 1,
                'exam_part_id' => 1,
                'full_marks' => 100,
                'pass_marks' => 40,
                'time_in_minutes' => 60,
                'is_active' => true,
                'user_id' => auth()->id() ?? 1,
                'session_id' => 1,
                'school_id' => 1,
            ];

            $config = Exam06ClassSubject::create($testData);
            session()->flash('message', "Test save successful! Created ID: {$config->id}");

            // Clean up test data
            $config->delete();
        } catch (\Exception $e) {
            Log::error('Test save failed: ' . $e->getMessage());
            session()->flash('error', 'Test save failed: ' . $e->getMessage());
        }
    }

    public function debugSave($subjectId, $examNameId, $examTypeId, $examPartId)
    {
        $flatKey = "{$subjectId}_{$examNameId}_{$examTypeId}_{$examPartId}";

        session()->flash('message', "Debug Save Called! Key: {$flatKey}, Data: FM=" . ($this->fullMarks[$flatKey] ?? 'null') . ", PM=" . ($this->passMarks[$flatKey] ?? 'null') . ", Time=" . ($this->timeInMinutes[$flatKey] ?? 'null'));
    }

    public function hasData($subjectId, $examNameId, $examTypeId, $examPartId)
    {
        $flatKey = "{$subjectId}_{$examNameId}_{$examTypeId}_{$examPartId}";

        $fullMarks = $this->fullMarks[$flatKey] ?? '';
        $passMarks = $this->passMarks[$flatKey] ?? '';
        $timeInMinutes = $this->timeInMinutes[$flatKey] ?? '';

        return !empty($fullMarks) || !empty($passMarks) || !empty($timeInMinutes);
    }

    public function hasAnyDataForExamCombination($examNameId, $examTypeId, $examPartId)
    {
        if (!is_array($this->examConfigurations)) {
            return false;
        }

        $activeConfigs = $this->getActiveExamConfigurations();
        $configKey = "{$examNameId}_{$examTypeId}_{$examPartId}";

        // First check if this exam combination is enabled
        if (!isset($activeConfigs[$configKey])) {
            return false;
        }

        // Check if any subject has data or existing config for this combination
        foreach (array_keys($this->examConfigurations) as $subjectId) {
            $flatKey = "{$subjectId}_{$examNameId}_{$examTypeId}_{$examPartId}";

            // Check if has data or existing config
            if (
                $this->hasData($subjectId, $examNameId, $examTypeId, $examPartId) ||
                isset($this->configIds[$flatKey])
            ) {
                return true;
            }
        }

        return false;
    }

    public function testClick()
    {
        session()->flash('message', 'Test Click Method Called Successfully!');
    }

    public function testDataLoad()
    {
        $message = "Data Load Test: ";
        $message .= "FullMarks count: " . count($this->fullMarks) . ", ";
        $message .= "PassMarks count: " . count($this->passMarks) . ", ";
        $message .= "TimeInMinutes count: " . count($this->timeInMinutes) . ", ";
        $message .= "ConfigIds count: " . count($this->configIds);

        session()->flash('message', $message);
    }

    public function refreshData()
    {
        try {
            $this->resetFormData();
            if ($this->selectedClassId) {
                $this->loadExamConfigurations($this->selectedClassId);
            }
            session()->flash('message', 'Data refreshed successfully!');
        } catch (\Exception $e) {
            Log::error('Error refreshing data: ' . $e->getMessage());
            session()->flash('error', 'Error refreshing data: ' . $e->getMessage());
        }
    }

    public function updatedFullMarks($value, $key)
    {
        // dd('Val:',$value, 'K:',$key);
        // Ensure the value is properly set
        if ($value !== null && $value !== '') {
            $this->fullMarks[$key] = $value;
        }
    }

    public function updatedPassMarks($value, $key)
    {
        // Ensure the value is properly set
        if ($value !== null && $value !== '') {
            $this->passMarks[$key] = $value;
        }
    }

    public function updatedTimeInMinutes($value, $key)
    {
        // Ensure the value is properly set
        if ($value !== null && $value !== '') {
            $this->timeInMinutes[$key] = $value;
        }
    }

    public function hydrate()
    {
        // Ensure arrays are properly initialized after hydration
        if (!is_array($this->fullMarks)) {
            $this->fullMarks = [];
        }
        if (!is_array($this->passMarks)) {
            $this->passMarks = [];
        }
        if (!is_array($this->timeInMinutes)) {
            $this->timeInMinutes = [];
        }
        if (!is_array($this->configIds)) {
            $this->configIds = [];
        }
        if (!is_array($this->examConfigurations)) {
            $this->examConfigurations = [];
        }
    }

    public function render()
    {
        // Ensure examConfigurations is always an array
        if (!is_array($this->examConfigurations)) {
            $this->examConfigurations = [];
        }

        return view('livewire.exam-settings-fmpm-comp', [
            'examNames' => $this->getAllExamNames(),
            'examTypes' => $this->getAllExamTypes(),
            'examParts' => $this->getAllExamParts(),
            'activeExamConfigs' => $this->getActiveExamConfigurations()
        ]);
    }
}
