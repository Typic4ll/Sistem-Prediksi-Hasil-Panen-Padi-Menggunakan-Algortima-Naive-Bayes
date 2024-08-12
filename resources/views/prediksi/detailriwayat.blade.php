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
      <h1>Hasil Prediksi</h1>
    </div><!-- End Page Title -->
    
    <section class="section dashboard">
      <div class="row">
        <table class="table table-bordered">
          <tr>
            <td>Nama</td>
            <td>Luas Tanam</td>
            <td>Kondisi Lahan</td>
            <td>Kondisi Daun</td>
            <td>Hama</td>
            <td>Pupuk</td>
            <td>Hasil Prediksi</td>
            <td>Hasil Prediksi (Ton)</td>
            <td>Saran</td>
          </tr>
          <tr>
            <td>{{ $detail -> nama }}</td>
            <td>{{ $detail -> luas_tanam }}</td>
            <td>{{ $detail -> kondisi_lahan }}</td>
            <td>{{ $detail -> kondisi_daun }}</td>
            <td>{{ $detail -> hama }}</td>
            <td>{{ $detail -> pupuk }}</td>
            <td>{{ $detail -> hasil }}</td>
            <td>{{ $detail -> hasil_numerik }}</td>
            <td>{{ $detail -> saran }} coba hubungi <b>{{ $detail -> desa -> ppl -> nama}}</b>
              , No Telpon <b>{{ $detail -> desa -> ppl -> telpon}}</b> untuk melakukan konsultasi lebih lanjut selaku penyuluh pertanian lapangan desa anda</td>
            </tr>
      </table>
      </div>
    </section>
    {{-- <div class="pagination justify-content-end">
      {{ $varSuratMasuk->links() }}
    </div> --}}
    
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    @include('tools.footer')
  </footer><!-- End Footer -->

  <!-- Vendor JS Files -->
  @include('tools.script')
</body>

</html>