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

            @if (session()->has('success'))
                <x-alert successMessage="{{ session('success') }}" />
            @elseif(session()->has('error'))
                <x-alert errorMessage="{{ session('error') }}" />
            @elseif(session()->has('info'))
                <x-alert infoMessage="{{ session('info') }}" />
            @endif

            <div class="w-100 px-5 pt-5 d-flex">
                <form action="{{ route('payroll.generate') }}" method="POST" class="row">
                    @method('POST')
                    @csrf
                    <h5>
                        <label for="job_position_id" class="form-label">Generate Payroll with AI Analysis and Error Salary
                            Detection</label>
                    </h5>
                    <div class="col-md-3">
                        <label for="job_position_id" class="form-label">Job Position</label>
                        <select name="job_position_id" id="job_position_id" class="form-select">
                            <option value="" selected>Select an option</option>
                            @foreach ($jobPositions as $jobPosition)
                                <option value="{{ $jobPosition->id }}">{{ $jobPosition->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="from" class="form-label">From</label>
                        <input type="date" name="from" id="from" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label for="to" class="form-label">To</label>
                        <input type="date" name="to" id="to" class="form-control" required>
                    </div>

                    <div class="col-md-5 mt-3">
                        <button type="submit" class="btn btn-sm btn-primary">Generate Payroll with AI response</button>
                    </div>
                </form>

                <div class="">
                    <button class="btn btn-secondary btn-sm d-flex w-full" onclick="printPayrollTable()">
                        <i class="tf-icons ti ti-printer"></i>
                        Print Payroll
                    </button>
                </div>
            </div>

            <div class="card-datatable table-responsive p-5" id="payroll-table-print">
                <table class="datatables-projects table border-top" id="dataTable">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Basic Salary Total</th>
                            <th>Regular OT Total</th>
                            <th>Rest Day OT Total</th>
                            <th>Total Deductions</th>
                            <th>Total Earnings</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($payrolls as $payroll)
                            @php
                                $from = Carbon\Carbon::parse($payroll->from);
                                $to = Carbon\Carbon::parse($payroll->to);
                                $fromText = $from->format('F d, Y');
                                $toText = $to->format('F d, Y');

                                $status = match (strtolower($payroll->status)) {
                                    'not started' => 'bg-warning text-white',
                                    'in progress' => 'bg-secondary text-white',
                                    'completed' => 'bg-success text-white',
                                    default => 'bg-default',
                                };
                            @endphp
                            <tr>
                                <td>{{ $payroll->employee->employee_code }}</td>
                                <td>{{ $payroll->employee->name }}</td>
                                <td>{{ $payroll->basic_salary_amount }}</td>
                                <td>{{ $payroll->reg_ot_amount }}</td>
                                <td>{{ $payroll->rd_ot_amount }}</td>
                                <td>{{ $payroll->total_deductions }}</td>
                                <td>{{ $payroll->total_earnings }}</td>
                                <td>
                                    <span>{{ $fromText }} to {{ $toText }}</sp>
                                </td>
                                <td>
                                    <span class="badge rounded {{ $status }}">{{ $payroll->status }}</span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button"
                                            id="dropdownMenuButton{{ $payroll->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <span class="tf-icons ti ti-dots-vertical" />
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $payroll->id }}">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('payroll-view', ['id' => $payroll->id]) }}"
                                                    data-bs-toggle="tooltip" title="View Payroll">
                                                    <span><i class="tf-icons ti ti-eye"></i></span> View Payroll
                                                </a>
                                            </li>
                                            <li>
                                                <form
                                                    action="{{ route('payroll-generate-payslip-to-ess', ['id' => $payroll->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="tf-icons ti ti-files"></i> Generate Payslip to ESS
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form
                                                    action="{{ route('payroll.generate-to-finance', ['id' => $payroll->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="tf-icons ti ti-receipt"></i> Generate Payroll Records to
                                                        Finance
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-success"
                                                    href="{{ route('payroll-edit', ['id' => $payroll->id]) }}"
                                                    data-bs-toggle="tooltip" title="Update Payroll">
                                                    <span><i class="tf-icons ti ti-edit"></i></span> Update Payroll
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-danger" href="#" data-toggle="modal"
                                                    data-target="#modal-{{ $payroll->id }}" data-bs-toggle="tooltip"
                                                    title="Delete Payroll">
                                                    <span><i class="tf-icons ti ti-trash"></i></span> Delete Payroll
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    {{-- MODAL FOR DELETE CONFIRMATION --}}
                                    <x-confirmation-modal action="{{ route('payroll-delete', ['id' => $payroll->id]) }}"
                                        title="Confirm Deletion" id="{{ $payroll->id }}" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>
        // DataTable
        $(document).ready(function() {
            new DataTable('#dataTable'); // Use the correct ID
        });

        function printPayrollTable() {
            const table = document.querySelector('#dataTable');
            const headers = table.querySelectorAll('thead tr th');
            const rows = table.querySelectorAll('tbody tr');

            let html = `
            <html>
                <head>
                    <title>Payroll Report</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            padding: 20px;
                        }

                        h2 {
                            text-align: center;
                        }

                        table {
                            width: 100%;
                            border-collapse: collapse;
                            margin-top: 20px;
                        }

                        th, td {
                            border: 1px solid #ccc;
                            padding: 8px;
                            text-align: left;
                            font-size: 14px;
                        }

                        th {
                            background-color: #f4f4f4;
                        }

                        .footer {
                            margin-top: 40px;
                            text-align: center;
                            font-size: 12px;
                            color: #666;
                        }
                    </style>
                </head>
                <body>
                    <h2>Payroll Report</h2>
                    <table>
                        <thead>
                            <tr>
        `;

            headers.forEach((th, index) => {
                if (index !== headers.length - 1) { // Skip the last header (Action)
                    html += `<th>${th.textContent}</th>`;
                }
            });

            html += `</tr></thead><tbody>`;

            rows.forEach(row => {
                html += `<tr>`;
                row.querySelectorAll('td').forEach((td, index) => {
                    if (index !== row.children.length - 1) { // Skip the last column (Action)
                        html += `<td>${td.textContent}</td>`;
                    }
                });
                html += `</tr>`;
            });

            html += `
                        </tbody>
                    </table>
                    <div class="footer">Generated on ${new Date().toLocaleDateString()}</div>
                </body>
            </html>
        `;

            const newWindow = window.open('', '', 'width=900,height=700');
            newWindow.document.write(html);
            newWindow.document.close();
            newWindow.focus();
            newWindow.print();
            newWindow.close();
        }
    </script>
@endsection
