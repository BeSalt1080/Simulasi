<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengaduans = Pengaduan::with('user')->latest()->get();

        return Inertia::render('Pengaduan/Index', compact('pengaduans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Pengaduan/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pesan' => 'required|min:5|string',
            'foto' => 'required|mimes:png,jpg,webp',
        ]);

        $foto = $request->file('foto');
        $nama_foto = time() . '.' . $foto->getClientOriginalExtension();
        $destinationPath = public_path('/image');
        $foto->move($destinationPath, $nama_foto);

        Pengaduan::create([
            'pesan' => $request->pesan,
            'foto' => $nama_foto,
            'status' => 'Pending',
            'user_id' => Auth::user()->id,
        ]);

        return Redirect::route('pengaduan.index')->with('message', "Pengaduan Berhasil Dibuat!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengaduan = Pengaduan::with('user', 'tanggapan')->find($id);
        $tanggapan = [];
        if ($pengaduan->tanggapan)
            $tanggapan = Tanggapan::with('user')->find($pengaduan->tanggapan->id);
        return Inertia::render('Pengaduan/Detail', compact('pengaduan', 'tanggapan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengaduan = Pengaduan::find($id);
        return Inertia::render('Pengaduan/Edit', compact('pengaduan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pengaduan = Pengaduan::find($id);
        if ($request->hasFile('foto')) {
            $tempfoto = $pengaduan->foto;
            $foto = $request->file('foto');
            $name = time() . '.' . $foto->getClientOriginalExtension();
            $destinationPath = public_path('/image/');
            $foto->move($destinationPath, $name);
            $pengaduan->foto = $name;
            unlink(public_path('/image/' . $tempfoto));
        }
        if ($request->has('pesan'))
            $pengaduan->pesan = $request->get('pesan');

        $pengaduan->save();

        return Redirect::route('pengaduan.index')->with('message', "Pengaduan Berhasil Dibuat!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pengaduan::find($id)->delete();
    }

    public function generate()
    {
        $pengaduans = Pengaduan::latest()->get();
        $pdf = PDF::loadview('pengaduan.pdf', compact('pengaduans'));
        return $pdf->download("pengaduan.pdf");
    }
}
