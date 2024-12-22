<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
</head>

@vite(['resources/js/app.js', 'resources/css/app.css'])

<body>
    <div id="app" class="max-w-7xl px-6 w-full mx-auto flex flex-col h-screen">
        {{ $slot }}
    </div>
</body>

</html>