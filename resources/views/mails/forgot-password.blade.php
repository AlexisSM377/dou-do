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
        .title {
            display: block;
            font-size: 3rem;
            line-height: 1;
            font-weight: 700;
            color: #ffffff;
        }
        .title:hover {
            color: #60A5FA;
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
            padding-top: 5px;
            padding-bottom: 5px;
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
        .instruction-three {
            display: block;
            font-size: 1rem;
            line-height: 1.75rem;
            color: #ffffff;
            font-weight: lighter;
        }
        .second-gen-txt {
            display: block;
            font-size: 1.125rem;
            line-height: 1.75rem;
            font-weight: bold;
            color: #ffffff;
        }

        .gen-spacing {
            margin-top: 2.5rem;
            margin-left: 2.5rem;
        }
        .myBtn {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            border-radius: 1rem;
            border: solid 2px white;
            font-weight: 600;
            color: #ffffff;
            text-decoration: none;
        }
        .myBtn:hover {
            border: solid 2px #60A5FA;
            color: #60A5FA;
        }
        body {
            font-family: ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="box-main">
      <div style="text-align: center; width:100%; margin-bottom: 1rem;">
        <span class="title">DuoDo</span>
      </div>
      <div style="background-color: #2563EB; ">
        <span class="thanks-txt">Restablecimiento de contraseña</span>
      </div>
      <div class="gen-spacing">
        <span class="second-gen-txt">Hola {{$name}}!!</span>
        <span class="instruction-two">Recibimos una solicitud de cambio de contraseña. Por favor, da clic en "Confirmar solicitud" si realmente quieres realizar el cambio.</span>
        <span class="instruction-three">(Una vez que lo hagas, serás redireccionada a la página en donde podrás realizarlo.)</span>
      </div>
      <div style="text-align: center; margin-top: 3.5rem; color:white">
        <a href="{{$url}}" class="" style="text-decoration: none;">
          <span class="myBtn">Confirmar solicitud</span>
        </a>
      </div>
      <div class="gen-spacing">
        <span class="second-gen-txt">¡Gracias!</span>
        <span class="second-gen-txt">Team DuoDo.</span>
      </div>
    </div>
</body>

</html>