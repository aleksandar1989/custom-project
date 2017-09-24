@if ($errors->any())
    <div class="note note-danger">
        {{--<h4 class="block">Danger! Some Header Goes Here</h4>--}}
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif