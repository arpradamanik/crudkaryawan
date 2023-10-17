<body>

<div class="container">
    <div class="bg-info" >
        <h1 class="text-center">Teacher form</h1>
    </div>
    <form class="row g-3" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Name</label>
          <input type="text" class="form-control" name="karyawan_name" value="{{$karyawan->karyawan_name}}"  id="inputEmail4">
        
        </div>
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Kebun/Unit</label>
          <input type="text" class="form-control" name="karyawan_kebun" value="{{$karyawan->karyawan_kebun}}"  id="inputEmail4">
        
        </div>
        <div class="col-md-6">
          <label for="inputEmail4" class="form-label">Jenis Lisensi</label>
          <input type="text" class="form-control" name="karyawan_jenis" value="{{$karyawan->karyawan_jenis}}"  id="inputEmail4">
        
        </div>
        <div class="col-md-6">
          <label for="inputPassword4" class="form-label">Nomor Lisensi</label>
          <input type="text" name="karyawan_nomor" class="form-control" value="{{$karyawan->karyawan_nomor}}" id="inputPassword4">
         
        </div>
        <div class="col-md-6">
          <label for="inputPassword4" class="form-label">Tanggal</label>
          <input type="text" name="karyawan_tanggal" class="form-control text-uppercase" value="{{$karyawan->karyawan_tanggal}}" id="inputPassword4">
         
        </div>
      
        <div class="col-md-6">
          <label for="inputCity" class="form-label">Masa Berlaku</label>
          <input type="text" class="form-control" name="karyawan_masa" value="{{$karyawan->karyawan_masa}}" id="inputCity">
        </div>

        <div class="col-md-3">
          <img src="{{Storage::url($karyawan->foto)}}" class="img-fluid" alt="">
        </div>

        <div class="col-md-6">
          <label for="inputPassword4" class="form-label">Ubah Foto</label>
          <input type="file" name="foto" class="form-control" id="inputPassword4">
        </div>
        
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
</div>

</body>