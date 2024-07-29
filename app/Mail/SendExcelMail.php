<?php

namespace App\Mail;

use App\Exports\RepositoryExport;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;

class SendExcelMail extends Mailable
{
    use Queueable, SerializesModels;

    public $repositories;

    public function __construct($repositories)
    {
        $this->repositories = $repositories;
    }

    public function build()
    {
        $file = Excel::raw(new RepositoryExport($this->repositories), \Maatwebsite\Excel\Excel::XLSX);
        return $this->view('emails.excel')
            ->attachData($file, 'repositories.xlsx', [
                'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Excel Mail',
        );
    }
}
