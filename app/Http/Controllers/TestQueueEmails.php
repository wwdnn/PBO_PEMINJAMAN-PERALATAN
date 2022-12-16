<?php

namespace App\Http\Controllers;

use App\Jobs\TestSendEmail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\PinjamanDetail;
use Mpdf\Tag\Dd;

class TestQueueEmails extends Controller
{
    /**
    * test email queues
    **/
    public function sendTestEmails()
    {
        $emailJobs = new TestSendEmail();
        $this->dispatch($emailJobs);
        Alert::success('Berhasil', 'Berhasil Mengirim Email Ke Semua Petugas Peralatan');
        return redirect()->back();
    }
}
