<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class mailPDF extends Mailable
{
    use Queueable, SerializesModels;

    protected $mailSubject;
    protected $mailBody;
    protected $pdf;
    protected $pdfName;
    protected $autoMsg;

    public function __construct($mailSubject, $mailBody, $pdf, $pdfName, $autoMsg)
    {
        $this->mailSubject = $mailSubject;
        $this->mailBody = $mailBody;
        $this->pdf = $pdf;
        $this->pdfName = $pdfName;
        $this->autoMsg = $autoMsg;
        $this->afterCommit();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(config('app.email'), config('app.name')),
            subject: $mailSubject ?? $pdfName ?? config('app.name'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'worker.emails.send_pdf',
            with: [
                'auto_msg' => $autoMsg,
                'mailBody' => $mailBody,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => PDF::loadView($pdf['pdf_blade'],['mergedData' => $pdf['mergedData'], 'ponuda_name' => $pdf['ponuda_name'], 'company' => $pdf['company'], 'client' => $pdf['client'], 'type' => $pdf['type'], 'opis' => $pdf['opis']])->output(), $pdfName . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
