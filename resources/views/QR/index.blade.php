<!DOCTYPE html>
<html>
<head>
    <title>Generador de Código QR</title>
</head>
<body>
    <h1>Generar Código QR</h1>
    <form action="{{route('qr.Generar')}}" method="POST">
        @csrf
        <label>Enlace:</label>
        <input type="text" name="link" placeholder="https://ejemplo.com" required>
        <button type="submit">Generar</button>
    </form>

    

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
