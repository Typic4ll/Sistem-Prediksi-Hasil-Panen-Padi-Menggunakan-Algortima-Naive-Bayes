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

    <div class="pagetitle">
      <h1>Laporan Hasil Prediksi</h1>
    </div><!-- End Page Title -->
    <div class="d-inline-flex mb-3">
      <a href="{{ url('/cetak-laporan') }}" class="btn btn-primary">Cetak Laporan
      </a>
  </div>
    <div class="d-inline-flex" style="padding-left: 480px">
      <form class="" method="get">
        <input type="text" name="search" placeholder="Search" title="Enter search keyword" autocomplete="off">
        <button class="btn btn-primary" type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div>
    
    <section class="section dashboard">
      <div class="row">
        <table class="table table-bordered">
          <tr>
            <td>No</td>
            <td>Nama</td>
            <td>Nama Desa</td>
            <td>Luas Tanam (Ha)</td>
            <td>Kondisi Lahan</td>
            <td>Kondisi Daun</td>
            <td>Hama</td>
            <td>Pupuk(Kg)</td>
            <td>Hasil Prediksi</td>
            {{-- <td>Hasil Prediksi</td> --}}
            <td>Aksi</td>
          </tr>
          <?php $no=1;?>
          <tr>
            @foreach($laporan as $item)
            <td>{{ $no++ }}</td>
            <td>{{ $item -> nama }}</td>
            <td>{{ $item -> desa -> nama_desa}}</td>
            <td>{{ $item -> luas_tanam }}</td>
            <td>{{ $item -> kondisi_lahan }}</td>
            <td>{{ $item -> kondisi_daun }}</td>
            <td>{{ $item -> hama }}</td>
            <td>{{ $item -> pupuk }}</td>
            <td>{{ $item -> hasil }}</td>
            {{-- <td>{{ $item -> hasil_numerik }} Ton</td> --}}
            <td>
              <a href=" {{ url('hapus-data-laporan/' .$item->id) }}"  title="Hapus">
                <i class="bi bi-trash m-2"></i>
              </a></td>
            </tr>
              @endforeach
      </table>
      </div>
    </section>
    <div class="pagination justify-content-end">
      {{ $laporan->links() }}
    </div>
    
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    @include('tools.footer')
  </footer><!-- End Footer -->

  <!-- Vendor JS Files -->
  @include('tools.script')
</body>

</html>