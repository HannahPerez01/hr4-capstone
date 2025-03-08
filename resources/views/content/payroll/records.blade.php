<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
@extends('layouts/layoutMaster')
@section('title', 'DEDUCTION')
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
            <div class="card-datatable table-responsive">
                <table class="datatables-projects table border-top">
                    <thead>
                        <tr>

                            <th>Control No</th>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Basic Salary</th>
                            <th>Hourly Rate</th>
                            <th>Regular OT</th>
                            <th>RD OT</th>
                            <th>Pag-ibig Contribution</th>
                            <th>Philhealth Contribution</th>
                            <th>SSS Contribution Salary</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    {{-- <tbody>
                        @foreach($deduction as $claim)
                            <tr class="contents">
                                <td style="display:none;">{{ $claim->deduction_id }}</td>
                                <td>{{ $claim->employee_id }}</td>
                                <td>{{ $claim->pagibig}}</td>
                                <td>{{ $claim->philhealth}}</td>
                                <td>{{ $claim->sss}}</td>
                                <td>{{ $claim->created_at}}</td>
                                <td><button class=" btn btn-primary btn-sm  btn-flat" id="update_btn">Update</button></td>
                            </tr>
                        @endforeach
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>


    <div class="modal" tabindex="-1" role="dialog" id="smallModal">
        <div class="modal-dialog" role="document">
            <form action="{{url('/deduction')}}" id="formAuthentication" class="mb-3" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Deduction</h5>

                    </div>
                    <div class="modal-body">
                        <label>EMPLOYEE ID</label>
                        <div class="form-group">
                            <input type="text" name="employee_id" class="form-control">
                        </div>

                        <label>PAG IBIG CONTRIBUTION</label>
                        <div class="form-group">
                            <input type="number" name="pagibig" class="form-control">
                        </div>

                        <label>PHILHEALTH CONTRIBUTION</label>
                        <div class="form-group">
                            <input type="number" name="philhealth" class="form-control">
                        </div>

                        <label>SSS CONTRIBUTION</label>
                        <div class="form-group">
                            <input type="number" name="sss" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="SUBMIT" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-danger" id="modal_close">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal" tabindex="-1" role="dialog" id="update_deduction">
        <div class="modal-dialog" role="document">
            <form action="" id="formAuthentication" class="mb-3" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Deduction Update</h5>

                    </div>
                    <div class="modal-body">
                        <label>DEDUCTION ID</label>
                        <div class="form-group">
                            <input type="text" name="deduction_id" id="deduction_id" class="form-control">
                        </div>

                        <label>PAG IBIG CONTRIBUTION</label>
                        <div class="form-group">
                            <input type="number" name="pagibig_update" id="pagibig_update" class="form-control">
                        </div>

                        <label>PHILHEALTH CONTRIBUTION</label>
                        <div class="form-group">
                            <input type="number" name="philhealth_update" id="philhealth_update" class="form-control">
                        </div>

                        <label>SSS CONTRIBUTION</label>
                        <div class="form-group">
                            <input type="number" name="sss_update" id="sss_update" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="SUBMIT" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-danger" id="modal_close">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

<script type="text/javascript">
    $(document).on('click', '#modal_close', function () {
        $('#smallModal').modal('hide');

    });

    $(document).on('click', '#update_btn', function () {
        $('#update_deduction').modal('show');

        $('form')[0].reset();
        var tr = $(this).closest("tr").find('td');
        $('#deduction_id').val(tr.eq(0).text());
        $('#pagibig_update').val(tr.eq(2).text());
        $('#philhealth_update').val(tr.eq(3).text());
        $('#sss_update').val(tr.eq(4).text());
    });

    $(document).ready(function () {
        $('#myInput').keyup(function () {
            // Search text
            var text = $(this).val();
            // Hide all content class element
            $('.contents').hide();

            // Search
            $('.contents .titles:contains("' + text + '")').closest('.contents').show();
        });
    });
</script>
