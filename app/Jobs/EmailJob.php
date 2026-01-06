<?php

namespace App\Jobs;

use App\Mail\EmailMail;
use App\Models\User;
use App\Notifications\OrderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class EmailJob implements ShouldQueue
{
    use Queueable;
protected $order;
    /**
     * Create a new job instance.
     */
    public function __construct($order)
    {
        //
        $this->order=$order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $emails=User::where('role','admin')->pluck('email')->toArray();
         if(empty($emails)) 
         {
             throw new \Exception("not found emails");
             
            
         }
        Mail::to($emails)->send(new EmailMail($this->order));
       
        

        

    }
}
