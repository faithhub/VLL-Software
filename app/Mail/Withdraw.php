<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use PDF;

class Withdraw extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     *
     */
    private $pdf_data;

    public function __construct(private $data)
    {
        $this->pdf_data = [
            'payment_type' => $this->data->payment_type,
            'acc_name'     => $this->data->acc_name,
            'bank'         => $this->data->bank,
            'acc_name'     => $this->data->acc_name,
            'acc_num'      => $this->data->acc_num,
            'fee'          => $this->data->fee,
            'date'         => $this->data->date,
            'currency'     => $this->data->currency,
            'amount'       => $this->data->amount,
            'ref'          => $this->data->ref,
        ];
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
    public function envelope()
    {
        return new Envelope(
            subject: 'Virtual Law Library Withdraw',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {

        return new Content(
            markdown: 'emails.transaction.withdraw',
            with: $this->pdf_data,
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    // public function attachments()
    // {
    //     $pdf = PDF::loadView('pdf.receipt', ['data' => $this->pdf_data]);
    //     return [
    //         Attachment::fromData(fn () => $pdf->output(), $this->data->ref . '-' . $this->data->payment_type . '.pdf')
    //             ->withMime('application/pdf'),
    //     ];
    // }
    public function attachments()
    {
        try {
            $pdf = PDF::loadView('pdf.receipt', ['data' => $this->pdf_data]);
            return [
                Attachment::fromData(
                    fn() => $pdf->output(),
                    'receipt-' . Str::slug($this->data->ref) . '-' . $this->data->payment_type . '.pdf'
                )->withMime('application/pdf'),
            ];
        } catch (\Exception $e) {
            \Log::error('PDF Generation Error: ' . $e->getMessage());
            return [];
        }
    }
}
