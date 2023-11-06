<?php

namespace App\Http\Controllers;
use App\Models\karyawan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $search =  $request->search;
        // dd($search);
        if ($search !="") {
            $data = DB::table('karyawan')->where('karyawan_name','LIKE',"%$search%")->get();
            $count = DB::table('karyawan')->where('karyawan_name','LIKE',"%$search%")->count();
            if($count){
                $karyawan = $data;
                $hasil = "";
            }else{
                $karyawan = null;
                $hasil = "Data tidak ditemukan";
            }
        }else{
            $karyawan = null;
            $hasil = "";
        }
        // dd($karyawan);
        $data = compact('karyawan', 'hasil', 'search');
        return view('home')->with($data);
    }
}
