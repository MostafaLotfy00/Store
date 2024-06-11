
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('back-assets') }}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('back-assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('back-assets') }}/dist/js/adminlte.min.js"></script>
<script>
    const userId= "{{ Auth::id() }}"
</script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script>
    var inputElm = document.querySelector('[name=tags]'),
    tagify = new Tagify (inputElm);
    </script>
