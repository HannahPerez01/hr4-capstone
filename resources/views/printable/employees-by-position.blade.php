<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">List of Employees by Position</h2>
    </div>

    @foreach ($data as $position => $employees)
        <div class="border p-5">
            <h4 class="mt-4">{{ ucfirst($position) }}</h4>
            <div class="table-responsive border rounded-3" style="border-color: #000000;">
                <table class="table table-bordered table-striped table-hover align-middle text-center small">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-start">Employee ID</th>
                            <th class="text-start">Name</th>
                            <th class="text-start">Email</th>
                            <th class="text-start">Age</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr style="font-size: 12px;">
                                <td>{{ $employee?->employee_code }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->age }}</td>
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