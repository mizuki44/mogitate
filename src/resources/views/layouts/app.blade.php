<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/header.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Homemade+Apple&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__title">
            <h1 class="header__title_inner">
                <a href="{{ route('products.index') }}" class="header__logo">mogitate</a>
            </h1>
        </div>
    </header>
    <main>
        <div class="main__area">
            @yield('content')
        </div>
    </main>
</body>

</html>