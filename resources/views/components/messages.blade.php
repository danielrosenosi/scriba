@if(session()->has('message'))
    <script>
        Swal.fire({
            icon: 'success',
            title: "{{ session('message') }}",
            position: 'top-end',
            toast: true,
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
        })
    </script>
@endif