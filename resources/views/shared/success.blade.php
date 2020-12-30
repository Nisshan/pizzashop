@if (session()->has('success'))
    <div class="alert alert-success">
        @if(is_array(session('success')))
            <ul>
                @foreach (session('success') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @else
            {{ session('success') }}
        @endif
    </div>
@endif

@if(session()->has('danger'))
    <div class="alert alert-danger">
        @if(is_array(session('danger')))
            <ul>
                @foreach (session('danger') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @else
            {{ session('danger') }}
        @endif
    </div>
@endif
