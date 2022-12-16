<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\TestHelloMail;
use Illuminate\Support\Facades\Mail;
use App\Models\PetugasPeralatan;

class TestSendEmail implements ShouldQueue
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
        $petugas = PetugasPeralatan::all();

        $emailJobs = new TestHelloMail();

        // send email
        foreach ($petugas as $petugas) {
            Mail::to($petugas->email)->send($emailJobs);
        }
    }
}
