<?php

namespace App\Http\Controllers;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Gallery; // Import Gallery model



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
        $request->validate([
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
            'thumbnail' => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);

        $filename = null;
        $filepath = null;

        if ($request->hasFile('thumbnail')) {
            $filename = time().'-' . $request->thumbnail->getClientOriginalName();
            $filepath = $request->file('thumbnail')->storeAs('uploads', $filename, 'public');
        }

        Image::make(storage_path('app/public/uploads/' . $filename))
            ->fit(240, 320)
            ->save();

        Buku::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit,
            'filename' => $filename,
            'filepath' => $filepath ? '/storage/' . $filepath : null,
        ]);

        return redirect('/buku')->with('pesanstore', 'Buku berhasil ditambahkan!');
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
        $buku = Buku::find($id);

        return view('buku.edit', compact('buku'));;
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $buku = Buku::find($id);

        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $fileName = time().'_'. $request->thumbnail->getClientOriginalName();
        $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');

        Image::make(storage_path(). '/app/public/uploads/'.$fileName)
            ->fit(240,320)
            ->save();

        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit,
            'filename' => $fileName,
            'filepath' => '/storage/' . $filePath
        ]);

        if ($request->hasFile('gallery')) {
            foreach($request->file('gallery') as $key => $file){
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                Gallery::create([
                    'nama_galeri' => $fileName,
                    'path' => '/storage/'. $filePath,
                    'foto' => $fileName,
                    'buku_id' => $id
                ]);
            }
        }

        return redirect('/dashboard')->with('pesanupdate', 'Buku berhasil diupdate!');
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

    public function upload(Request $request)
    {
        $request->validate([
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $fileName = time().'_'.$request->thumbnail->getClientOriginalName();
        $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');

        // Simpan informasi gambar ke database jika diperlukan
        // Contoh:
        // $buku = Buku::find($request->buku_id);
        // $buku->update(['thumbnail' => $filePath]);

        return back()->with('success', 'Gambar berhasil diunggah!');
    }

}
