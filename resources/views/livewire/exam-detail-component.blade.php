<div>
    <h1>Hello from Exam Details...</h1>
    {{-- {{ $examdetails }} --}}

    {{-- @foreach ($examdetails as $examdetail)
        {{ $examdetail->id }} 
        {{ $examdetail->exam->name }} 
        {{ $examdetail->examtype->name }} 
        {{ $examdetail->exammode->name }} 
        {{ $examdetail->myclass->name }} 
        {{ $examdetail->subject->name }}
        {{ $examdetail->full_mark }}  <br />
    @endforeach --}}

    {{-- @foreach ($myclasssections as $myclasssection)
        {{ $myclasssection->myclass->name }}
        {{ $myclasssection->section->name }}

        @foreach ($myclasssubjects as $myclasssubject)
            @if ($myclasssubject->myclass->id == $myclasssection->myclass->id)
                {{ $myclasssubject->subject->id }} ({{ $myclasssubject->id }}),
            @endif
        @endforeach

        <br />
    @endforeach --}}

    <table class="min-w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Sl</th>
                <th class="border border-gray-300 px-4 py-2">Class</th>
                <th class="border border-gray-300 px-4 py-2">Sections</th>
                <th class="border border-gray-300 px-4 py-2">Subjects</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($myclasses as $index => $myclass)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $myclass->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        @foreach ($myclasssections as $myclasssection)
                            @if ($myclasssection->myclass->id == $myclass->id)
                                {{ $myclasssection->section->name }}
                            @endif
                        @endforeach
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        @foreach($examtypes as $examtype)
                            <b>{{ $examtype->name }}</b>
                            {{$loop->iteration}}

                            
                            {{-- {{ $myclasssubjects->subject->name }} --}}
                            {{-- @php 
                            $subj = $myclasssubjects->map(function ( $item, int $key) {
                                return $item->examtype_id == $examtype->id;
                            });
                            @endphp --}}

                            {{-- *{{ $subj }}* --}}

                        @endforeach

                        @foreach ($myclasssubjects as $myclasssubject)
                            @if ($myclasssubject->myclass->id == $myclass->id)
                                {{ $myclasssubject->subject->name }},
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>



</div>
