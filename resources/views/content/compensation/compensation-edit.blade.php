<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">

@extends('layouts/layoutMaster')
@section('title', 'COMPENSATION')
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
    <div class="">
        <div class="card">
            <div class="pt-5 px-5">
                <button class="btn btn-dark btn-sm" onclick="location.href = '{{ route('compensation') }}'">Back</button>
            </div>

            <div class="card-datatable">
                <div class="p-5">
                    <form action="{{ route('compensation-update', ['id' => $compensation->compensation_id]) }}"
                        method="POST" class="row">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <label for="employee_id" class="form-label">Employee</label>
                            <select name="employee_id" id="employee_id" class="form-select" required>
                                <option value="{{ $compensation->employee_id }}" selected>
                                    {{ $compensation->employee->employee_name }}</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->employee_id }}">{{ $employee->employee_name }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('employee_id'))
                                <div class="text-danger">
                                    {{ $errors->first('employee_id') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Salary Details</label>
                            <input type="text" name="date_hired" id="date_hired" class="form-control"
                                value="{{ old('date_hired') }}" required disabled>

                            @if ($errors->has('date_hired'))
                                <div class="text-danger">
                                    {{ $errors->first('date_hired') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="" class="form-label">Duration</label>
                            <input type="date" name="date_hired" id="date_hired" class="form-control"
                                value="{{ old('date_hired') }}" required disabled>

                            @if ($errors->has('date_hired'))
                                <div class="text-danger">
                                    {{ $errors->first('date_hired') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="transaction" class="form-label">Transaction</label>
                            <select name="transaction" id="transaction" class="form-select" required>
                                <option value="{{ $compensation->transaction_type }}" selected>
                                    {{ $compensation->transaction_type }}</option>
                                @foreach ($transactionTypeEnums as $transactionTypeEnum)
                                    <option value="{{ $transactionTypeEnum }}">{{ $transactionTypeEnum }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('transaction'))
                                <div class="text-danger">
                                    {{ $errors->first('transaction') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="{{ $compensation->status }}" selected>{{ $compensation->status }}</option>
                                @foreach ($statusEnums as $statusEnum)
                                    <option value="{{ $statusEnum }}">{{ $statusEnum }}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('status'))
                                <div class="text-danger">
                                    {{ $errors->first('status') }}
                                </div>
                            @endif
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datat ables.net/2.1.8/js/dataTables.js"></script>
<script>
    // DataTable
    $(document).ready(function () {
        new DataTable('#dataTable'); // Use the correct ID
    });

    $(document).on('click', '#modal_close', function () {
        $('#smallModal').modal('hide');

    });
</script>
