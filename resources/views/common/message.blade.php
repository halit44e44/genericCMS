@if ($message = Session::get('success'))
<hr>
<div class="alert alert-success" style="height: auto">{{ $message }}</div>
@endif
@if ($errors->any())
<hr>
<div class="alert alert-danger" style="height: auto">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif