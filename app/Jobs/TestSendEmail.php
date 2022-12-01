<?php

namespace App\Jobs;

use App\Mail\TestHelloEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;



class TestSendEmail implements ShouldQueue{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(){
         $email = new TestHelloEmail();
        Mail::to('wildannugraha330@gmail.com')->send($email);
    }
}
