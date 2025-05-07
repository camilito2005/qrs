<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class QRController extends Controller
{
    //
    public function index()
    {
        return view('QR.index');
    }
    // }
    public function Generar(Request $request)
    {
        $request->validate([
            'link' => 'required|url'
        ]);

        $link = $request->input('link'); // Obtiene el enlace del formulario

        $qr = QrCode::size(300)->generate($link); // Genera el código QR con el enlace
        return view('QR.resultado', compact('qr', 'link'));
    }
    public function Download(Request $request) {
        $request->validate([
            'link' => 'required|url'
        ]);
        
        $link = $request->input('link'); // Obtiene el enlace del formulario

        dump($link);

        $filename = 'qrs/qr_' . time() . '.png'; // Nombre del archivo

        $filePath = storage_path('app/public/' . $filename); // Ruta completa del archivo

        dump($filePath); 
        // Verifica si la carpeta 'qrs' existe, si no, la crea
        if (!file_exists(dirname($filePath))) {
            mkdir(dirname($filePath), 0777, true);
        }

        // QrCode::format('png')->size(300)->generate($link, storage_path('app/public/'. $filename)); // Genera el código QR y lo guarda en la carpeta 'qrs'
        // QrCode::format('png')->size(300)->generate($link , $filePath); // Genera el código QR y lo guarda en la carpeta 'qrs'

        // return response()->download($filePath, 'qr.png')->deleteFileAfterSend(true);

        $qr = QrCode::format('svg')->size(300)->generate($link); 
return view('QR.resultado', compact('qr', 'link'));

        // return response()->download(storage_path('app/public/'. $filename), 'qr.png')->deleteFileAfterSend(true); // Descarga el archivo y lo elimina después de enviarlo
    }

//     public function Download(Request $request)
// {
//     $request->validate([
//         'link' => 'required|url'
//     ]);

//     $link = $request->input('link');

//     $svg = QrCode::format('svg')->size(300)->generate($link); // genera SVG como string

//     $filename = 'qr_' . time() . '.svg';

//     return response($svg)
//         ->header('Content-Type', 'image/svg+xml')
//         ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
// }

}
