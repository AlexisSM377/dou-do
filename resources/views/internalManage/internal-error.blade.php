<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Error interno</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <style>
        .boxMain {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
        }
        .subMain {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .title {
            display: block;
            font-size: 1.875rem;
            line-height: 2.25rem;
            font-weight: 600;
        }
        .subtitle {
            display: block;
            margin-top: 0.5rem;
            font-size: 1.25rem;
            line-height: 1.75rem;
        }
        .imgContainer {
            display: flex;
            justify-content: center;
            width: 100%;
        }
        body {
            font-family: ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"
        }
    </style>
</head>

<body class="">
    <div class="boxMain">
        <div class="subMain">
            <span class="title">Problemas internos...</span>
            <span class="subtitle">Por favor, comunícate con el soporte para poder ayudarte.</span>
            <div class="imgContainer">
                <img src="https://i.postimg.cc/Y91Y9jF8/triste.png"
                    alt="" style="width: 18rem;">
            </div>
        </div>
    </div>
</body>

</html>
