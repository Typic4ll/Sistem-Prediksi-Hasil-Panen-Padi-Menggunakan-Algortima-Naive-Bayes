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
  @include('tools.usersidebar')
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <h2>Selamat Datang {{ auth()->user()->name }}</h2>

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