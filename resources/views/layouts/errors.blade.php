@if (count($errors))
    <div class="form-group">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if ($flash = session('message'))
    <div id="flash-message" class="alert alert-success" role="alert">
        {{ $flash }}
    </div>
@elseif ($flash = session('error'))
    <div id="flash-message" class="alert alert-danger" role="alert">
        {{ $flash }}
    </div>
@endif