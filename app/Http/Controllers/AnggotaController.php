<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.tambah');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|max:45',
            'email' => 'required|email:rfc,dns|max:45',
            'hp' => 'required|numeric|digits_between:0,15',
            'foto' => 'required|image|mimes:jpg,bmp,png|max:2048'
        ],
        [
            'nama.required' => 'Nama harus diisi',
            'nama.max' => 'Nama tidak boleh lebih dari 45 karakter',
            'email.required' => 'Email harus disi',
            'email.email' => 'Email harus sesuai',
            'email.max' => 'Email tidak boleh lebih dari 45 karakter',
            'hp.required' => 'No hp harus diisi',
            'hp.numeric' => 'No hp harus angka',
            'hp.digits' => 'No hp tidak boleh lebih dari 15 digit',
            'foto.required' => 'Foto harus diisi',
            'foto.image' => 'File yang harus format jpg, jpeg, png, bmp, gif, svg, atau webp',
            'foto.max'=> 'Ukuran foto tidak boleh lebih 2mb'
        ]);

        $filename = Str::uuid().'.'.$request->foto->extension();
        if ($request->foto->isValid()){
            $request->foto->storeAs('images',$filename);
        };
        
        Anggota::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'hp' => $request->hp,
            'foto' => $filename
        ]);
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('page.detail', ['data' => Anggota::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         return view('page.edit', ['data' => Anggota::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|max:45',
            'email' => 'required|email:rfc,dns|max:45',
            'hp' => 'required|numeric|digits_between:0,15',
            'foto' => 'image|mimes:jpg,bmp,png|max:2048'
        ],
        [
            'nama.required' => 'Nama harus diisi',
            'nama.max' => 'Nama tidak boleh lebih dari 45 karakter',
            'email.required' => 'Email harus disi',
            'email.email' => 'Email harus sesuai',
            'email.max' => 'Email tidak boleh lebih dari 45 karakter',
            'hp.required' => 'No hp harus diisi',
            'hp.numeric' => 'No hp harus angka',
            'hp.digits' => 'No hp tidak boleh lebih dari 15 digit',
            'foto.image' => 'File yang harus format jpg, jpeg, png, bmp, gif, svg, atau webp',
            'foto.max'=> 'Ukuran foto tidak boleh lebih 2mb'
        ]);

        //  TODO : ambil nama foto
        $foto = Anggota::find($id)->foto;
        //  TODO : Cek apakah foto di update atau tidak
        $filename = '';
        if($request->hasFile('foto')){
            //  TODO : jika foto di update, hapus foto sebelumnya di storage
             $filename = Str::uuid().'.'.$request->foto->extension();
             Storage::delete('images/'.$foto);
             if ($request->foto->isValid()){
                //  TODO : ganti foto dengan foto yang sudah di update didalam storage
                $request->foto->storeAs('images',$filename);
            };
        } else {
            $filename = $foto;
        }
        //  TODO : Update query data
        Anggota::where( 'id',$id)->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'hp' => $request->hp,
            'foto' => $filename
        ]);
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $foto = Anggota::find($id)->foto;
        Storage::delete('images/'.$foto);
        Anggota::destroy($id);
        return redirect()->route('home');
    }
}
