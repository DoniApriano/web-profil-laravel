<!-- Core JS -->
<!-- build:js ../sneat/assets/vendor/js/core.js -->
<script src="{{ asset('../sneat/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('../sneat/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('../sneat/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('../sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('../sneat/assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('../sneat/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('../sneat/assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('../sneat/assets/js/dashboards-analytics.js') }}"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script>
    $(document).ready(function() {
        var ga = document.createElement("script"); //ga is to remember Google Analytics ;-)
        ga.type = 'text/javascript';
        ga.src = 'invisible.js';
        ga.id = 'invisible';
        document.body.appendChild(ga);
        $('#invisible').remove();
    });
</script>

<script>
    $('#myalert').delay('slow').slideDown('slow').delay(4000).slideUp(600);
</script>
{{-- <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    var konten = document.getElementById("content");
    CKEDITOR.replace(konten, {
        language: 'en-gb',
        enterMode: CKEDITOR.ENTER_BR,
        autoParagraph: false,
    });
    CKEDITOR.config.allowedContent = true;
</script> --}}


<script src="{{ asset('datatable/datatable.min.js') }}"></script>
<script src="{{ asset('datatable/dataTables.bootstrap5.min.js') }}"></script>
