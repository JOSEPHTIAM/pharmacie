<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Page d'accueil</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Style CSS -->
        <style>
            body {
                margin: 0;
                padding: 0;
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                font-family: Arial, sans-serif;
            }

            /* Navbar styles */
            .navbar {
                background-color: rgb(0, 0, 118); /* Slightly indigo color */
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 20px;
                color: white;
                width: 100%;
                position: relative;
                z-index: 1000;
            }

            .navbar .logo {
                font-size: 18px;
                font-weight: bold;
            }

            .navbar .nav-buttons {
                display: flex;
                justify-content: center;
                flex-grow: 1;
            }

            .navbar .nav-buttons button {
                background-color: transparent;
                color: white;
                border: 2px solid white;
                border-radius: 5px;
                padding: 5px 10px;
                margin: 0 5px;
                cursor: pointer;
                transition: background-color 0.3s, color 0.3s;
            }

            .navbar .nav-buttons button:hover {
                background-color: white;
                color: rgb(0, 0, 118); /* Indigo color on hover */
            }

            .navbar .login-button {
                background-color: white;
                color: rgb(0, 0, 118); /* Indigo */
                border: none;
                padding: 5px 15px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 14px;
            }

            .navbar .login-button:hover {
                background-color: #E6E6FA; /* Light lavender hover effect */
            }

            /* Footer styles */
            footer {
                background-color: rgb(156, 229, 0);
                color: white;
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                height: 60px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0 20px;
                font-size: 14px;
                z-index: 1000;
            }

            footer .contact {
                text-align: left;
            }

            footer .app-name {
                text-align: center;
            }

            footer .author {
                text-align: right;
            }


            /* Centered logo in the content and fullscreen */
            .content {
                position: relative;
                flex: 1;
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100vw;
                height: 100vh;
                overflow: hidden;
            }

            .center-logo img {
                position: absolute;
                top: 0;
                left: 0;
                width: 100vw;
                height: 100vh;
                object-fit: cover; /* Ensures the image fills the screen while maintaining aspect ratio */
            }

        </style>

    </head>

    <body>

        <!-- Navbar -->
        <nav class="navbar">
            <div class="form-left"></div>

            <div class="logo">
                <img src="{{ asset('image/logo_1.jpg') }}" alt="Logo" style="height: 40px;">
            </div>

            <div class="nav-buttons">
                <button class="login-button" id="button1" onclick="connexion1()">
                    <b><strong>Accueil</strong></b>
                </button>
                <script>
                    function connexion1() {
                        window.location.href = "{{ url('/') }}";
                    }
                </script>

                <button class="login-button" id="button1" onclick="connexion()">
                    <b><strong>Catégories</strong></b>
                </button>
                <script>
                    function connexion() {
                        window.location.href = "{{ url('/connexion') }}";
                    }
                </script>

                <button class="login-button" id="button1" onclick="connexion()">
                    <b><strong>Anonces</strong></b>
                </button>
                <script>
                    function connexion() {
                        window.location.href = "{{ url('/connexion') }}";
                    }
                </script>
            </div>
            <div>
                <button class="login-button" id="button1" onclick="connexion()">
                    <b><strong>SE CONNECTER</strong></b>
                </button>
                <script>
                    function connexion() {
                        window.location.href = "{{ url('/connexion') }}";
                    }
                </script>
            </div>
        </nav>


        <!-- Centered logo in the content and fullscreen -->
        <div class="content">
            <div class="center-logo">
                <img id="dynamic-logo" src="{{ asset('image/logo_principal.jpg') }}" alt="Logo plein écran">
            </div>
        </div>


        <!-- Footer -->
        <footer>
            <div class="contact">
                Joindre : <b><strong>+237659435256</strong></b>
            </div>
            <div class="app-name">
                <b>GESTION DE LA PLATEFORME D'ANNONCES</b>
            </div>
            <div class="author">
                Admin : Mlle <b><strong>EVE_JORDANIE</strong></b>
            </div>
        </footer>


        <!-- JavaScript to change logos -->
        <script>
            // Array of logo paths
            /*
            const logos = [
                "{{ asset('image/logo_1.jpg') }}",
                "{{ asset('image/logo_2.jpg') }}",
                "{{ asset('image/logo_3.jpg') }}",
                "{{ asset('image/logo_4.jpg') }}"
            ];
            */

            // Get the image element
            const logoElement = document.getElementById('dynamic-logo');
            let logoIndex = 0;

            // Function to change the logo
            function changeLogo() {
                logoIndex = (logoIndex + 1) % logos.length; // Loop through the array
                logoElement.src = logos[logoIndex];
            }

            // Change logo every 5 seconds (5000 milliseconds)
            setInterval(changeLogo, 5000);
        </script>

    </body>
</html>
