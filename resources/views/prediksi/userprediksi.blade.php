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
        <section class="section dashboard">
            <div class="card">
                <div class="card-body">
                    <!-- Notifikasi -->
                    <div class="row">
                        <div class="col-12">
                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- End Notifikasi -->

                    <h5 class="card-title">Prediksi Hasil Panen</h5>

                    <form action="{{ url('/hasil-prediksi-user') }}" method="post" class="row g-3">
                        {{ csrf_field() }}

                        <div class="col-12">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" placeholder="{{ $nama }}" class="form-control" disabled>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Desa</label>
                            <input type="text" name="desa_id" placeholder="{{ $desa->nama_desa }}" class="form-control" disabled>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Luas Tanam</label>
                            <input type="text" name="luas_tanam" placeholder="Masukkan Luas Tanam (Ha)" class="form-control" autocomplete="off">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Kondisi Lahan</label>
                            <select name="kondisi_lahan" class="form-control form-control-user">
                                <option value="" disabled selected>Kondisi Lahan</option>
                                <option value="Bagus">Bagus</option>
                                <option value="Banjir">Banjir</option>
                                <option value="Kering">Kering</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Kondisi Daun</label>
                            <select name="kondisi_daun" class="form-control form-control-user">
                                <option value="" disabled selected>Kondisi Daun</option>
                                <option value="Hijau Sehat">Hijau Sehat</option>
                                <option value="Kuning Layu">Kuning Layu</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Hama</label>
                            <select name="hama" class="form-control form-control-user">
                                <option value="" disabled selected>Hama</option>
                                <option value="Tidak Terserang">Tidak Terserang</option>
                                <option value="Terserang">Terserang</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Pupuk</label>
                            <input type="number" name="pupuk" placeholder="Masukkan Pupuk Yang Digunakan Dalam Satuan Kg" class="form-control" autocomplete="off">
                        </div>

                        <div class="text">
                            <button type="submit" name="simpan" class="btn btn-success">Prediksi</button>
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Lakukan validasi di sini
            var luasTanam = document.querySelector('input[name="luas_tanam"]').value;
            if (!luasTanam) {
                showNotification('error', 'Luas tanam harus diisi.');
                return;
            }
            
            // Jika validasi berhasil, submit form
            this.submit();
        });

        function showNotification(type, message) {
            var alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-' + type + ' alert-dismissible fade show';
            alertDiv.role = 'alert';
            alertDiv.innerHTML = message + 
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            
            var cardBody = document.querySelector('.card-body');
            cardBody.insertBefore(alertDiv, cardBody.firstChild);
        }
    });
    </script>
</body>

</html>