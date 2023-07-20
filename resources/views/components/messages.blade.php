@if(session()->has('message'))
    <script>
        swal({
            title: "{{ session('message') }}",
            timer: 1500,
            timerProgressBar: true,
        });
    </script>
@endif