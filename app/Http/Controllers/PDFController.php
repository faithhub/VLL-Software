<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{

    public function generateReceipt()
    {
        try {
            //code...
            $data = [
                [
                    'quantity' => 1,
                    'description' => '1 Year Subscription',
                    'price' => '129.00'
                ]
            ];

            $pdf = PDF::loadView('pdf.receipt', ['data' => $data]);

            // return $pdf->stream('receipt.pdf');
            return $pdf->download('receipt.pdf');
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }

    public function generatePDF()
    {
        try {
            //code...
            $data = [
                [
                    'quantity' => 1,
                    'description' => '1 Year Subscription',
                    'price' => '129.00'
                ]
            ];

            $pdf = PDF::loadView('pdf.receipt', ['data' => $data]);

            // return $pdf->stream('receipt.pdf');
            return $pdf->download('receipt.pdf');
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
        }
    }

    public function testPDF()
    {
        $data = ['title' => 'domPDF in Laravel 10'];
        // $pdf = PDF::loadView('pdf.document', $data);
        dd($data);
    }
    // public function generatePDF()
    // {
    //     $data = ['title' => 'domPDF in Laravel 10'];
    //     $pdf = PDF::loadView('pdf.document', $data);
    //     return $pdf->download('document.pdf');
    // }
}
