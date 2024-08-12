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
      <h1>Data Petani</h1>
    </div><!-- End Page Title -->
    
    <div class="d-inline-flex mb-3">
        <a href="{{ url('/tambah-data-petani') }}" class="btn btn-primary">Tambah Data Petani
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
            <td>NIK</td>
            <td>Nama</td>
            <td>Jenis Kelamin</td>
            <td>Kelompok Tani</td>
            <td>Aksi</td>
          </tr>
          <?php $no=1;?>
          <tr>
            @foreach($varpetani as $item)
            <td>{{ $no++ }}</td>
            <td>{{ $item -> id }}</td>
            <td>{{ $item -> nama }}</td>
            <td>{{ $item -> j_kelamin }}</td>
            <td>{{ $item -> poktan }}</td>
            <td>
              <a href="{{ url('edit-data-petani/' .$item->id) }}" title="Edit">
                <i class="bi bi-pencil m-2"></i>
              </a>
              <a href="{{ url('hapus-data-petani/' .$item->id) }}"  title="Hapus">
                <i class="bi bi-trash m-2"></i>
              </a></td>
          </tr>
          @endforeach
      </table>
      </div>
    </section>
    <div class="pagination justify-content-end">
      {{ $varpetani->links() }}
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