@extends('main', $meta = [
            'title' => 'Bioritmic',
            'description' => 'Новый подход к знакомству!',
            'keywords' => 'знакомства, онлайн',
        ])
@section('content')
    <div class="container main">
        <div class="row">
            <div class="col-md-12">
                <div class="welcome">
                    <h1>Мы скоро все починим =)</h1>
                    <p>
                        Можете пока зайти сюда <a href="{{ route('main') }}"> Bioritmic </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop