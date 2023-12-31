@extends ('layouts.app')

@section('content')

      <h2>Mahasiswa</h2>
      <body>
    <div class="container mt-5">
    <div class="col-auto">
                      <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Import data
          </button>
                <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="/importexcel" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="modal-body">
                <div class="form-grup">
                  <input type="file" name="file" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </form>
          </div>
        </div>
      <form class="d-flex mb-5" >
        <input class="form-control me-2" value="{{$search}}" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Cari</button>
      </form>
        <table class="table table-success">
            <thead >
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Kebun/Unit</th>
                <th scope="col">Jenis Lisensi</th>
                <th scope="col">Nomor lisensi</th>
                <th scope="col">Tanggal Lisensi</th>
                <th scope="col">Masa Berlaku</th>
                <th scope="col">Foto Lisensi</th>
                <th scope="col">Hapus/Edit</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($karyawan as $item)
                  
                    {{-- {{printarray($karyawan->toArray())}} --}}
              
              <tr>
                <th scope="row">{{$item->karyawan_name}}</th>
                <th scope="row">{{$item->karyawan_kebun}}</th>
                <th scope="row">{{$item->karyawan_jenis}}</th>
                <th scope="row">{{$item->karyawan_nomor}}</th>
                <th scope="row">{{$item->karyawan_tanggal}}</th>
                <th scope="row">{{$item->karyawan_masa}}</th>
                <th scope="row">
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#foto{{$item->karyawanid}}">Lihat</button>
                </th>
                <th scope="row">
                    <a href="{{url('/teacher/delete')}}/{{$item->karyawanid}}"><button class="btn btn-danger">Hapus</button></a>
                   <a href="{{url('/teacher/update')}}/{{$item->karyawanid}}"> <button class="btn btn-success">Edit</button></a>
                </th>

                <div class="modal fade" id="foto{{$item->karyawanid}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content modal-content-lg">
                      <div class="modal-body">
                        <img src="{{url('storage/'.$item->foto)}}" class="img-fluid" alt="">
                      </div>
                    </div>
                  </div>
                </div>
                
              </tr>
              @endforeach
            </tbody>
          </table>

          <div class="row">
            {{-- {{$karyawan->links()}} --}}
            <nav aria-label="...">
              <ul class="pagination">
                
                <li class="page-item disabled">
                              {{-- {{$karyawan->links()}} --}}

                </li>
                
                
              </ul>
            </nav>
          </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
@endsection