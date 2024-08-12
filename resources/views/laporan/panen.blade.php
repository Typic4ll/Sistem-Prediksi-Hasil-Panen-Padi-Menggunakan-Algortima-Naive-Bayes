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
      <h1>Data Panen</h1>
    </div><!-- End Page Title -->
    
    <div class="d-inline-flex mb-3">
        <a href="{{ url('/cetak-data-panen') }}" class="btn btn-primary" target="_blank">Cetak Data Panen
        </a>
    </div>
    <section class="section dashboard">
      <div class="row">
        <table class="table table-bordered">
          <tr>
            <td>No</td>
            <td>Nama</td>
            <td>Luas Tanam</td>
            <td>Kondisi Lahan</td>
            <td>Kondisi Daun</td>
            <td>Pupuk</td>
            <td>Hama</td>
            <td>Hasil Panen</td>
          </tr>
          <?php $no=1;?>
          <tr>
            @foreach($panen as $item)
            <td>{{ $no++ }}</td>
            <td>{{ $item -> petani -> nama }}</td>
            <td>{{ $item -> hektar }} Ha</td>
            <td>{{ $item -> kondisi_lahan }}</td>
            <td>{{ $item -> kondisi_daun }}</td>
            <td>{{ $item -> kg }} Kg</td>
            <td>{{ $item -> hama }}</td>
            <td>{{ $item -> ton }} Ton</td>
          </tr>
          @endforeach
      </table>
      </div>
    </section>
    <div class="pagination justify-content-end">
      {{ $panen->links() }}
    </div>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    @include('tools.footer')
  </footer><!-- End Footer -->

  <!-- Vendor JS Files -->
  @include('tools.script')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>