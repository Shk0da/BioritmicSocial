<script src="/public/js/jquery.min.js"></script>
@if (Auth::check())

    <script src="/public/js/application.js"></script>

    @if ((Route::currentRouteName() == 'chat'))
        <script>
            wsmessage('{{ \App\Console\Commands\MessagingServer::HOST }}', '{{ Auth::user()->getMessageKey() }}');
        </script>
    @endif
@endif