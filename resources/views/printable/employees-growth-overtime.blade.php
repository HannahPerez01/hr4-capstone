<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Employee Growth Over Time</h2>
    </div>

    @foreach ($data as $growthOverTime => $employees)
        <div class="border p-5">
            <h4 class="mt-4">{{ ucfirst($growthOverTime) }}</h4>
            <div class="table-responsive border rounded-3" style="border-color: #000000;">
                <table class="table table-bordered table-striped table-hover align-middle text-center small">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-start">Employee ID</th>
                            <th class="text-start">Name</th>
                            <th class="text-start">Date Hired</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr style="font-size: 12px;">
                                <td>{{ $employee?->employee_code }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($employee->date_hired)->format('M d, Y') }}</td>
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