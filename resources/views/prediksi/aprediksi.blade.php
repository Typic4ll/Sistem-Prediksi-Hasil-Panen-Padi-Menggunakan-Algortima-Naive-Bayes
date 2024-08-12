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
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Prediksi Hasil Panen</h5>

            <?php if (isset($prediksi)): ?>
                <div class="alert alert-<?= ($prediksi === 'Meningkat') ? 'success' : 'danger' ?>" role="alert">
                    <strong>Prediksi Hasil Panen : <?= $prediksi; ?></strong><br>
                    <strong>Nilai Probabilitas Meningkat : <?= $posterior_meningkat; ?></strong><br>
                    <strong>Nilai Probabilitas Menurun : <?= $posterior_menurun; ?></strong><br>
                    <a href="{{ url('/lihat-detail') }}">Lihat Detail</a>
                </div>
            <?php endif; ?>

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

</body>

</html>