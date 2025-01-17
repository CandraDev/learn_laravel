<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class SiswasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $siswas = Siswa::all();
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('siswa.index', compact('siswas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        toast('Student has been registered', 'success');
        Siswa::create($request->all());

        // dd($request->all());

        Alert::success('Action Success!', 'Student has been registered.');

        // $title = 'Delete User!';
        // $text = "Are you sure you want to delete?";
        // confirmDelete($title, $text);

        return redirect()->route('siswa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);

        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        $siswa->update($request->all());
        toast('Student has been updated.', 'info');

        Alert::success('Action Success!', 'Student has been updated.');


        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa  berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        toast('Data siswa  berhasil dihapus ', 'warning');


        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa  berhasil dihapus');
    }
}
