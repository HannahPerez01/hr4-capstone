<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayrollRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'employee_id'         => "required",
            'from'                => "required|date",
            'to'                  => "required|date",
            'basic_salary'        => "required|string",
            'basic_salary_render' => "required|string",
            'reg_ot'              => "required|string",
            'reg_ot_render'       => "required|string",
            'rd_ot'               => "required|string",
            'rd_ot_render'        => "required|string",
            'pag_ibig_render1'    => "required|string",
            'sss_render1'         => "required|string",
            'philhealth_render1'  => "required|string",
            'total_deductions'    => "required|string",
            'total_earnings'      => "required|string",
        ];
    }
}
