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

    <section class="section dashboard">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Chart Prediksi Hasil Panen Padi</h5>

            <!-- Column Chart -->
            <div id="columnChart"></div>

            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new ApexCharts(document.querySelector("#columnChart"), {
                  series: [{
                    name: 'Meningkat',
                    data: [{{ $meningkat }}]
                  }, {
                    name: 'Menurun',
                    data: [{{ $menurun }}]
                  }],
                  chart: {
                    type: 'bar',
                    height: 350
                  },
                  colors: ['#00E396', '#FF4560'],
                  plotOptions: {
                    bar: {
                      horizontal: false,
                      columnWidth: '55%',
                      endingShape: 'rounded'
                    },
                  },
                  dataLabels: {
                    enabled: false
                  },
                  stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                  },
                  xaxis: {
                    categories: ['Prediksi Hasil Panen Padi'],
                  },
                  yaxis: {
                    title: {
                      text: ''
                    }
                  },
                  fill: {
                    opacity: 1
                  },
                  tooltip: {
                    y: {
                      formatter: function(val) {
                        return  val + " Data"
                      }
                    }
                  }
                }).render();
              });
            </script>
            <!-- End Column Chart -->

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