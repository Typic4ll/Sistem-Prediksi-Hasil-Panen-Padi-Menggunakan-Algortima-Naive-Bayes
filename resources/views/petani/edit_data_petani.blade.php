<!DOCTYPE html>
<html lang="en">

<head>
    @include('tools.head')
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    @include('tools.header')

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    @include('tools.sidebar')

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Edit Data Petani</h5>
            <form action="{{ url('perubahan-data-petani/' .$varpetani->id) }}" method="post" class="row g-3">
                {{ csrf_field() }}
                <div class="col-12">
                    <label class="form-label">NIK</label>
                    <input type="text" name="id" placeholder="Masukkan NIK" value="{{ $varpetani->id}}" class="form-control"  autocomplete="off">
                </div> 
                <div class="col-12">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" value="{{ $varpetani->nama}}" class="form-control"  autocomplete="off">
                </div> 
                <div class="col-12">
                    <label class="form-label">jenis Kelamin</label>
                    <select type="text" name="j_kelamin" class="form-control form-control-user" placeholder="Jenis Kelamin">
                        <option value="{{ $varpetani->j_kelamin}}" disabled selected>{{ $varpetani->j_kelamin}}</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                    </select>
                </div>  
                <div class="col-12">
                    <label class="form-label">Kelompok Tani</label>
                    <input type="text" name="poktan" placeholder="Masukkan Kelompok Tani Yang Di Ikuti" value="{{ $varpetani->poktan}}" class="form-control"  autocomplete="off">
                </div>   
                <div class="text">
                    <button type="submit" name="simpan" class="btn btn-success">Simpan</button> 
                </div>                                      
            </form>
            </div>
        </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    @include('tools.footer')
  </footer><!-- End Footer -->

  <!-- Vendor JS Files -->
  @include('tools.script')

</body>

</html>