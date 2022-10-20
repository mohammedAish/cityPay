
<script>
    function loadJS() {
        var head = document.getElementsByTagName('head')[0];
        var js = document.createElement("script");
        js.type = "text/javascript";
        js.src = "{{ asset('assets/admin/js/main.js') }}";
        head.appendChild(js);
    }
</script>
