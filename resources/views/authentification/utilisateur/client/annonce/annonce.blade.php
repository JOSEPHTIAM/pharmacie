<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CLIENT: Page d'annonces </title>

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
                margin: 0 35px;
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
                background-color: rgb(0, 0, 0);
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
                /* Ensures the image fills the screen while maintaining aspect ratio */
            }

            /* Marquee styles */
            .marquee1 {
                position: absolute;
                margin-top: 150px; /* Just above the footer */
                width: 100%;
                overflow: hidden;
                white-space: nowrap;
                z-index: 999; /* Ensure it appears above the background */
                font-size: 40px;
                font-weight: bold;
                color: rgb(0, 0, 118); /* Indigo color */ 
                background-color: rgba(253, 253, 253, 0.73);
            }

            .marquee0 {
                position: absolute;
                margin-top: 800px; /* Just above the footer */
                width: 100%;
                overflow: hidden;
                white-space: nowrap;
                z-index: 999; /* Ensure it appears above the background */
                font-size: 30px;
                font-weight: bold;
                color: white; /* Indigo color */ 
                background-color: rgb(0, 0, 118);
            }

            

            /* Keyframes for scrolling effect */
            @keyframes marquee {
                0% {
                    transform: translateX(100%); /* Start completely off-screen to the right */
                }
                100% {
                    transform: translateX(-100%); /* End completely off-screen to the left */
                }
            }


            /* Responsive design */
            @media (max-height: 768px) {
                /* Navbar styles for mobile */
                .navbar {
                    flex-direction: row; /* Assure que les éléments restent alignés horizontalement */
                    flex-wrap: wrap; /* Permet de gérer les débordements si nécessaire */
                    justify-content: space-between; /* Espace entre les éléments */
                    padding: 10px;
                }

                .navbar .nav-buttons {
                    flex-direction: row; /* Les boutons restent alignés horizontalement */
                    justify-content: center;
                    flex-grow: 1;
                }

                .navbar .nav-buttons button {
                    margin: 0 10px; /* Réduit les marges pour les petits écrans */
                    width: auto; /* Empêche les boutons de prendre toute la largeur */
                }

                .navbar .logo {
                    margin-bottom: 0; /* Supprime les marges inutiles */
                }


                /* Marquee text size and position for mobile */
                .marquee {
                    bottom: 150px; /* Adjust position above the footer */
                }

                .marquee span {
                    font-size: 45px; /* Smaller font size for mobile */
                    font-weight: bold;
                    color: rgb(0, 0, 118); /* Indigo color */
                }

                /* Footer styles for mobile */
                footer {
                    flex-direction: column;
                    text-align: center;
                    height: auto;
                    padding: 10px;
                }

                footer .contact,
                footer .app-name,
                footer .author {
                    margin: 5px 0;
                }

                /* Marquee text size for mobile */
                .marquee span {
                    font-size: 20px; /* Smaller font size for mobile */
                }

                /* Centered logo adjustments for mobile */
                .center-logo img {
                    width: 100%;
                    height: auto; /* Maintain aspect ratio */
                }
            }

        </style>

    </head>

    <body>

        <!-- Navbar -->
        <nav class="navbar">
            <div class="form-left"></div>

            <div class="logo">
                <img src="{{ asset('image/Final_publizone.jpg') }}" alt="Logo" style="height: 40px;">
            </div>

            <div class="nav-buttons">
                <button class="login-button" id="button1" onclick="accueilClient()">
                    <b><strong>Accueil</strong></b>
                </button>
                <script>
                    function accueilClient() {
                        window.location.href = "{{ url('/accueilClient') }}";
                    }
                </script>
                
                <button class="login-button" id="button1" onclick="annonce()">
                    <b><strong>Annonces</strong></b>
                </button>
                <script>
                    function annonce() {
                        window.location.href = "{{ url('/annonce') }}";
                    }
                </script>
            </div>
            <button class="login-button" id="button1" onclick="connexion()">
                <b><strong><font color="red">SE DÉCONNECTER</font></strong></b>
            </button>
            <script>
                function connexion() {
                    window.location.href = "{{ url('/connexion') }}";
                }
            </script>   
        </nav>

        <div align="center" class="marquee1">
            Nos différentes annonces
        </div>
        <div align="center" class="marquee0">
            Sur mobile de préférence
        </div>

        
        <!-- Centered logo in the content and fullscreen -->
        <div class="content">
        
            <div class="center-logo">
                <img id="dynamic-logo" src="{{ asset('image/Final_annonces.jpg') }}" alt="Logo plein écran">
            </div>

            <!-- Div-cards section -->
            <div class="card-container" style="display: flex; justify-content: center; align-items: center; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                <!-- First card -->
                
                <a href="{{ url('/categorieService') }}" style="text-decoration: none;">
                    <div class="div-card" style="margin: 5px; text-align: center; width: 300px; border: 1px solid #ddd; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgb(0, 0, 118); background-color: white; cursor: pointer; transition: all 0.3s;">
                        <img src="{{ asset('image/Final_service.jpg') }}" alt="Card 1 Image" style="width: 100%; height: 350px;">
                        <h3 style="margin: 10px 0; font-size: 18px; color: rgb(0, 0, 118);"><b><font size="7">Annonces services</font></b></h3>
                    </div>
                </a>
                <script>
                    function categorieService() {
                        window.location.href = "{{ url('/categorieService') }}";
                    }
                </script>

                <!-- Second card -->
                <a href="{{ url('/categorieFormation') }}" style="text-decoration: none;">
                    <div class="div-card" style="margin: 5px; text-align: center; width: 300px; border: 1px solid #ddd; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgb(0, 0, 118); background-color: white; cursor: pointer; transition: all 0.3s;">
                        <img src="{{ asset('image/Final_formation.jpg') }}" alt="Card 2 Image" style="width: 100%; height: 350px;">
                        <h3 style="margin: 10px 0; font-size: 18px; color: rgb(0, 0, 118);"><b><font size="7">Annonces formations</font></b></h3>
                    </div>
                </a>
                <script>
                    function categorieFormation() {
                        window.location.href = "{{ url('/categorieFormation') }}";
                    }
                </script>
            </div>
            <!-- CSS -->
            <style>
                .div-card:hover {
                    background-color: rgb(0, 0, 118); /* Change background color to indigo on hover */
                    color: rgb(255, 255, 255); /* Change text color to white on hover */
                    border-color: rgb(0, 0, 118); /* Ensure border matches the background */
                    box-shadow: 0 4px 12px rgba(0, 0, 255, 0.5); /* Add a blue shadow for emphasis */
                }

                .div-card:hover h3 {
                    color: white; /* Ensure the text inside the card becomes white */
                }
            </style>
        </div>


        <!-- Footer -->
        <footer>
            <div class="contact">
                Joindre : <b><strong>(+237) 659435256 / 655964653</strong></b>
            </div>
            <div class="app-name">
                <b>PUBLIZONE</b>
            </div>
            <div class="author">
                Société : <b><strong>MEMPHYS.SARL</strong></b>
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
