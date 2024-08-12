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
      <h1>Dataset Panen</h1>
    </div><!-- End Page Title -->
    
    <div class="d-inline-flex mb-3">
        <a href="{{ url('/tambah-data-panen') }}" class="btn btn-primary">Tambah Dataset Panen
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
            @foreach($varpanen as $item)
            <td>{{ $no++ }}</td>
            <td>{{ $item -> petani -> nama }}</td>
            <td>{{ $item -> luas_tanam }}</td>
            <td>{{ $item -> kondisi_lahan }}</td>
            <td>{{ $item -> kondisi_daun }}</td>
            <td>{{ $item -> pupuk }}</td>
            <td>{{ $item -> hama }}</td>
            <td>{{ $item -> hasil }}</td>
            <td>
              <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">
                <i class="bi bi-eye"></i>
              </button>
              <a href="{{ url('edit-data-panen/' .$item->id) }}" title="Edit">
                <i class="bi bi-pencil m-2"></i>
              </a>
              <a href="{{ url('hapus-data-panen/' .$item->id) }}"  title="Hapus">
                <i class="bi bi-trash m-2"></i>
              </a></td>
          </tr>
          <!-- Modal untuk setiap item -->
<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel{{ $item->id }}">Detail Data Panen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>NIK:</strong> {{ $item->petani->id }}</p>
        <p><strong>Nama:</strong> {{ $item->petani->nama }}</p>
        <p><strong>Kelompok Tani:</strong> {{ $item->petani->poktan }}</p>
        <p><strong>Luas Tanam:</strong> {{ $item->hektar }} Ha</p>
        <p><strong>Kondisi Lahan:</strong> {{ $item->kondisi_lahan }}</p>
        <p><strong>Kondisi Daun:</strong> {{ $item->kondisi_daun }}</p>
        <p><strong>Pupuk:</strong> {{ $item->kg }} Kg</p>
        <p><strong>Hama:</strong> {{ $item->hama }}</p>
        <p><strong>Hasil Panen:</strong> {{ $item->ton }} Ton</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
          @endforeach
      </table>
      </div>
    </section>
    <div class="pagination justify-content-end">
      {{ $varpanen->links() }}
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