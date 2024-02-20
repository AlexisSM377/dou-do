<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reenviar verificación de cuenta</title>
    <style>
        .boxMain {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
        }
        .boxImg {
            display: flex;
            margin-bottom: 1rem;
            justify-content: center;
            width: 100%;
        }
        .title {
            display: block;
            font-size: 1.5rem;
            line-height: 2rem;
            font-weight: 600;
        }
        .subtitle {
            display: block;
            margin-top: 0.5rem;
            font-size: 1.125rem;
            line-height: 1.75rem;
        }
        .boxForm {
            display: flex;
            margin-top: 1rem;
            flex-direction: column;
            gap: 0.5rem;
        }
        .inputEmail {
            padding-left: 0.5rem;
            border-radius: 0.375rem;
            border-width: 2px;
            border-color: #93C5FD;
            width: 33.333333%;
            font-weight: 600;
            padding-bottom: 5px;
            padding-top: 5px;
            border-style: solid;
        }
        .btn {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            border-radius: 1rem;
            border-width: 2px;
            border-color: #3B82F6;
            font-weight: 600;
            color: #ffffff;
            background-color: #3B82F6;
            cursor: pointer;
            border-style: solid;
        }
        .btn:hover{
            color: #3B82F6;
            background-color: #ffffff;
        }
        .btn:active {
            color: #ffffff;
            background-color: #3B82F6;
        }
        body {
            font-family: ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
    </style>
</head>

<body>
    <div class="boxMain">
        <div>
            <div class="boxImg">
                <img src="https://i.postimg.cc/0j4ygMdc/verificar-removebg-preview.png" alt="" style="width: 18rem;">
            </div>
            <div style="margin-top: 2rem; margin-bottom: 2rem;">
                <hr>
            </div>
            <span class="title">Reenviar verificación de correo electronico</span>
            <span class="subtitle">El tiempo de validación de tu cuenta ha expirado. Ingresa tu correo
                electrónico para poder generar una nueva solicitud de verificación.</span>
            <form action="{{route('verification.resend')}}" method="POST">
                @csrf
                <div class="boxForm">
                    <label for="email">Correo electronico</label>
                    <input type="email" class="inputEmail"
                        name="email" id="email">
                </div>
                <div style="margin-top: 1.5rem;">
                    <button type="submit" class="btn">Generar solicitud</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>