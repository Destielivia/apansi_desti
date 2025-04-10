<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Siswa $siswas)
    {
        $q = $request->input('q');

        $active = 'Siswa';

        $siswas = $siswas->when($q, function($query) use ($q) {
                    return $query->where('nisn', 'like', '%' .$q. '%')
                                 ->orwhere('nik', 'like', '%' .$q. '%')
                                 ->orwhere('nama', 'like', '%' .$q. '%')
                                 ->orwhere('asal_sekolah', 'like', '%' .$q. '%')
                                 ->orwhere('agama', 'like', '%' .$q. '%')
                                 ->orwhere('ttl', 'like', '%' .$q. '%')
                                 ->orwhere('alamat', 'like', '%' .$q. '%')
                                 ->orwhere('jenis_kelamin', 'like', '%' .$q. '%');
                })
        ->paginate(10);
        return view('dashboard/siswa/list', [
            'siswas' => $siswas,
            'request' => $request,
            'active' => $active
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = 'Siswa';
        return view('dashboard/siswa/form', [
            'active' => $active,
            'button' =>'Create',
            'url'    =>'dashboard.siswa.store'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nisn'          => 'required',
            'nik'           => 'required',
            'nama'          => 'required',
            'asal_sekolah'  => 'required',
            'agama'         => 'required',
            'ttl'           => 'required',
            'alamat'        => 'required',
            'jenis_kelamin' => 'required',
            'pas_poto'      => 'required|image',
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->route('dashboard.siswa.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $siswa = new Siswa();
            $image = $request->file('pas_poto');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->putFileAs('public/siswa', $image, $filename,);
            $siswa->pas_poto = $filename;
            
            $siswa->nisn = $request->input('nisn');
            $siswa->nik = $request->input('nik');
            $siswa->nama = $request->input('nama');
            $siswa->asal_sekolah = $request->input('asal_sekolah');
            $siswa->agama = $request->input('agama');
            $siswa->ttl = $request->input('ttl');
            $siswa->alamat = $request->input('alamat');
            $siswa->jenis_kelamin = $request->input('jenis_kelamin');
            $siswa->save();


            return redirect()->route('dashboard.siswa')->with('message', __('message.store', ['nama'=>$request->input('nama')]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
        $active = 'Siswa';
        return view('dashboard/siswa/show',[
            'active' => $active,
            'siswa' => $siswa,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //
        $active = 'Siswa';
        return view('dashboard/Siswa/form', [
            'active' => $active,
            'siswa'  =>$siswa,
            'button' =>'Update',
            'url'    =>'dashboard.siswa.update'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        $validator = validator::make($request->all(), [
            'nisn'              => 'required|numeric',
            'nik'               => 'required|numeric',
            'nama'              => 'required',
            'asal_sekolah'      => 'required',
            'agama'             => 'required',
            'ttl'               => 'required',
            'alamat'            => 'required',
            'jenis_kelamin'     => 'required',
            'pas_poto'          => 'image',
        ]);
    
        if ($validator->fails()) {
            return redirect()
                ->route('dashboard.siswa.update', $siswa->id)
                ->withErrors($validator)
                ->withinput();
        } else {

                if($request->hasfile('pas_poto')){
                    $image = $request->file('pas_poto');
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                        Storage::disk('local')->putFileAs('public/siswa', $image, $filename);
                    $siswa->pas_poto = $filename;
                }
            $siswa->nisn = $request->input('nisn');
            $siswa->nik = $request->input('nik');
            $siswa->nama = $request->input('nama');
            $siswa->asal_sekolah = $request->input('asal_sekolah');
            $siswa->agama = $request->input('agama');
            $siswa->ttl = $request->input('ttl');
            $siswa->alamat = $request->input('alamat');
            $siswa->jenis_kelamin = $request->input('jenis_kelamin');
            $siswa->save();

            return redirect()->route('dashboard.siswa')->with('message', __('message.update', ['nama'=>$request->input('nama')]));;
        }
    
        
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {

        $siswa->delete();
        return redirect()->route('dashboard.siswa')->with('message', __('message.delete', ['nama' => $siswa->nama]));
    }
}
