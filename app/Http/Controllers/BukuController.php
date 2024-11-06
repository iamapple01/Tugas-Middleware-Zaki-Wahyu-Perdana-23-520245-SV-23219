<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data buku
        $data_buku = Buku::all();
        
        // Menghitung jumlah data buku
        $jumlah_buku = $data_buku->count();
        
        // Menghitung total harga semua buku
        $total_harga = $data_buku->sum('harga');

        // Mengirimkan data ke view
        return view('index', compact('data_buku', 'jumlah_buku', 'total_harga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();

        return redirect('/buku');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'harga' => 'required|integer',
            'tgl_terbit' => 'required|date',
        ]);
        $buku = Buku::findOrFail($id);
        $buku->judul = $request->input('judul');
        $buku->penulis = $request->input('penulis');
        $buku->harga = $request->input('harga');
        $buku->tgl_terbit = $request->input('tgl_terbit');
        $buku->save();
        return redirect()->back()->with('success');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $buku = Buku::find($id);
        $buku->delete();

        return redirect('/buku');
    }


}
