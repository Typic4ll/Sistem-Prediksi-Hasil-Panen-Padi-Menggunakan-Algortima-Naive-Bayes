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
            <h5 class="card-title">Edit Data Panen</h5>
            <form action="{{ url('perubahan-data-panen/' .$varpanen->id) }}" method="post" class="row g-3">
                {{ csrf_field() }}
                <div class="col-12">
                    <label class="form-label">Nama Petani</label>
                    <select name="nik_petani" class="form-control form-control-user" disabled>
                        <option value="" disabled selected>{{ $varpanen -> petani -> nama }}</option>
                        @foreach ($petani as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label class="form-label">Luas Tanam</label>
                    <input type="text" name="luas_tanam" placeholder="Masukkan Luas Tanam (Ha)" class="form-control"  autocomplete="off">
                </div> 
                <div class="col-12">
                    <label class="form-label">Kondisi Lahan</label>
                    <select type="text" name="kondisi_lahan" class="form-control form-control-user" placeholder="Perihal">
                        <option value="" disabled selected>Kondisi Lahan</option>
                            <option value="Bagus">Bagus</option>
                            <option value="Banjir">Banjir</option>
                            <option value="kering">Kering</option>
                    </select>
                </div>  
                <div class="col-12">
                    <label class="form-label">Kondisi Daun</label>
                    <select type="text" name="kondisi_daun" class="form-control form-control-user" placeholder="Perihal">
                        <option value="" disabled selected>Kondisi Daun</option>
                            <option value="Hijau Sehat">Hijau Sehat</option>
                            <option value="Kuning Layu">Kuning Layu</option>
                    </select>
                </div> 
                <div class="col-12">
                    <label class="form-label">Hama</label>
                    <select type="text" name="hama" class="form-control form-control-user" placeholder="Perihal">
                        <option value="" disabled selected>Hama</option>
                            <option value="Tidak Terserang">Tidak Terserang</option>
                            <option value="Terserang">Terserang</option>
                    </select>
                </div> 
                <div class="col-12">
                    <label class="form-label">Pupuk</label>
                    <input type="number" name="pupuk" placeholder="Masukkan Pupuk Yang Digunakan Dalam Satuan Kg" class="form-control"  autocomplete="off">
                </div> 
                <div class="col-12">
                    <label class="form-label">Hasil Panen Padi</label>
                    <input type="text" name="hasil" placeholder="Masukkan Hasil Panen Padi Dalam Satuan Ton" class="form-control"  autocomplete="off">
                </div>   
                <div class="text">
                    <button type="submit" name="simpan" class="btn btn-success">Simpan</button> 
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
    $(document).ready(function() {
        $('#selectPetani').select2({
            placeholder: "{{ $varpanen -> petani -> nama }}",
            allowClear: true,
        });
    });
</script>
</body>

</html>