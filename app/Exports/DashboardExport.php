<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class DashboardExport implements FromCollection
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // dd($this->data['employeesAgeCategoryChart']);
        return collect([
            ['Metric', 'Value'],

            ['Total Employees', $this->data['employeesCount']],
            ['Annual Turnover Rate (%)', $this->data['annualTurnOverRate']],
            ['Overall Turnover Rate (%)', $this->data['overallTurnOverRate']],

            ['---', '---'],
            ['Employees by Gender', ''],

            ...collect($this->data['employeesCountChart']->labels)->map(function ($label, $index) {
                return [$label, $this->data['employeesCountChart']->datasets[0]->values[$index]];
            })->toArray(),

            ['---', '---'],
            ['Employees by Age Category', ''],

            ...collect($this->data['employeesAgeCategoryChart']->labels)->map(function ($label, $index) {
                return [$label, $this->data['employeesAgeCategoryChart']->datasets[0]->values[$index]];
            })->toArray(),

            ['---', '---'],
            ['Employees by Department', ''],

            ...collect($this->data['employeesDepartmentChart']->labels)->map(function ($label, $index) {
                return [$label, $this->data['employeesDepartmentChart']->datasets[0]->values[$index]];
            })->toArray(),

            ['---', '---'],
            ['Employees by Position', ''],

            ...collect($this->data['employeesByPositionChart']->labels)->map(function ($label, $index) {
                return [$label, $this->data['employeesByPositionChart']->datasets[0]->values[$index]];
            })->toArray(),

            ['---', '---'],
            ['Employee Growth Overtime', ''],

            ...collect($this->data['employeesGrowthOvertime']->labels)->map(function ($label, $index) {
                return [$label, $this->data['employeesGrowthOvertime']->datasets[0]->values[$index]];
            })->toArray(),
        ]);
    }
}
