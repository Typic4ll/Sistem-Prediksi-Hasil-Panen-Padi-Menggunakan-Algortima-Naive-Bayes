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
            <h5 class="card-title">Edit Data Desa</h5>
            <form action="{{ url('perubahan-data-desa/' .$vardesa->id) }}" method="post" class="row g-3">
                {{ csrf_field() }}
                <div class="col-12">
                    <label class="form-label">Kode Wilayah</label>
                    <input type="number" name="id" placeholder="Masukkan Kode Wilayah Desa" value="{{ $vardesa->id}}" class="form-control"  autocomplete="off">
                </div> 
                <div class="col-12">
                    <label class="form-label">Nama Desa</label>
                    <input type="text" name="nama_desa" placeholder="Masukkan Nama desa" class="form-control" value="{{ $vardesa->nama_desa}}" autocomplete="off">
                </div> 
                <div class="col-12">
                    <label class="form-label">Penyuluh Pertanian Lapangan</label>
                    <select type="text" name="ppl_id" class="form-control form-control-user" placeholder="Perihal">
                        <option value="" disabled selected>{{ $vardesa -> ppl -> nama }}</option>
                        @foreach ($ppl as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
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