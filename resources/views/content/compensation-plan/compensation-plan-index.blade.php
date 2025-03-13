@extends('layouts/layoutMaster')
@section('title', 'COMPENSATION')
@section('vendor-style')
    @vite('resources/assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.scss')
@endsection

@section('page-style')
    @vite('resources/assets/vendor/scss/pages/app-chat.scss')
@endsection

@section('vendor-script')
    @vite('resources/assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js')
@endsection
@section('page-script')
    @vite('resources/assets/js/app-chat.js')
@endsection
@section('content')
    <div class="">
        <div class="card">
            <div class="p-5">
                <div class="form-group">
                    <select name="position" id="positionSelect" class="form-select w-25">
                        <option value="" selected>Select an option</option>
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}">{{ $position->title }}</option>
                        @endforeach
                    </select>

                    <div id="renderPage">
                        <p>Select a position to view the compensation plan.</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#positionSelect').change(function() {
            let positionId = $(this).val(); // Get selected value (ID)

            $.ajax({
                url: '/compensation-plan?jobPositionId=' + encodeURIComponent(positionId),
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.compensationPlan && response.compensationPlan
                        .extra_field) {
                        let jobTitle = response.compensationPlan.job_position.title;
                        let compensationData = response.compensationPlan.extra_field;
                        renderCompensationData(compensationData, jobTitle);
                    } else {
                        $('#renderPage').html('<p>No compensation plan found.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        });

        function renderCompensationData(data, jobTitle) {
            let html = "";

            if (Array.isArray(data) && data.length > 0) {
                let group = data[0]?.group; // Extract the group object

                if (!group) {
                    $('#renderPage').html('<p>No group data found.</p>');
                    return;
                }
                html += `<h1 class="mt-5">${jobTitle}</h1>`

                // 🏆 Payroll Table
                html += `<h3 class="mt-5">Payroll Details</h3>
                     <div class="table-responsive">
                        <table border="1" class="table">
                         <tr>
                             <th>Bonuses</th>
                             <th>Allowances</th>
                             <th>Basic Pay Range</th>
                             <th>Fringe Benefits</th>
                             <th>Regular OT Pay</th>
                             <th>Rest Day OT Pay</th>
                             <th>Total Compensation</th>
                         </tr>
                         <tr>
                             <td>${group.payroll.bonuses}</td>
                             <td>${group.payroll.allowances}</td>
                             <td>${group.payroll.basic_pay_range}</td>
                             <td>${group.payroll.fringe_benefits}</td>
                             <td>${group.payroll.regular_overtime_pay}</td>
                             <td>${group.payroll.rest_day_overtime_pay}</td>
                             <td>${group.payroll.total_compensation_range}</td>
                         </tr>
                     </table>
                     </div>`;

                // 🏆 Basic Rate Table
                html += `<h3 class="mt-5">Basic Rate</h3>
                     <div class="table-responsive">
                        <table border="1" class="table">
                         <tr>
                             <th>Daily Rate</th>
                             <th>Hourly Rate</th>
                             <th>Basic Pay Range</th>
                         </tr>
                         <tr>
                             <td>${group.basic_rate.daily_rate}</td>
                             <td>${group.basic_rate.hourly_rate}</td>
                             <td>${group.basic_rate.basic_pay_range}</td>
                         </tr>
                     </table>
                        </div>`;

                // 🏆 Salary Grade Levels Table
                html += `<h3 class="mt-5">Salary Grade Levels</h3>
                <div class="table-responsive">
                     <table border="1" class="table">
                         <tr>
                             <th>Level</th>
                             <th>Step 1</th>
                             <th>Step 2</th>
                             <th>Step 3</th>
                             <th>Step 4</th>
                             <th>Step 5</th>
                             <th>Step 6</th>
                             <th>Step 7</th>
                             <th>Step 8</th>
                         </tr>`;

                group.salary_grade_level.forEach(level => {
                    html += `<tr>
                             <td>${level.level}</td>
                             <td>${level.step_1}</td>
                             <td>${level.step_2}</td>
                             <td>${level.step_3}</td>
                             <td>${level.step_4}</td>
                             <td>${level.step_5}</td>
                             <td>${level.step_6}</td>
                             <td>${level.step_7}</td>
                             <td>${level.step_8}</td>
                         </tr>`;
                });

                html += `</table>
                </div>`;

                // 🏆 Benefits Table
                html += `<h3 class="mt-5">Benefits</h3>
                <div class="table-responsive">
                     <table border="1" class="table table-responsive">
                         <tr>
                             <th>Component</th>
                             <th>Details</th>
                         </tr>`;

                group.benefits.forEach(benefit => {
                    html += `<tr>
                             <td>${benefit.component}</td>
                             <td>${benefit.details}</td>
                         </tr>`;
                });

                html += `</table></div>`;

                $('#renderPage').html(html); // Inject into the page
            } else {
                $('#renderPage').html('<p>No compensation plan available.</p>');
            }
        }
    });
</script>
