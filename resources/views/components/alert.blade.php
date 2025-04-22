@if ($successMessage)
    <script>
        Swal.fire({
            icon: 'success',
            title: "{{ $successMessage }}",
            showConfirmButton: true,
            timer: 3000
        });
    </script>
@endif

@if ($errorMessage)
    <script>
        Swal.fire({
            icon: 'error',
            title: "{{ $errorMessage }}",
            showConfirmButton: true,
            timer: 3000
        });
    </script>
@endif

@if ($infoMessage)
    <script>
        Swal.fire({
            icon: 'info',
            title: "{{ $infoMessage }}",
            showConfirmButton: true,
            timer: 3000
        });
    </script>
@endif
