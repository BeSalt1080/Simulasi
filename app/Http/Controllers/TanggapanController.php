<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class TanggapanController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::find($id);
        return Inertia::render('Tanggapan/Create', compact('pengaduan'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'pengaduan_id' => 'required',
            'pesan' => 'required',
            'status' => 'required',
        ]);
        Tanggapan::create([
            'pengaduan_id' => $request->pengaduan_id,
            'pesan' => $request->pesan,
            'user_id' => Auth::id(),
        ]);
        Pengaduan::where('id', $request->pengaduan_id)->update([
            'status' => $request->status,
        ]);
        return Redirect::route('pengaduan.index')->with('message', "Tanggapan Berhasil Dikirim!");
    }

    public function edit($id)
    {
        $tanggapan = Tanggapan::with('pengaduan')->find($id);
        return Inertia::render('Tanggapan/Edit', compact('tanggapan'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'pesan' => 'required',
            'status' => 'required',
        ]);

        Pengaduan::where('id', $request->pengaduan_id)->update([
            'status' => $request->status,
        ]);

        $tanggapan = Tanggapan::find($id);
        $tanggapan->pesan = $request->pesan;
        $tanggapan->user_id = Auth::id();
        $tanggapan->save();

        return Redirect::route('pengaduan.index')->with('message', "Tanggapan Berhasil Diubah!");
    }
    public function destroy($id)
    {
        $tanggapan = Tanggapan::find($id);
        $tanggapan->delete();
        return Redirect::route('pengaduan.index')->with('message', "Tanggapan Berhasil dihapus!");
    }
}
