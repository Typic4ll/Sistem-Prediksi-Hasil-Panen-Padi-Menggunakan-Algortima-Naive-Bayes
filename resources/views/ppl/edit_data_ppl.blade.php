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
            <h5 class="card-title">Edit Data Penyuluh Pertanian Lapangan</h5>
            <form action="{{ url('perubahan-data-ppl/' .$varppl->id) }}" method="post" class="row g-3">
                {{ csrf_field() }}
                <div class="col-12">
                    <label class="form-label">NIP</label>
                    <input type="number" name="id" placeholder="Masukkan NIP Penyuluh" value="{{ $varppl->id}}" class="form-control"  autocomplete="off">
                </div> 
                <div class="col-12">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Masukkan Nama dan Gelar Penyuluh" value="{{ $varppl->nama}}" class="form-control"  autocomplete="off">
                </div> 
                <div class="col-12">
                    <label class="form-label">jenis Kelamin</label>
                    <select type="text" name="j_kelamin" class="form-control form-control-user" placeholder="Perihal">
                        <option>{{ $varppl->j_kelamin}}</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                    </select>
                </div> 
                <div class="col-12">
                    <label class="form-label">Jabatan</label>
                    <input type="text" name="jabatan" placeholder="Masukkan Jabatan Penyuluh" value="{{ $varppl->jabatan}}" class="form-control"  autocomplete="off">
                </div> 
                <div class="col-12">
                    <label class="form-label">Golongan</label>
                    <input type="text" name="golongan" placeholder="Masukkan Golongan Penyuluh" value="{{ $varppl->golongan}}" class="form-control"  autocomplete="off">
                </div>  
                <div class="col-12">
                    <label class="form-label">No Telpon</label>
                    <input type="number" name="telpon" placeholder="Masukkan No Telpon" value="{{ $varppl->telpon}}" class="form-control"  autocomplete="off">
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