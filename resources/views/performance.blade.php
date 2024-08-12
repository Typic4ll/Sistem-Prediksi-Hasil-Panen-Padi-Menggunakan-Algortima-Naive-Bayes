<!DOCTYPE html>
<html lang="en">
<head>
  @include('tools.head')
</head>
<body>
  <header id="header" class="header fixed-top d-flex align-items-center">
    @include('tools.header')
  </header>
  <aside id="sidebar" class="sidebar">
    @include('tools.sidebar')
  </aside>
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Performance</h1>
    </div>
    <section class="section dashboard">
      <div class="row">
        <table class="table table-bordered">
          <tr>
            <td>Akurasi</td>
            <td>Recall</td>
            <td>precision</td>
          </tr>
          <tr>
            <td style="background-color: rgb(13, 255, 13);"><?= round($akurasi, 2) . '%' ?></td>
            <td style="background-color: rgb(87, 93, 255);"><?= round($recall, 2) . '%' ?></td>
            <td style="background-color: rgb(226, 250, 106);"><?= round($precision, 2) . '%' ?></td>
          </tr>
        </table>
      </div>
      
      <canvas id="barChart" style="max-height: 400px;"></canvas>
      
      <script>
        document.addEventListener("DOMContentLoaded", () => {
          new Chart(document.querySelector('#barChart'), {
            type: 'bar',
            data: {
              labels: ['data latih', 'data uji'],
              datasets: [{
                label: 'total data',
                data: [{{ $total_data_latih }}, {{ $total_data_uji }}],
                backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
                ],
                borderColor: [
                  'rgb(255, 99, 132)',
                  'rgb(255, 159, 64)',
                ],
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });
        });
      </script>

      <div class="row mt-4">
        <h4>Confusion Matrix</h4>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">Predicted Positive</th>
              <th scope="col">Predicted Negative</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Actual Positive</th>
              <td>TP: {{ $TP }}</td>
              <td>FN: {{ $FN }}</td>
            </tr>
            <tr>
              <th scope="row">Actual Negative</th>
              <td>FP: {{ $FP }}</td>
              <td>TN: {{ $TN }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </main>
  <footer id="footer" class="footer">
    @include('tools.footer')
  </footer>
  @include('tools.script')
</body>
</html>