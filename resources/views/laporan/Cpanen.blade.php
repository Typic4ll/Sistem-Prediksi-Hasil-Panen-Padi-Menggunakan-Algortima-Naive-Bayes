<html>

<head>

    <link href="{{ asset('template/img/bpp.png') }}" rel="icon">
  <link href="{{ asset('template/img/bpp.png') }}" rel="apple-touch-icon">
    <title>Sistem Prediksi Panen Padi | BPP Kecamatan Bati Bati</title>
    <style>
      /* Gaya CSS di sini */
      body {
          font-family: Arial, sans-serif;
          font-size: 12pt;
          margin: 20px;
      }

      h1 {
          text-align: center;
          font-size: 16pt;
          font-weight: bold;
      }

      h2 {
          text-align: center;
          font-size: 14pt;
          font-weight: bold;
      }

      table {
          border-collapse: collapse;
          width: 100%;
      }

      th, td {
          border: 1px solid #ccc;
          padding: 5px;
          text-align: left;
      }

      th {
          background-color: #eee;
          font-weight: bold;
      }
  </style>

</head>

<body>

<div class = "rangkasurat">

     <table>


                 <th> <img src="{{ asset('template/img/bpp.png') }}" width="80px"> </th>

                 <th class = "tengah">

                  <h1>PEMERINTAHAN KABUPATEN TANAH LAUT</h1>

                       <h1>BALAI PENYULUH PERTANIAN</h1>

                       <h1>KECAMATAN BATI BATI</h1>
                 </th>
                 
     </table >
     <th class="tengah">
      <h2>Laporan Hasil Panen Padi Di Kecamatan Bati Bati</h2>
     </th>

     <table class="table1">
      <tr>
          <td>No</td>
          <td>Nama</td>
          <td>Luas Tanam (Ha)</td>
          <td>Kondisi Lahan</td>
          <td>Kondisi Daun</td>
          <td>Hama</td>
          <td>Pupuk(Kg)</td>
          <td>Hasil Panen</td>
      </tr>
      <?php $no=1;?>
      @foreach($panen as $item)
          <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $item -> petani -> nama }}</td>
              <td>{{ $item->hektar }}</td>
              <td>{{ $item->kondisi_lahan }}</td>
              <td>{{ $item->kondisi_daun }}</td>
              <td>{{ $item->hama }}</td>
              <td>{{ $item->kg }}</td>
              <td>{{ $item->ton }}</td>
          </tr>
      @endforeach
  </table>
    </table>
    </div>
</div>

</body>
<script>
  window.print();
</script>

</html>