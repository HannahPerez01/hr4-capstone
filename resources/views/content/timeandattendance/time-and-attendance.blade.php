@extends('layouts/layoutMaster')

@section('title', 'TIME AND ATTENDANCE')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/quill/katex.scss',
  'resources/assets/vendor/libs/quill/editor.scss',
  'resources/assets/vendor/libs/select2/select2.scss'
])
@endsection

@section('page-style')
@vite([
  'resources/assets/vendor/scss/pages/app-email.scss'
])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/quill/katex.js',
  'resources/assets/vendor/libs/quill/quill.js',
  'resources/assets/vendor/libs/select2/select2.js',
  'resources/assets/vendor/libs/block-ui/block-ui.js'
])
@endsection

@section('page-script')
@vite([
  'resources/assets/js/app-email.js'
])
@endsection

@section('content')
  <div class="">
    <div class="card">
      <div class="card-datatable table-responsive">
        <table class="datatables-projects table border-top">
          <thead>
            <tr>
           <th>Employee Id</th>
              <th>Employee name</th>
               <th>Time In</th>
              <th>Time out</th>
              <th>Total Hours Work</th>
               <th>Date</th>

            </tr>
          </thead>

  <tbody>
              @foreach($attendance as $claim)
                <tr class="contents">
                    <td>{{ $claim->employee_id }}</td>
                    <td class="titles">{{ $claim->employee_name }}</td>
                    <td>{{ $claim->time_in }}</td>
                    <td>{{ $claim->time_out}}</td>
                    <td>
                      <?php

                      $datetime1 = new DateTime($claim->time_in);
                          $datetime2 = new DateTime($claim->time_out);
                           $interval = $datetime1->diff($datetime2);
                         echo $interval->format('%hh %im');
                            ?>
                    </td>
                      <td>{{ $claim->date_time_in}}</td>
                </tr>
              @endforeach
          </tbody>

        </table>
      </div>
    </div>
  </div>
@endsection


<script type="text/javascript">
  



</script>