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
      <h1>Penyuluh Pertanian Lapangan</h1>
    </div><!-- End Page Title -->
    
    <div class="d-inline-flex mb-3">
        <a href="{{ url('/tambah-data-ppl') }}" class="btn btn-primary">Tambah Data Penyuluh
        </a>
    </div>
    <section class="section dashboard">
      <div class="row">
        <table class="table table-bordered">
          <tr>
            <td>No</td>
            <td>NIP</td>
            <td>Nama</td>
            <td>Jenis Kelamin</td>
            <td>Jabatan</td>
            <td>Golongan</td>
            <td>No Telpon</td>
            <td>Aksi</td>
          </tr>
          <?php $no=1;?>
          <tr>
            @foreach($varPpl as $item)
            <td>{{ $no++ }}</td>
            <td>{{ $item -> id }}</td>
            <td>{{ $item -> nama }}</td>
            <td>{{ $item -> j_kelamin }}</td>
            <td>{{ $item -> jabatan }}</td>
            <td>{{ $item -> golongan}}</td>
            <td>{{ $item -> telpon}}</td>
            <td>
                <a href="{{ url('edit-data-ppl/' .$item->id) }}" title="Edit">
                  <i class="bi bi-pencil m-2"></i>
                </a>
                <a href="{{ url('hapus-data-ppl/' .$item->id) }}"  title="Hapus">
                  <i class="bi bi-trash m-2"></i>
                </a></td>
          </tr>
          @endforeach
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