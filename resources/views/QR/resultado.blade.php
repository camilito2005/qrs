<!DOCTYPE html>
<html>
<head>
    <title>QR generado</title>
</head>
<body>
    {{-- <h1>Código QR para: {{ $link }}</h1> --}}

    {{-- Mostramos el SVG directamente --}}
    <div id="qr-container">
        {!! $qr !!}
    </div>
    
    <br>
    <a href="{{ route('Formulario') }}">Generar otro</a>
    
    <h2>Descargar QR como Imagen PNG</h2>
    <button onclick="descargarQR()">Descargar</button>
    
    <script>
    function descargarQR() {
        const svg = document.querySelector('#qr-container svg');
        const svgData = new XMLSerializer().serializeToString(svg);
        const canvas = document.createElement("canvas");
        const ctx = canvas.getContext("2d");
    
        const img = new Image();
        const svgBlob = new Blob([svgData], {type: "image/svg+xml;charset=utf-8"});
        const url = URL.createObjectURL(svgBlob);
    
        img.onload = function() {
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0);
            URL.revokeObjectURL(url);
    
            const pngUrl = canvas.toDataURL("image/png");
            const downloadLink = document.createElement("a");
            downloadLink.href = pngUrl;
            downloadLink.download = "qr.png";
            downloadLink.click();
        };
    
        img.src = url;
    }
    </script>
    
</body>
</html>
