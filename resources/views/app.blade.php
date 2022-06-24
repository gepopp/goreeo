<!DOCTYPE html>
<html lang="de" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Goreeo</title>

        <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
        <script src="{{ mix('/js/app.js') }}" defer></script>
        @routes
        @inertiaHead
    </head>
    <body class="antialiased scroll-smooth">
    @inertia
    </body>
</html>
