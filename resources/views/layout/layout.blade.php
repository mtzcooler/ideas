<!DOCTYPE html>
<html lang="EN">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <link href="https://bootswatch.com/5/sketchy/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    @include('layout.nav')

    <header>
        @yield('header')
    </header>

    <section>
        @yield('content')
    </section>

    <footer style="text-align: center">
        @php
            /** Debugging **/
            //dump(config('app.env'));
            //echo "<script>console.log('APP_ENV: " . config('app.env') . "');</script>";
            //Log::info('APP_ENV: ' . config('app.env'));
        @endphp
        @if (str_starts_with(config('app.env'), 'dev'))
            <div>Ambiente de Desenvolvimento</div>
        @else
            <div>Ambiente de Produção</div>
        @endif
        <div>@copyright {{ date('Y') }}</div>
      </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>
</html>