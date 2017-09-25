@if (Session::has('message'))
    <script>
        var type = "{{ Session::get('type') }}";
        var message = "{{ Session::get('message') }}";
        toastr[type](message);
    </script>
@endif