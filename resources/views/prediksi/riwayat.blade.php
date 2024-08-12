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

    @include('tools.usersidebar')

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Riwayat Prediksi</h1>
    </div><!-- End Page Title -->
    
    <section class="section dashboard">
      <div class="row">
        <table class="table table-bordered">
          <tr>
            <td>No</td>
            <td>Nama</td>
            <td>Tanggal Prediksi</td>
            <td>Hasil Prediksi</td>
            <td>Hasil Prediksi (Ton)</td>
            <td>Saran</td>
            <td>Aksi</td>
          </tr>
          <?php $no=1;?>
          <tr>
            @foreach($riwayat as $item)
            <td>{{ $no++ }}</td>
            <td>{{ $item -> nama }}</td>
            <td>{{ $item -> created_at }}</td>
            <td>{{ $item -> hasil }}</td>
            <td>{{ $item -> hasil_numerik }}</td>
            <td>{{ $item -> saran }} coba hubungi <b>{{ $item -> desa -> ppl -> nama}}</b> untuk melakukan konsultasi lebih lanjut selaku penyuluh pertanian lapangan desa anda</td>
            <td><a href="{{ url('lihat-detail-riwayat/' .$item->id) }}" title="Lihat">
              <i class="bi bi-eye"></i>
            </a></td>
            </tr>
            @endforeach
      </table>
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