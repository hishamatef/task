<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\SimpleForm\Entities\SimpleForm;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $accepted_count = SimpleForm::getAcceptedRecordsCount();
        $rejected_count = SimpleForm::getRejectedRecordsCount();
        $email_subject = 'Accepted and Rejected Records Count';
        $email_body = 'Accepted records count is '.$accepted_count.' and Rejected Records Count is '.$rejected_count ;
        SimpleForm::sendEmail($email_subject,$email_body,'Hisham Atef',env('MAIL_TO_EMAIL'),'truedoc 24/7','noreply@trudoc247.com');
    }
}
