<?php
namespace App\Services;

use App\Enum\EmployeeGenderEnum;
use App\Models\Employee;
use App\Models\HRAnalytic;
use App\Models\JobPosition;
use App\Traits\DashboardTrait;

class DashboardService
{
    use DashboardTrait;

    public HRAnalytic $model;
    public Employee $employee;
    public JobPosition $jobPosition;

    public function __construct(HRAnalytic $model, Employee $employee, JobPosition $jobPosition)
    {
        $this->model       = $model;
        $this->employee    = $employee;
        $this->jobPosition = $jobPosition;
    }

    public function getEmployeeGenderCount()
    {
        $employeesMaleCount   = $this->employee->query()->where('gender', EmployeeGenderEnum::MALE->value)->count();
        $employeesFemaleCount = $this->employee->query()->where('gender', EmployeeGenderEnum::FEMALE->value)->count();
        $employeeGenderCount  = [$employeesMaleCount, $employeesFemaleCount];

        return $this->generatePieChart(['Male', 'Female'], $employeeGenderCount, 'Employees by Gender');
    }

    public function getAnnualTurnoverRate()
    {
        $year = now()->year;

        $employeesLeft = $this->employee->whereYear('resigned_at', $year)->count();

        $startOfYearEmployees = $this->employee->whereDate('date_hired', '<=', "$year-01-01")->count();
        $endOfYearEmployees   = $this->employee->whereDate('date_hired', '<=', "$year-12-31")->count();
        $averageEmployees     = ($startOfYearEmployees + $endOfYearEmployees) / 2;
        $annualTurnoverRate   = ($employeesLeft / max($averageEmployees, 1)) * 100;

        return $annualTurnoverRate;
    }

    public function getOverallTurnoverRate()
    {
        $totalEmployeesLeft = $this->employee->whereNotNull('resigned_at')->count();

        $totalEmployeesHired = $this->employee->count();

        $overallTurnoverRate = ($totalEmployeesLeft / max($totalEmployeesHired, 1)) * 100;

        return $overallTurnoverRate;
    }

    public function getEmployeeAgeCategoy()
    {
        $ageCategories = [
            '18 - 29' => [18, 29],
            '30 - 39' => [30, 39],
            '40 - 49' => [40, 49],
            '50 - 59' => [50, 59],
            '> 60'    => [60, 100],
        ];

        // Get total employees count for percentage calculation
        $totalEmployees = $this->employee->count();

        // Get age category counts
        $ageCounts = $this->employee->selectRaw("
                CASE
                    WHEN age BETWEEN 18 AND 29 THEN '18 - 29'
                    WHEN age BETWEEN 30 AND 39 THEN '30 - 39'
                    WHEN age BETWEEN 40 AND 49 THEN '40 - 49'
                    WHEN age BETWEEN 50 AND 59 THEN '50 - 59'
                    WHEN age >= 60 THEN '> 60'
                END as age_category, COUNT(*) as count
            ")
            ->groupBy('age_category')
            ->pluck('count', 'age_category')
            ->toArray();

        // Ensure all age categories exist in the result
        $ageData = [];
        foreach ($ageCategories as $label => $range) {
            $ageData[] = round(($ageCounts[$label] ?? 0) / max($totalEmployees, 1) * 100, 1); // Convert to percentage
        }

        // Get average age
        $averageAge = $this->employee->avg('age');

        // Generate chart
        return $this->generateBarChart(
            array_keys($ageCategories), // Labels
            $ageData,                   // Dataset (percentage values)
            'Employees by Age Category'
        );
    }

    public function getEmployeeByDepartment()
    {
        $departmentCounts = $this->employee->query()
            ->selectRaw('department, COUNT(*) as count')
            ->groupBy('department')
            ->orderByDesc('count') // Sort from highest to lowest
            ->pluck('count', 'department')
            ->toArray();

        $departmentLabels = array_keys($departmentCounts);
        $departmentData   = array_values($departmentCounts);

        return $this->generateBarChart(
            $departmentLabels,
            $departmentData,
            'Employees by Department',
            true
        );
    }

    public function getEmployeeByPosition()
    {
        $positionCounts = $this->jobPosition->query()
            ->leftJoin('employees', 'employees.job_position_id', '=', 'job_positions.id')
            ->selectRaw('job_positions.title as position, COUNT(employees.id) as count')
            ->groupBy('job_positions.title')
            ->orderByDesc('count')
            ->pluck('count', 'position')
            ->toArray();

        $positionLabels = array_keys($positionCounts);
        $positionData   = array_values($positionCounts);

        return $this->generateBarChart(
            $positionLabels,
            $positionData,
            'Employees by Position'
        );

    }

    public function getEmployeeGrowthOvertime()
    {
        $growthData = $this->employee->query()
            ->selectRaw('YEAR(date_hired) as year, COUNT(*) as count')
            ->groupBy('year')
            ->orderBy('year')
            ->pluck('count', 'year')
            ->toArray();

        $years  = array_keys($growthData);
        $counts = array_values($growthData);

        return $this->generateLineChart(
            $years,  // Labels (Years)
            $counts, // Dataset (Employee count)
            'Employee Growth over Time'
        );
    }
}
