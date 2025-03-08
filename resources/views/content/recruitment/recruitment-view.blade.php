<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


@extends('layouts/layoutMaster')
@section('title', 'Payroll')
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
            <div style="display:flex;">
                <button class="btn  btn-primary btn-sm btn-flat m-3 " style="font-size:15px;width:15%;height:38px;"
                    id="open_modal"><i class="fas fa-plus-square"></i>Create Jobroles</button>

                <form class=" mt-3 ml-3 mw-100 navbar-search" style="margin-left:7px" autocomplete="off">
                    <div class="input-group">
                        <input type="text" id="myInput" onkeyup="myFunction()"
                            class="form-control bg-light border-1 small" placeholder="Search for..." aria-label="Search"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" style="height:40px;">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-datatable table-responsive">
                <table class="datatables-projects table border-top">
                    <thead>
                        <tr>
                            <th>JOB ROLES NEEDED</th>
                            <th>DEPARTMENT</th>
                            <td>SALARY</td>
                            <td>SCHEDULE</td>
                            <th>STATUS</th>
                            <th>DATE REQUEST</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Recruite as $row)
                            <tr class="contents">
                                <td style="display:none;">{{ $row->recruitment_id }}</td>
                                <td class="titles">{{ $row->jobrole }}</td>
                                <td>{{ $row->department }}</td>
                                <td>{{ $row->salary }}</td>
                                <td>{{ $row->time }}</td>
                                <td><span class="badge bg-danger">{{ $row->status }}</span></td>
                                <td>{{ $row->created_at }}</td>
                                <td style="display:flex;">
                                    <?php    $check = $row->status;
                            if (empty($check)) {?>
                                    <form method="POST" action="{{ route('Recruiteupdate') }}" class="p-0 m-0">
                                        @csrf
                                        @method('POST')
                                        <input type="type" name="recruitment_id_insert"
                                            value="{{ $row->recruitment_id }}" style="display:none;">
                                        <input type="type" name="status_insert" value="pending" style="display:none;">
                                        <button type="submit" name="submit" class=" btn btn-primary btn-sm  btn-flat m-0"
                                            id="update_btn">REQUEST</button>
                                    </form>
                                    <?php    } else {?>
                                    <?php    }?>
                                    <button class=" btn btn-primary btn-sm  btn-flat " id="update_recruitment"
                                        style="
                            margin-left: 5px;">UPDATE</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="modal" tabindex="-1" role="dialog" id="recruitement_modal">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/recruitment') }}" id="formAuthentication" class="mb-3" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">REQUEST JOB ROLES</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Job Roles</label>
                                <input type="text" class="form-control" name="jobrole">
                            </div>
                            <div class="form-group">
                                <label>Department</label>
                                <select class="form-control" name="department">
                                    <option>Logistic Department</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Salary</label>
                                <input type="number" class="form-control" name="salary">
                            </div>
                            <div class="form-group">
                                <label>Salary</label>
                                <input type="text" class="form-control" name="time">
                            </div>
                            <div class="modal-footer">
                                <button type="SUBMIT" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-danger" id="modal_close">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal" tabindex="-1" role="dialog" id="updating_recruitment">
            <div class="modal-dialog" role="document">
                <form action="{{ url('/recruitment_update') }}" id="formAuthentication" class="mb-3" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">REQUEST JOB ROLES UPDATE</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Job Roles</label>
                                <input type="text" class="form-control" name="recruitment_id_update"
                                    id="recruitment_id_update" style="display:none;">
                                <input type="text" class="form-control" name="jobrole_update" id="jobrole_update">
                            </div>
                            <div class="form-group">
                                <label>Department</label>
                                <select class="form-control" name="department_update" id="department_update">
                                    <option>Logistic Department</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Salary</label>
                                <input type="text" class="form-control" name="salary_update" id="salary_update">
                            </div>
                            <div class="form-group">
                                <label>Time</label>
                                <input type="text" class="form-control" name="time_update" id="time_update">
                            </div>

                            <input type="text" value="pending" style="display:none;" name="status">
                            <div class="modal-footer">
                                <button type="SUBMIT" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-danger" id="close_update">Close</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>


    @endsection


    <script>
        $(document).on('click', '#update_recruitment', function() {
            $('#updating_recruitment').modal('show');
            $('form')[0].reset();
            var tr = $(this).closest("tr").find('td');
            $('#employee_id').val(tr.eq(1).text());
            var f = tr.eq(2).text();
            $('#department_update').val(f.trim()).change();
            $('#jobrole_update').val(tr.eq(1).text());
            $('#salary_update').val(tr.eq(3).text());
            $('#time_update').val(tr.eq(4).text());
            $('#recruitment_id_update').val(tr.eq(0).text());
        })
        $(document).on('click', '#close_update', function() {
            $('#updating_recruitment').modal('hide');
        });
    </script>

    <script>
        $(document).on('click', '#open_modal', function() {
            $('#recruitement_modal').modal('show');
        });
        $(document).on('click', '#modal_close', function() {
            $('#recruitement_modal').modal('hide');
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myInput').keyup(function() {
                // Search text
                var text = $(this).val();
                // Hide all content class element
                $('.contents').hide();
                // Search
                $('.contents .titles:contains("' + text + '")').closest('.contents').show();
            });
        });
    </script>
