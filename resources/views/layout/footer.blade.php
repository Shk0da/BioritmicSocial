<script src="/public/js/jquery.min.js"></script>
@if (Auth::check())
    <script src="/public/js/toolkit.js"></script>
    <script src="/public/js/cropper.js"></script>
    <script src="/public/js/autobahn.min.js"></script>
    <script src="/public/js/application.js"></script>
    <script>
        wsmessage('{{ \App\Console\Commands\PushServer::HOST }}', '{{ Auth::user()->getMessageKey() }}');
    </script>
@endif