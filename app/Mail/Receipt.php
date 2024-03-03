<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;
use PDF;
use Illuminate\Support\Str;

class Receipt extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(private $data)
    {
        //
    }

    private function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function build()
    {
        $payment_type = $this->data->payment_type;

        $pdf_data = [
            'payment_type' => $this->data->payment_type,
            'name' => $this->data->name,
            'type' => $this->data->type,
            'expires_on' => $this->data->expires_on ?? '',
            'mat_type' => $this->data->mat_type,
            'material' => $this->data->material,
            'date' => $this->data->date,
            'currency' => $this->data->currency,
            'amount' => $this->data->amount,
            'ref' => $this->data->ref,
        ];

        $pdf = PDF::loadView('pdf.receipt', ['data' => $pdf_data]);
        return $this->subject('Virtual Law Library Receipt')->markdown('emails.receipts.index')->with($pdf_data)->attachData($pdf->output(), $this->data->ref . '-' . $payment_type . '.pdf');
    }
}
