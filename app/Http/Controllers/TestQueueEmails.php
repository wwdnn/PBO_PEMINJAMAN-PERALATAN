<?php

namespace App\Http\Controllers;

use App\Jobs\TestSendEmail;
use Illuminate\Http\Request;

class TestQueueEmails extends Controller
{
    /**
    * test email queues
    **/
    public function sendTestEmails()
    {
        $emailJobs = new TestSendEmail();
        $this->dispatch($emailJobs);
        return redirect()->back();
    }
}
