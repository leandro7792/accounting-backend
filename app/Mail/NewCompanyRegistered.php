<?php

namespace App\Mail;

use App\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewCompanyRegistered extends Mailable
{
    use Queueable, SerializesModels;
    public $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $company = $this->company;
        $company->load('contacts');
        $company->load('activities');
        $company->activities->load('cnae:id,code,description');
        $company->load('company_type');
        $company->load('company_size');
        $company->load('tax');
        $company->load('administration_type');
        $company->load('partirners');


        return $this
            ->subject('Nova empresa cadastrada')
            ->view('emails.company.NewCompanyRegistered')
            ->with(compact('company'));
    }
}
