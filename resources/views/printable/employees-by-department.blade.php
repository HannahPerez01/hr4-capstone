<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">List of Employees by Department</h2>
    </div>

    @foreach ($data as $department => $employees)
        <div class="border p-5">
            <h4 class="mt-4">{{ ucfirst($department) }}</h4>
            <div class="table-responsive border rounded-3" style="border-color: #000000;">
                <table class="table table-bordered table-striped table-hover align-middle text-center small">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-start">Employee ID</th>
                            <th class="text-start">Name</th>
                            <th class="text-start">Email</th>
                            <th class="text-start">Gender</th>
                            <th class="text-start">Age</th>
                            <th class="text-start">Civil Status</th>
                            <th class="text-start">Position</th>
                            <th class="text-start">Employment Type</th>
                            <th class="text-start">Date Hired</th>
                            <th class="text-start">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr style="font-size: 12px;">
                                <td>{{ $employee?->employee_code }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->gender }}</td>
                                <td>{{ $employee->age }}</td>
                                <td>{{ $employee->civil_status }}</td>
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
    @endforeach
</div>

<script>
    window.onafterprint = () => {
        history.back();
    };

    window.print();
</script>