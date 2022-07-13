<?php

namespace App\Http\Controllers;

use App\Models\Calon;
use App\Models\Jurusan;
use Redirect;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CalonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kirim = [
            'dataCalon' => Calon::with('jurusan')->orderBy('id', 'DESC')->get()
        ];
        return view('admin.calon.index', $kirim);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $kirim = [
            'dataJurusan' => Jurusan::all()
        ];
        return view('admin.calon.create', $kirim);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'nisn' => 'required|numeric|digits_between:1,12',
            'nama' => 'required|max:50',
            'kelas' => ['required','numeric'],
            'id_jurusan' => ['required'],
            'jenkel' => ['required'],
            'visimisi' => ['required']
        ]);
        if ($request->file('foto')) {
            # code...
            $validatedData['foto'] = $request->file('foto')->store('post-images');
        }

        Calon::create($validatedData);

        return redirect('/admin/calon')->with('success', 'Post berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Calon  $calon
     * @return \Illuminate\Http\Response
     */
    public function show(Calon $calon)
    {
        $where = array('id' => $calon);
        $calon  = Calon::where($where)->first();
 
        return response()->json($calon);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Calon  $calon
     * @return \Illuminate\Http\Response
     */
    public function edit(Calon $calon)
    {
        //
        $data=[
            'dataCalon' => $calon,
            'dataJurusan' => Calon::with('jurusan')->get(),
            'dataJurusanOnly'=> Jurusan::all()
        ];
        return view('Admin.Calon.Edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Calon  $calon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calon $calon)
    {
        //
        return $request;
        $validatedData = $request->validate([
            'nisn' => 'required|numeric|digits_between:1,12',
            'nama' => 'required|max:50',
            'kelas' => ['required','numeric'],
            'id_jurusan' => ['required'],
            'jenkel' => ['required'],
            'visimisi' => ['required']
        ]);

        if ($request->file('foto')) {
            # code...
            if ($request->oldFoto) {
                # code...
                Storage::delete($request->oldFoto);
            }
            $validatedData['foto'] = $request->file('foto')->store('post-images');
        }

        Calon::where('id', $calon->id)
        ->update($validatedData);

        return redirect('admin/calon')->with('success', 'Post berhasil ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calon  $calon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calon $calon)
    {
        //
        if ($calon->foto) {
            # code...
            Storage::delete($calon->foto);
        }
        Calon::destroy($calon->id);
        return redirect('/admin/calon')->with('success', 'Data berhasil dihapus!');
    }
}
