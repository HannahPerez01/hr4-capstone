@extends('layouts.layoutMaster')

@section('title', 'Dashboard')

@section('content')
    @if (session()->has('success'))
        <x-alert successMessage="{{ session('success') }}" />
    @endif

    <div class="container mt-3">
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
