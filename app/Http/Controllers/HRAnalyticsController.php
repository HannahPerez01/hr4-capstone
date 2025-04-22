<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\DashboardExport;
use App\Services\DashboardService;
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
