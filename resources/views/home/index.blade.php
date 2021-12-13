<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        .even-text-end:nth-child(even) {
            text-align: right;
        }
    </style>
    <title>{{ $title }}</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
        <a class="navbar-brand">{{ __('Api') }}</a>
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                    {{ __('Source') }}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a @class([
                        'dropdown-item',
                        'active' => request()->is('lenta')
                        ]) href="{{ route('home', ['api'=>'lenta']) }}">News: Lenta.ru</a>
                    <a @class([
                        'dropdown-item',
                        'active' => request()->is('maybelline')
                        ])
                        href="{{ route('home', ['api'=>'maybelline']) }}">Products: Maybelline</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1>{{ $title }}</h1>
        <div class="row">
            @if(!empty($items->items()))
                @foreach($items->items() as $item)
                <div class="col-4 mb-4">
                    <div class="card">
                        <img src="{{ $item->img }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            @if(!empty($item->description))
                            <p class="card-text">{{ $item->description }}</p>
                            @endif
                            <a target="_blank" href="{{ $item->guid }}" class="btn btn-primary">Read...</a>
                        </div>
                        <div class="card-footer">

                            <div class="row no-gutters row-cols-2">
                                <small class="even-text-end text-muted">Date: {{ $item->pubDate }}</small>
                                @if(!empty($item->author))
                                <small class="even-text-end text-muted">Author: {{ $item->author }}</small>
                                @endif
                                @if(!empty($item->price))
                                <small class="even-text-end text-muted">Price: {{ $item->price }}</small>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col mt-4">
                    <p class="text-center lead">
                        Choose an Api resource!
                    </p>
                </div>
            @endif
        </div>
        {{ $items->links() }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</body>
</html>
