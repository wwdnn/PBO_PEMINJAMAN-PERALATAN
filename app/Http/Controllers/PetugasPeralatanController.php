<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PetugasPeralatan;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Product as Barang;
use App\DataTables\ActivityLogDataTable;
use Spatie\Activitylog\Models\Activity as ActivityLog;

class PetugasPeralatanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:petugas_peralatan');
    }

    public function index()
    {
        // get current authenticated user
        $petugas = auth()->user();

        $barang = (object) [
            'tersedia' => Barang::where('status_barang', 'Tersedia')->count(),
            'habis' => Barang::where('status_barang', 'Habis')->count(),
        ];
        
        $peminjam = (object) [
            'terpinjam' => Peminjaman::where('status_peminjaman', 'Terpinjam')->count(),
            'dikembalikan' => Peminjaman::where('status_peminjaman', 'Dikembalikan')->count(),
        ];

        $mahasiswa = (object) [
            'aktif' => User::where('is_siswa', 1)->where('status', 1)->count(),
            'nonaktif' => User::where('is_siswa', 1)->where('status', 0)->count(),
        ];

        $dosen = (object) [
            'aktif' => User::where('is_siswa', 0)->where('status', 1)->count(),
            'nonaktif' => User::where('is_siswa', 0)->where('status', 0)->count(),
        ];

        return view('petugas_peralatan.home')
            ->with('petugas', $petugas)
            ->with('peminjam', $peminjam)
            ->with('mahasiswa', $mahasiswa)
            ->with('dosen', $dosen)
            ->with('barang', $barang);
    }
    
    public function getEmailPetugas()
    {
        $petugas = PetugasPeralatan::all();
        return $petugas;
    }

    public function getLog(ActivityLogDataTable $dataTable)
    {
        return $dataTable->render('petugas_peralatan.log');
    }

    public function getLogDetails($id)
    {
        try {
            $log = ActivityLog::findOrFail($id);

            return view('petugas_peralatan.logDetails')->with('log', $log);
        } catch (\Exception $th) {
            return redirect()->back()->with('error_message', 'Log tidak ditemukan');
        }
    }
}
