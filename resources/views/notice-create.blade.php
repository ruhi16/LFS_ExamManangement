<div>

    @if (session('status'))
        <div class="alert alert-success">{{session('status')}}</div>
    @endif

    auth:{{ auth()->user()->role_id }}
            
    <form action="{{ url('notices/create') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <lable>Title</lable>
            <input type="text" name="title" class="" value="{{ old('title') }}" />
            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div>
            <lable>Description</lable>
            <textarea type="text" name="desc" class="" rows="3">{{ old('desc') }}</textarea>
            @error('desc') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div>
            <lable>Date of PUblication</lable>
            <input type="date" name="dop" class="" />
            @error('dop') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div>
            <lable>Date of Expire</lable>
            <input type="date" name="doe" class="" />
            @error('doe') <span class="text-danger">{{ $message }}</span> @enderror
        </div>




        <div>
            <lable>Image</lable>
            <input type="file" name="fileaddr" class="" />
            <!-- @error('fileaddr') <span class="text-danger">{{ $message }}</span> @enderror -->
        </div>


        <div>
            <lable>Status(Active ? or Not)</lable>
            <input type="checkbox" name="is_active" class="" {{ old('is_active') == true ? checked:'' }}/>
            @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div>
            <button type="submit">Save</button>
        </div>

    </form>


</div>