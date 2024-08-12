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
      <h1>Data Uji</h1>
    </div><!-- End Page Title -->
    
    <div class="d-inline-flex mb-3">
        <a href="{{ url('/tambah-data-uji') }}" class="btn btn-primary">Tambah Data Uji
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
            <td>Aksi</td>
          </tr>
          <?php $no=1;?>
          <tr>
            @foreach($varuji as $item)
            <td>{{ $no++ }}</td>
            <td>{{ $item -> petani -> nama }}</td>
            <td>{{ $item -> luas_tanam }}</td>
            <td>{{ $item -> kondisi_lahan }}</td>
            <td>{{ $item -> kondisi_daun }}</td>
            <td>{{ $item -> pupuk }}</td>
            <td>{{ $item -> hama }}</td>
            <td>{{ $item -> hasil }}</td>
            <td>
              <a href="{{ url('edit-data-uji/' .$item->id) }}" title="Edit">
                <i class="bi bi-pencil m-2"></i>
              </a>
              <a href="{{ url('hapus-data-uji/' .$item->id) }}"  title="Hapus">
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