@extends('layouts/layoutMaster')

@section('title', 'Email - Apps')

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
              <th>First name</th>
              <th>Middle name</th>
              <th>Last Name</th>
              <th>Time In</th>
              <th>Time out</th>
              <th>Total Hours Work</th>

            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
@endsection
