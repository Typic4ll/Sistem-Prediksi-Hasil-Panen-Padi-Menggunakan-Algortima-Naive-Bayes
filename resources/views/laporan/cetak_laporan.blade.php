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
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cetak Laporan</h5>
                        <form action="" method="get" class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Tanggal Awal</label>
                                <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Tanggal Akhir</label>
                                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Nama Petani</label>
                                <input type="text" name="nama_petani" id="nama_petani" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Desa</label>
                                <select name="desa_id" id="desa_id" class="form-control">
                                    <option value="">Semua Desa</option>
                                    @foreach ($desa as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_desa }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <button type="button" onclick="cetakLaporan()" class="btn btn-primary">Cetak</button>
                            </div>
                        </form>
                    </div>
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

    <script>
        function cetakLaporan() {
          var tanggalAwal = document.getElementById('tanggal_awal').value;
    var tanggalAkhir = document.getElementById('tanggal_akhir').value;
    var namaPetani = document.getElementById('nama_petani').value.trim();
    var desaId = document.getElementById('desa_id').value;

    var url = 'cetak-laporan/' + tanggalAwal + '/' + tanggalAkhir;
    
    // Hanya tambahkan parameter nama_petani jika tidak kosong
    if (namaPetani) {
        url += '/' + encodeURIComponent(namaPetani);
    } else {
        url += '/-';
    }

    // Selalu tambahkan parameter desa_id, bahkan jika kosong
    url += '/' + (desaId ? encodeURIComponent(desaId) : '');

    window.open(url, '_blank');
        }
    </script>
</body>
</html>