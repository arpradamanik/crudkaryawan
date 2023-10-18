<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Imports\KaryawanImport;
use App\Models\karyawan;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;


class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(Request $request)
    {
        // return view('karyawan.create');
        
        $search =  $request['search'] ?? "";
        if ($search !="") {
            $karyawan = DB::table('karyawan')->where('karyawan_name','LIKE',"%$search%")->get();
        }else{
            $karyawan = DB::table('karyawan')->paginate(20);
        }
        $data = compact('karyawan','search');
        return view('karyawan.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)

    {
        $search =  $request['search'] ?? "";
        if ($search !="") {
            $karyawan = DB::table('karyawan')->where('karyawan_name','LIKE',"%$search%")->get();
        }else{

            $karyawan = DB::table('karyawan')->paginate(20);
        }
        $data = compact('karyawan','search');
        return view('karyawan.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'karyawan_name' => 'required',
                'karyawan_kebun' => 'required',
                'karyawan_jenis' => 'required',
                'karyawan_nomor' => 'required',
                'karyawan_tanggal' => 'required',
                'karyawan_masa' => 'required',
                'karyawan_foto' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            ]
        );

        // $foto = $request->file('karyawan_foto')->store('image', 'public');
        $fileUpload = $request->file('karyawan_foto');
        $namaFile = time() . rand(100, 10000) . '.' . $fileUpload->getClientOriginalExtension();
        $fileUpload->move(public_path() . '/image', $namaFile);

        $karyawan = new karyawan;
        $karyawan->karyawan_name = $request['karyawan_name'];
        $karyawan->karyawan_kebun = $request['karyawan_kebun'];
        $karyawan->karyawan_jenis = $request['karyawan_jenis'];
        $karyawan->karyawan_nomor = $request['karyawan_nomor'];
        $karyawan->karyawan_tanggal = $request['karyawan_tanggal'];
        $karyawan->karyawan_masa = $request['karyawan_masa'];
        $karyawan->karyawan_foto = $namaFile;
        $karyawan->save();
        return redirect('/karyawan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $karyawan = karyawan::where('id', $id)->first();
        $data = compact('karyawan');
        return view('karyawan.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $karyawan = karyawan::find($request->id);
        $foto_old = $karyawan->karyawan_foto;

        if($request->karyawan_foto){
            // dd('ada');
            // $foto = $request->file('foto')->store('image', 'public');
            // $karyawan->karyawan_foto = $foto;

            $namaFile = $karyawan->karyawan_foto;
            $fileUpload = $request->karyawan_foto;
            $fotoPath = public_path() . '/image/' . $namaFile;

            // cek file di dalam local storage
            if (File::exists($fotoPath)) {
                File::delete($fotoPath); // hapus file

                // memecah nama file
                $pecahNamaFile = explode('.', $namaFile);
                $namaFile = $pecahNamaFile[0] . '.' . $fileUpload->getClientOriginalExtension(); // ganti ekstensi
            } else {
                // buat nama file baru
                $namaFile = time() . rand(100, 10000) . '.' . $fileUpload->getClientOriginalExtension();
            }

            // simpan file ke dalam local storage
            $fileUpload->move(public_path() . '/image/', $namaFile);

            // simpan ke dalam database
            $karyawan->karyawan_name = $request['karyawan_name'];
            $karyawan->karyawan_kebun = $request['karyawan_kebun'];
            $karyawan->karyawan_jenis = $request['karyawan_jenis'];
            $karyawan->karyawan_nomor = $request['karyawan_nomor'];
            $karyawan->karyawan_tanggal = $request['karyawan_tanggal'];
            $karyawan->karyawan_masa = $request['karyawan_masa'];
            $karyawan->karyawan_foto = $namaFile;
            $karyawan->save();
        } else {

            $karyawan->karyawan_name = $request['karyawan_name'];
            $karyawan->karyawan_kebun = $request['karyawan_kebun'];
            $karyawan->karyawan_jenis = $request['karyawan_jenis'];
            $karyawan->karyawan_nomor = $request['karyawan_nomor'];
            $karyawan->karyawan_tanggal = $request['karyawan_tanggal'];
            $karyawan->karyawan_masa = $request['karyawan_masa'];
            $karyawan->karyawan_foto = $foto_old;
            $karyawan->save();
        }

        return redirect('/karyawan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataKaryawan = karyawan::find($id);
        $fotoPath = public_path() . '/image/' . $dataKaryawan->karyawan_foto;

        // jika file ditemukan, maka hapus dari local storage
        if ($dataKaryawan->karyawan_foto && File::exists($fotoPath)) {
            File::delete($fotoPath); // hapus file
        }
        // echo $id;
        karyawan::find($id)->delete();
        return redirect()->back();
    }

    public function importexcel(Request $request){
        $file = $request->file('file');
        Excel::import(new KaryawanImport, $file);
        return redirect()->back()->with('success', 'Data berhasil diimpor.');
    }

}
