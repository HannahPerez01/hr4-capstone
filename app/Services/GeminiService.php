<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.api_key');
    }

    public function generatePayroll($employees)
    {
        $prompt = "
            Generate a payroll report for the following employee based on work hours and hourly rate.
            Ensure deductions for SSS, PhilHealth, and PAG-IBIG are applied.
            Detect salary errors based on historical data and provide corrections if needed.

            **Employee Details:**
            Name: {$employees['name']}
            Hourly Rate: ₱{$employees['hourly_rate']}
            Total Hours Worked: {$employees['total_hours']}
            Regular Hours: {$employees['regular_hours']}
            Overtime Hours: {$employees['overtime_hours']}
            Gross Salary: ₱{$employees['salary']}
            Deductions (Employee Share):
            - SSS: ₱{$employees['sss_employee_share']}
            - PhilHealth: ₱{$employees['philhealth_employee_share']}
            - PAG-IBIG: ₱{$employees['pag_ibig_employee_share']}

            Employer Contributions:
            - SSS: ₱{$employees['sss_employer_share']}
            - PhilHealth: ₱{$employees['philhealth_employer_share']}
            - PAG-IBIG: ₱{$employees['pag_ibig_employer_share']}

            Net Salary: ₱{$employees['net_salary']}

            **Error Detection & AI Insights:**
            [Provide salary error analysis here]

            **Final Computation:**
            Regular Salary: ₱{$employees['hours_worked_and_rate']}
            Overtime Pay: ₱{$employees['total_overtime_amount']}
            Total Net Pay: ₱{$employees['net_salary']}

            The SSS, Philhealth and PagIBIG contribution of employer and employee will be listed.
            Format the response in HTML. Do not include HTML headers or conversational language. Present it as a **formal payroll report**.
            This is the data you can use  " . json_encode($employees) . "
            ";

        $response = Http::post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$this->apiKey", [
            "contents" => [
                [
                    "parts" => [
                        ["text" => $prompt],
                    ],
                ],
            ],
        ]);

        return $response->json();
    }
}
