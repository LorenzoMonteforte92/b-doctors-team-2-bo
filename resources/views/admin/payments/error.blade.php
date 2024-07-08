@extends('layouts.admin')
@section('title')
    {{ 'Interazioni' }}
@endsection
@section('content')

<body>
    <h1>Payment Failed!</h1>
    @if($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>

@endsection