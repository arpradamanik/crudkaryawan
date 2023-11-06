@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Selamat Datang') }}</div>

                <div class="card-body">
                <form class="d-flex mb-5" action="home" method="get">
                @csrf
                <input class="form-control me-2" value="{{$search}}" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Cari</button>
                </form>
                    @if ($karyawan)
                    <table class="table table-success">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Kebun/Unit</th>
                            <th scope="col">Jenis Lisensi</th>
                            <th scope="col">Nomor lisensi</th>
                            <th scope="col">Tanggal Lisensi</th>
                            <th scope="col">Masa Berlaku</th>
                            <th scope="col">Foto Lisensi</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($karyawan as $item)
                            <tr>
                                <td scope="row">{{$item->karyawan_name}}</td>
                                <td scope="row">{{$item->karyawan_kebun}}</td>
                                <td scope="row">{{$item->karyawan_jenis}}</td>
                                <td scope="row">{{$item->karyawan_nomor}}</td>
                                <td scope="row">{{$item->karyawan_tanggal}}</td>
                                <td scope="row">{{$item->karyawan_masa}}</td>
                                <td scope="row">
                                @if($item->karyawan_foto)
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#foto{{$item->id}}">Lihat</button>
                                {{-- <a href="{{asset('image/'.$item->karyawan_foto)}}" target="_blank">lihat</a> --}}
                                @endif

                                <div class="modal fade" id="foto{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content modal-content-lg">
                                    <div class="modal-body">
                                        <img src="{{asset('image/'.$item->karyawan_foto)}}" class="img-fluid" alt="">
                                    </div>
                                    </div>
                                </div>
                                </div>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    {{ $hasil?? '' }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
