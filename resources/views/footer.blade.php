<script src="/public/js/chart.js"></script>
<script src="/public/js/toolkit.js"></script>
<script src="/public/js/application.js"></script>
<script>
    $(function () {
        if (window.BS && window.BS.loader && window.BS.loader.length) {
            while (BS.loader.length) {
                (BS.loader.pop())()
            }
        }
    })
</script>