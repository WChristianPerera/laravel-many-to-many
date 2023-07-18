<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    @vite('resources/js/app.js')
</head>
<body>
    @include('admin.includes.header')

    <div class="container">
        <main>
            @yield('contents')
        </main>
    </div>

    @include('admin.includes.header')
</body>
</html>