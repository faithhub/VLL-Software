<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;
// use PDFD;
// use PDF;
// use \Mpdf\Mpdf as PDF;

class ImageController extends Controller
{

    public function pdf()
    {
        $data = [
            [
                'quantity' => 1,
                'description' => '1 Year Subscription',
                'price' => '129.00'
            ]
        ];

        $pdf = PDF::loadView('pdf.document', ['data' => $data]);

        $pdf->get_canvas()->get_cpdf()->setEncryption("userpass", "adminpass");
        // return $pdf->stream('receipt.pdf');
        return $pdf->stream('receipt.pdf');
        // Setup a filename 
        // $documentFileName = "fun.pdf";

        // // Create the mPDF document
        // $document = new mPDF([
        //     'mode' => 'utf-8',
        //     'format' => 'A4',
        //     'margin_header' => '3',
        //     'margin_top' => '20',
        //     'margin_bottom' => '20',
        //     'margin_footer' => '2',
        // ]);

        // // Set some header informations for output
        // // $header = [
        // //     'Content-Type' => 'application/pdf',
        // //     'Content-Disposition' => 'inline; filename="' . $documentFileName . '"'
        // // ];

    }


    public function show($filename)
    {
        // $path = storage_path('private/' . $filename);
        $path = 'private/' . $filename;

        // dd($path);
        // if (!Storage::exists($path)) {
        //     abort(404);
        // }

        return response()->file(
            Storage::path($path)
        );
    }

    public function show2($filename)
    {
        dd("fff");
        return 333;
        // $path = storage_path('private/' . $filename);
        $path = 'private/' . $filename;

        // dd($path);
        // if (!Storage::exists($path)) {
        //     abort(404);
        // }

        return response()->file(
            Storage::path($path)
        );
    }

    public function private($filename)
    {
        $path = 'private/' . $filename;

        if (!Storage::exists($path)) {
            abort(404);
        }

        return response()->file(
            Storage::path($path)
        );
    }

    public function avatars($filename)
    {
        dd("fff");
        return 333;
        // $path = storage_path('private/' . $filename);
        $path = 'private/' . $filename;

        // dd($path);
        // if (!Storage::exists($path)) {
        //     abort(404);
        // }

        return response()->file(
            Storage::path($path)
        );
    }

    public function material_cover($filename)
    {
        // dd("fff");
        // return 333;
        // $path = storage_path('private/' . $filename);
        $path = 'public/materials/covers/' . $filename;

        // dd($path);
        if (!Storage::exists($path)) {
            abort(404);
        }

        return response()->file(
            Storage::path($path)
        );
    }
}
