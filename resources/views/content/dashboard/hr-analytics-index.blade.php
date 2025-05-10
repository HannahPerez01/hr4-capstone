@extends('layouts.layoutMaster')

@section('title', 'Dashboard')

@section('content')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #printable-dashboard,
            #printable-dashboard * {
                visibility: visible;
            }

            #printable-dashboard {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .card {
                width: 100%;
            }

            .btn,
            .d-flex.justify-content-end,
            {
            display: none !important;
        }
        }
    </style>
    @if (session()->has('success'))
        <x-alert successMessage="{{ session('success') }}" />
    @endif

    <div class="d-flex justify-content-end gap-2 mb-3">
        <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#printModal">
            <i class="ti ti-printer"></i> Print Dashboard
        </button>
        <a href="{{ route('dashboard.export-pdf') }}" class="btn btn-sm btn-danger">
            <i class="ti ti-files"></i> Export as PDF
        </a>
        <a href="{{ route('dashboard.export-excel') }}" class="btn btn-sm btn-success">
            <i class="ti ti-file"></i>
            Export as Excel
        </a>
    </div>

    <div class="container mt-3" id="printable-dashboard">
        <div class="row align-items-start">
            <div class="col-md-4">
                <x-card-component title="Total Employees" :description="$employeesCount" />
            </div>

            <div class="col-md-4">
                <x-card-component title="Annual Turnover Rate" :description="$annualTurnOverRate . '%'" />
            </div>

            <div class="col-md-4">
                <x-card-component title="Overall Turnover Rate" :description="$overallTurnOverRate . '%'" />
            </div>

            <div class="col-md-6 my-1">
                <div class="card align-center justify-content-center text-center">
                    <div class="card-body">
                        {!! $employeesCountChart->container() !!}
                    </div>
                </div>
            </div>

            <div class="col-md-6 my-1">
                <div class="card align-center justify-content-center text-center">
                    <div class="card-body">
                        {!! $employeesAgeCategoryChart->container() !!}
                    </div>
                </div>
            </div>

            <div class="col-md-8 my-1">
                <div class="card align-center justify-content-center text-center">
                    <div class="card-body">
                        {!! $employeesByPositionChart->container() !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4 my-1">
                <div class="card align-center justify-content-center text-center">
                    <div class="card-body">
                        {!! $employeesDepartmentChart->container() !!}
                    </div>
                </div>
            </div>


            <div class="col-md-12 my-1">
                <div class="card align-center justify-content-center text-center">
                    <div class="card-body">
                        {!! $employeesGrowthOvertime->container() !!}
                    </div>
                </div>
            </div>

            <div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="printModalLabel">Print Dashboard</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container mt-3" id="printable-dashboard">
                                <div class="row align-items-start">
                                    <form action="{{ route('dashboard.generate-printable-dashboard') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <label for="printable_dashboard">Select Print</label>
                                            <select name="printable_dashboard" id="printable_dashboard" class="form-select">
                                                <option value="Total Employees">Total Employees</option>
                                                <option value="Employees by Gender">Employees by Gender</option>
                                                <option value="Employees by Age Category">Employees by Age Category</option>
                                                <option value="Employees by Position">Employees by Position</option>
                                                <option value="Employees by Department">Employees by Department</option>
                                                <option value="Employees Growth Overtime">Employees Growth Overtime</option>
                                            </select>
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary">Print</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
    {!! $employeesCountChart->script() !!}
    {!! $employeesAgeCategoryChart->script() !!}
    {!! $employeesDepartmentChart->script() !!}
    {!! $employeesByPositionChart->script() !!}
    {!! $employeesGrowthOvertime->script() !!}
@endsection