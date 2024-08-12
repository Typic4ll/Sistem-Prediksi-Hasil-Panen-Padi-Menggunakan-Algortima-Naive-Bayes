<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="{{ url('/') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ url('data-petani') }}">
        <i class="bi bi-person"></i>
        <span>Data Petani</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ url('data-panen') }}">
        <i class="bi bi-clipboard2-data"></i>
        <span>Data Panen</span>
      </a>
    </li><!-- End Profile Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ url('data-uji') }}">
        <i class="bi bi-file-earmark"></i>
        <span>Data Uji</span>
      </a>
    </li><!-- End F.A.Q Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ url('performance') }}">
        <i class="bi bi-browser-safari"></i>
        <span>Performance</span>
      </a>
    </li><!-- End Contact Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ url('data-ppl') }}">
        <i class="bi bi-person-gear"></i>
        <span>PPL</span>
      </a>
    </li><!-- End Register Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ url('data-desa') }}">
        <i class="bi bi-building"></i>
        <span>Desa</span>
      </a>
    </li>

    {{-- <li class="nav-item">
      <a class="nav-link collapsed" href="{{ url('prediksi') }}">
        <i class="bi bi-graph-up"></i>
        <span>Prediksi Naive Bayes</span>
      </a>
    </li><!-- End Error 404 Page Nav --> --}}
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ url('laporan-prediksi') }}">
              <i class="bi bi-archive-fill"></i></i><span>Laporan Hasil Prediksi</span>
            </a>
          </li>
          <li>
            <a href="{{ url('chart-prediksi') }}">
              <i class="bi bi-archive-fill"></i></i><span>Chart Hasil Prediksi</span>
            </a>
          </li>
          <li>
            <a href="{{ url('laporan-panen') }}">
              <i class="bi bi-archive-fill"></i></i><span>Laporan Panen</span>
            </a>
          </li>
        </ul>
    </li><!-- End Blank Page Nav -->

  </ul>

</aside>