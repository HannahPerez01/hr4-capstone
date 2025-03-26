@extends('layouts/layoutMaster')
@section('title', 'Recruitment')
@section('vendor-style')
    @vite('resources/assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.scss')
@endsection

@section('page-style')
    @vite('resources/assets/vendor/scss/pages/app-chat.scss')
@endsection

@section('vendor-script')
    @vite('resources/assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js')
@endsection
@section('page-script')
    @vite('resources/assets/js/app-chat.js')
@endsection
@section('content')

    <div class="card">
        <div class="card">
            <div>
                <button type="button" class="btn btn-dark btn-sm m-5"
                    onclick="location.href = '{{ route('recruitment') }}'">Back</button>
            </div>

            <div class="card-datatable p-5">
                <form action="{{ route('recruitment-store') }}" method="POST" class="form-group row">
                    @method('POST')
                    @csrf

                    <div class="col-md-6">
                        <label for="" class="form-label">Job Title</label>
                        <input type="text" name="job_title" id="job_title" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="" class="form-label">Department</label>
                        <select id="department" name="department" class="form-select" required>
                            <option value="">Select an option</option>
                            @foreach ($departmentEnums as $departmentEnum)
                                <option value="{{ $departmentEnum }}">{{ $departmentEnum }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mt-5">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
