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
                        @foreach ($categories as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
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
            let category = $(this).val(); // Get selected value (ID)

            $.ajax({
                url: '/compensation-plan?jobPositionCategory=' + encodeURIComponent(category),
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.compensationPlan && response.compensationPlan
                        .extra_field) {
                        let jobTitle = response.compensationPlan.job_category;
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

                // 🏆 Salary Grade Levels Table
                html += `<h3 class="mt-5">Salary Grade Levels</h3>`;
                group.salary_grade_level.forEach(level => {

                    html += `
                <h5 class="mt-1">${level.job_title}</h5>
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

                    level.groupLevel.forEach(groupLevel => {
                        html += `<tr>
                             <td>${groupLevel.title}</td>
                             <td>${groupLevel.step_1}</td>
                             <td>${groupLevel.step_2}</td>
                             <td>${groupLevel.step_3}</td>
                             <td>${groupLevel.step_4}</td>
                             <td>${groupLevel.step_5}</td>
                             <td>${groupLevel.step_6}</td>
                             <td>${groupLevel.step_7}</td>
                             <td>${groupLevel.step_8}</td>
                         </tr>`;
                    });

                    html += `</table>
                </div>`;
                });


                html += `<h3 class="mt-5">Overtime Pay Computation</h3>
                <div class="w-100 border p-3">
                    <div>
                        <h4>Rest Day Overtime Pay</h4>
                        <p>The formula for calculating <strong>Rest Day Overtime Pay</strong> is: </p>
                        <p>Rest Day Overtime Pay - Hourly Rate x 1.5 x Hours Worked</p>
                    </div>

                    <div>
                        <h4>Regular Overtime Pay</h4>
                        <p>The formula for calculating <strong>Regular Overtime Pay</strong> is: </p>
                        <p>Regular Overtime Pay - Hourly Rate x 1.25 x Hours Worked</p>
                    </div>
                </div>
                `;

                // 🏆 Compensation Details Table
                html += `<h3 class="mt-5">Compensation Details</h3>
                     <div class="table-responsive">
                        <table border="1" class="table">
                         <tr>
                             <th>Job Role</th>
                             <th>Basic Rate</th>
                             <th>Basic Pay Range</th>
                             <th>Bonuses</th>
                             <th>Allowances</th>
                             <th>Fringe Benefits</th>
                             <th>Regular OT Pay</th>
                             <th>Rest Day OT Pay</th>
                             <th>Total Compensation</th>
                         </tr>`;
                group.compensation_details.forEach(compensation => {
                    html += `<tr>
                             <td>${compensation.job_position}</td>
                             <td>${compensation.details.basic_rate}</td>
                             <td>${compensation.details.basic_pay_range}</td>
                             <td>${compensation.details.bonuses}</td>
                             <td>${compensation.details.allowances}</td>
                             <td>${compensation.details.fringe_benefits}</td>
                             <td>${compensation.details.regular_overtime_pay}</td>
                             <td>${compensation.details.rest_day_overtime_pay}</td>
                             <td>${compensation.details.total_compensation_range}</td>
                    </tr>`;
                });
                html += `</table></div>`;


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
