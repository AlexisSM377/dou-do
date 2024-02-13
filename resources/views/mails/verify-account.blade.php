<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Correo de verificación</title>

    <style>
        .box-main {
            padding-top: 2.5rem;
            padding-bottom: 2.5rem;
            border-radius: 0.5rem;
            width: 100%;
            background-color: #374151;
        }
        .sub-box-main {
            display: flex;
            padding-bottom: 2rem;
            justify-content: center;
        }
        .title {
            display: block;
            font-size: 3rem;
            line-height: 1;
            font-weight: 700;
            color: #ffffff;
            text-decoration: underline;
        }
        .general-txt {
            font-weight: 600;
            color: #ffffff;
        }
        .thanks-txt {
            display: block;
            margin-bottom: 1rem;
            font-size: 1.5rem;
            line-height: 2rem;
            font-weight: 600;
            text-align: center;
            color: #ffffff;
        }
        .instruction {
            display: block;
            font-size: 1.25rem;
            line-height: 1.75rem;
            font-weight: 600;
            text-align: center;
            color: #ffffff;
        }
        .instruction-two {
            display: block;
            font-size: 1.125rem;
            line-height: 1.75rem;
            color: #ffffff;
        }
        .second-gen-txt {
            display: block;
            font-size: 1.125rem;
            line-height: 1.75rem;
            font-weight: 600;
            color: #ffffff;
        }
        .btn {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            padding-left: 1rem;
            padding-right: 1rem;
            border-radius: 0.75rem;
            font-weight: 600;
            color: #ffffff;
            background-color: #2563EB;
        }
        .btn:hover {
            border-width: 2px;
            border-color: #2563EB;
            color: #2563EB;
            background-color: #ffffff;
        }
        .gen-spacing {
            margin-top: 2.5rem;
            margin-left: 2.5rem;
        }
        body {
            font-family: ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
    </style>
</head>

<body>
    <div class="box-main">
        <div class="sub-box-main">
            <span class="title">DuoDo</span>
        </div>
        <div style="padding: 1rem; width: 100%; background-color: #2563EB; ">
            <div style="display: flex; gap: 0.5rem; justify-content: center; ">
                <span class="general-txt">---</span>
                <span style="display: block; text-align: center; color: #ffffff; ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" style="width: 1.5rem; height: 1.5rem; stroke-width: 2; ">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                </span>
                <span class="general-txt">---</span>
            </div>
            <span class="thanks-txt">¡Gracias por registrarte!</span>
            <span class="instruction">Por favor, verifica tu cuenta de correo
                electrónico.</span>
        </div>
        <div class="gen-spacing">
            <span class="second-gen-txt">Hello Rafa</span>
            <span class="instruction-two">Por favor, da clic en el siguiente botón para poder verificar tu
                cuenta.</span>
        </div>
        <div style="display: flex; margin-top: 3rem; justify-content: center; ">
            <a href="http://"
                class="btn">Verificar
                correo electrónico</a>
        </div>
        <div class="gen-spacing">
            <span class="second-gen-txt">¡Gracias!</span>
            <span class="second-gen-txt">Team DuoDo.</span>
        </div>
    </div>
</body>

</html>