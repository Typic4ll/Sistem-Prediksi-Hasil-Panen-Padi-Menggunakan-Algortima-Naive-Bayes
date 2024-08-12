<!DOCTYPE html>
<html lang="en">

<head>
  @include('tools.head')
</head>

<body>

  <!-- ======= Header ======= -->
  @include('tools.header')
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  @include('tools.sidebar')
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
        <div class="col-xxl-2 col-md-4">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Data Petani</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-person"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $petani }}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-2 col-md-4">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Laporan Hasil Prediksi</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-bar-chart"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $prediksi }}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xxl-2 col-md-4">
          <div class="card info-card sales-card">
            <div class="card-body">
              <h5 class="card-title">Penyuluh Pertanian</h5>
              <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-person-check"></i>
                </div>
                <div class="ps-3">
                  <h6>{{ $ppl }}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('tools.footer')
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
 @include('tools.script')

</body>

</html>