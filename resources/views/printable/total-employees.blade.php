<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">List of Employees</h2>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover align-middle text-center small">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Age</th>
                    <th scope="col">Civil Status</th>
                    <th scope="col">Present Address</th>
                    <th scope="col">Department</th>
                    <th scope="col">Position</th>
                    <th scope="col">Employment Type</th>
                    <th scope="col">Date Hired</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $employee)
                    <tr>
                        <td>{{ $employee->employee_code }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->gender }}</td>
                        <td>{{ $employee->age }}</td>
                        <td>{{ $employee->civil_status }}</td>
                        <td>{{ $employee->present_address }}</td>
                        <td>{{ $employee->department }}</td>
                        <td>{{ $employee->jobPosition->title }}</td>
                        <td>{{ $employee->employment_type }}</td>
                        <td>{{ \Carbon\Carbon::parse($employee->date_hired)->format('M d, Y') }}</td>
                        <td>
                            <span class="badge bg-{{ $employee->status === 'Active' ? 'success' : 'secondary' }}">
                                {{ $employee->status }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    window.onafterprint = () => {
        history.back();
    };

    window.print();
</script>
