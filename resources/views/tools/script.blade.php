<script src="{{ asset('template/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('template/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('template/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('template/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('template/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('template/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('template/vendor/php-email-form/validate.js') }}"></script>
<!-- JS jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- JS Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#selectPetani').select2({
            placeholder: "Cari Nama Petani...",
            allowClear: true,
        });
    });
</script>

<!-- Template Main JS File -->
<script src="{{ asset('template/js/main.js') }}"></script>