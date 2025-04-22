<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Dashboard PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2 {
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        td,
        th {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .section-title {
            background-color: #f2f2f2;
            padding: 8px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h2>Dashboard Summary</h2>

    <table>
        <tr>
            <th>Metric</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>Total Employees</td>
            <td>{{ $data['employeesCount'] }}</td>
        </tr>
        <tr>
            <td>Annual Turnover Rate</td>
            <td>{{ $data['annualTurnOverRate'] }}%</td>
        </tr>
        <tr>
            <td>Overall Turnover Rate</td>
            <td>{{ $data['overallTurnOverRate'] }}%</td>
        </tr>
    </table>

    <div class="section-title">Employees by Gender</div>
    <table>
        @foreach ($data['employeesCountChart']->labels as $index => $label)
            <tr>
                <td>{{ $label }}</td>
                <td>{{ $data['employeesCountChart']->datasets[0]->values[$index] }}</td>
            </tr>
        @endforeach
    </table>

    <div class="section-title">Employees by Age Category</div>
    <table>
        @foreach ($data['employeesAgeCategoryChart']->labels as $index => $label)
            <tr>
                <td>{{ $label }}</td>
                <td>{{ $data['employeesAgeCategoryChart']->datasets[0]->values[$index] }}</td>
            </tr>
        @endforeach
    </table>

    <div class="section-title">Employees by Department</div>
    <table>
        @foreach ($data['employeesDepartmentChart']->labels as $index => $label)
            <tr>
                <td>{{ $label }}</td>
                <td>{{ $data['employeesDepartmentChart']->datasets[0]->values[$index] }}</td>
            </tr>
        @endforeach
    </table>

    <div class="section-title">Employees by Position</div>
    <table>
        @foreach ($data['employeesByPositionChart']->labels as $index => $label)
            <tr>
                <td>{{ $label }}</td>
                <td>{{ $data['employeesByPositionChart']->datasets[0]->values[$index] }}</td>
            </tr>
        @endforeach
    </table>

    <div class="section-title">Employee Growth Overtime</div>
    <table>
        @foreach ($data['employeesGrowthOvertime']->labels as $index => $label)
            <tr>
                <td>{{ $label }}</td>
                <td>{{ $data['employeesGrowthOvertime']->datasets[0]->values[$index] }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
