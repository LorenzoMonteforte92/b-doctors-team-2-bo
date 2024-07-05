<!DOCTYPE html>
<html>
<head>
    <title>Payment Error</title>
</head>
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
</html>
