<?php
namespace App\Http\Controllers;

use App\Exports\DashboardExport;
use App\Models\Employee;
use App\Services\DashboardService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HRAnalyticsController extends Controller
{
    public DashboardService $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $employeesCount            = Employee::query()->count();
        $annualTurnOverRate        = $this->dashboardService->getAnnualTurnoverRate();
        $overallTurnOverRate       = $this->dashboardService->getOverallTurnoverRate();
        $employeesCountChart       = $this->dashboardService->getEmployeeGenderCount();
        $employeesAgeCategoryChart = $this->dashboardService->getEmployeeAgeCategoy();
        $employeesDepartmentChart  = $this->dashboardService->getEmployeeByDepartment();
        $employeesByPositionChart  = $this->dashboardService->getEmployeeByPosition();
        $employeesGrowthOvertime   = $this->dashboardService->getEmployeeGrowthOvertime();

        return view('content.dashboard.hr-analytics-index', [
            'employeesCount'            => $employeesCount,
            'annualTurnOverRate'        => $annualTurnOverRate,
            'overallTurnOverRate'       => $overallTurnOverRate,
            'employeesCountChart'       => $employeesCountChart,
            'employeesAgeCategoryChart' => $employeesAgeCategoryChart,
            'employeesDepartmentChart'  => $employeesDepartmentChart,
            'employeesByPositionChart'  => $employeesByPositionChart,
            'employeesGrowthOvertime'   => $employeesGrowthOvertime,
        ]);
    }

    public function generatePrintableDashboard(Request $request)
    {
        $data     = [];
        $template = '';

        match (strtolower($request->printable_dashboard)) {
            'total employees' => $data           = Employee::query()->with('jobPosition')->get(),
            'employees by gender' => $data       = Employee::query()->with('jobPosition')->get()->groupBy('gender'),
            'employees by age category' => $data = Employee::query()->selectRaw("*, CASE WHEN age BETWEEN 18 AND 29 THEN '18 - 29' WHEN age BETWEEN 30 AND 39 THEN '30 - 39' WHEN age BETWEEN 40 AND 49 THEN '40 - 49' WHEN age BETWEEN 50 AND 59 THEN '50 - 59' WHEN age >= 60 THEN '> 60' END as age_category")->get()->groupBy('age_category'),
            'employees by department' => $data   = Employee::query()->with('jobPosition')->get()->groupBy('department'),
            'employees by position' => $data     = Employee::query()->with('jobPosition')->get()->groupBy('jobPosition.title'),
            'employees growth overtime' => $data = Employee::query()->selectRaw('*, YEAR(date_hired) as year')->get()->groupBy('year'),
        };

        match (strtolower($request->printable_dashboard)) {
            'total employees' => $template           = 'printable.total-employees',
            'employees by gender' => $template       = 'printable.employees-by-gender',
            'employees by age category' => $template = 'printable.employees-by-age-category',
            'employees by department' => $template   = 'printable.employees-by-department',
            'employees by position' => $template     = 'printable.employees-by-position',
            'employees growth overtime' => $template = 'printable.employees-growth-overtime',
        };

        return view($template, ['data' => $data]);
    }

    public function exportDashboardPdf()
    {
        $data = [
            'employeesCount'            => Employee::query()->count(),
            'annualTurnOverRate'        => $this->dashboardService->getAnnualTurnoverRate(),
            'overallTurnOverRate'       => $this->dashboardService->getOverallTurnoverRate(),
            'employeesCountChart'       => $this->dashboardService->getEmployeeGenderCount(),
            'employeesAgeCategoryChart' => $this->dashboardService->getEmployeeAgeCategoy(),
            'employeesDepartmentChart'  => $this->dashboardService->getEmployeeByDepartment(),
            'employeesByPositionChart'  => $this->dashboardService->getEmployeeByPosition(),
            'employeesGrowthOvertime'   => $this->dashboardService->getEmployeeGrowthOvertime(),
        ];

        $pdf = Pdf::loadView('pdf.dashboard', ['data' => $data])->setPaper('a4', 'portrait');

        return $pdf->download('dashboard-report.pdf');
    }

    public function exportDashboardExcel()
    {
        $data = [
            'employeesCount'            => Employee::query()->count(),
            'annualTurnOverRate'        => $this->dashboardService->getAnnualTurnoverRate(),
            'overallTurnOverRate'       => $this->dashboardService->getOverallTurnoverRate(),
            'employeesCountChart'       => $this->dashboardService->getEmployeeGenderCount(),
            'employeesAgeCategoryChart' => $this->dashboardService->getEmployeeAgeCategoy(),
            'employeesDepartmentChart'  => $this->dashboardService->getEmployeeByDepartment(),
            'employeesByPositionChart'  => $this->dashboardService->getEmployeeByPosition(),
            'employeesGrowthOvertime'   => $this->dashboardService->getEmployeeGrowthOvertime(),
        ];

        return Excel::download(new DashboardExport($data), 'dashboard_data.xlsx');
    }
}
