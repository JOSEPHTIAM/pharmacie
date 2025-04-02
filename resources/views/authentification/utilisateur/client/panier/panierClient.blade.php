<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CLIENT: Page du panier </title>

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
                margin-top: -770px; /* Just above the footer */
                width: 100%;
                overflow: hidden;
                white-space: nowrap;
                z-index: 999; /* Ensure it appears above the background */
                font-size: 40px;
                font-weight: bold;
                color: rgb(255, 255, 255); /* Indigo color */ 
                background-color: fuchsia;
                box-shadow: fuchsia;
            }

            .marquee2 {
                position: absolute;
                margin-top: -600px; /* Just above the footer */
                width: 40%;
                margin-left: 120px;
                overflow: hidden;
                z-index: 999; /* Ensure it appears above the background */
                font-size: 15px;
                font-weight: bold;
                color: fuchsia; /* Indigo color */                 
            }

            .marquee3 {
                position: absolute;
                overflow: hidden;
                margin-top: -600px; /* Just above the footer */
                margin-left: 490px;
                width: 40%;
                z-index: 999; /* Ensure it appears above the background */
                font-size: 15px;
                font-weight: bold;
                color: green; /* Indigo color */                 
            }

            .marquee4 {
                position: absolute;
                overflow: hidden;
                margin-top: -600px; /* Just above the footer */
                margin-left: -120px;
                width: 40%;
                z-index: 999; /* Ensure it appears above the background */
                font-size: 15px;
                font-weight: bold;
                color: rgb(0, 0, 118); /* Indigo color */                 
            }

            .marquee5 {
                position: absolute;
                overflow: hidden;
                margin-top: -600px; /* Just above the footer */
                margin-left: -350px;
                width: 40%;
                z-index: 999; /* Ensure it appears above the background */
                font-size: 15px;
                font-weight: bold;
                color: rgb(0, 0, 118); /* Indigo color */                 
            }

            .marquee7 {
                position: absolute;
                overflow: hidden;
                margin-top: -650px; /* Just above the footer */
                margin-left: -310px;
                width: 60%;
                z-index: 999; /* Ensure it appears above the background */
                font-size: 20px;
                font-weight: bold;
                color: white; /* Indigo color */                 
            }

            .marquee6 {
                position: absolute;
                overflow: hidden;
                margin-top: -550px; /* Just above the footer */
                margin-left: -310px;
                width: 60%;
                z-index: 999; /* Ensure it appears above the background */
                font-size: 20px;
                font-weight: bold;
                color: white; /* Indigo color */                 
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
                
                <button class="login-button" id="button1" onclick="categorieService()">
                    <b><strong>Catégories</strong></b>
                </button>
                <script>
                    function categorieService() {
                        window.location.href = "{{ url('/categorieService') }}";
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


        

        <!-- Centered logo in the content and fullscreen -->
        <div class="content">
            <div class="center-logo">
                <img id="dynamic-logo" src="{{ asset('image/Final_publizone.jpg') }}" alt="Logo plein écran">
            </div>

            <div align="center" class="marquee1">
                Votre panier
            </div>
            
            

            <!-- Bouton Panier aligné horizontalement -->
            <div align="center" class="marquee2">
                <a href="{{ route('panierClient') }}" style="text-decoration: none; color: inherit;">
                    <div class="card" style="width: 50%; box-shadow: 0 4px 8px fuchsia;">
                        <div>
                            <div class="numbers" style="position: left;">Panier</div>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="cart-outline" style="color: fuchsia; font-size: 60px;"></ion-icon>
                            <span id="cart-counter" class="cart-counter" style="position: absolute; top: 20px; right: 20px; background: fuchsia; color: white; border-radius: 50%; padding: 5px 10px; font-size: 14px;">
                                0
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Bouton transaction aligné horizontalement -->
            <div align="center" class="marquee3">
                <a href="{{ route('transactionClient') }}" style="text-decoration: none; color: inherit;" onclick="return confirm('Êtes-vous sûr pour effectuer le payement bancaire ?');">
                    <div class="card" style="width: 50%; box-shadow: 0 4px 8px green;">
                        <div>
                            <div class="numbers">Transaction</div>
                        </div>
                        <div class="iconBx">
                            <ion-icon name="cash-outline" style="color: green; font-size: 60px;"></ion-icon>
                            <span id="cart-counter-money" class="cart-counter-money" style="position: absolute; top: 60px; right: 20px; background: green; color: white; border-radius: 50%; padding: 5px 10px; font-size: 14px;">
                                0
                            </span>
                        </div>
                    </div>
                </a>
            </div>


            <!-- Bouton achéter aligné horizontalement -->
            <div align="center" class="marquee6">
                <a href="{{ route('transactionClient') }}" style="text-decoration: none; color: white; background-color: fuchsia;" onclick="return confirm('Êtes-vous sûr pour effectuer le payement bancaire ?');">
                    <div class="card" style="width: 50%; box-shadow: 0 4px 8px fuchsia; background-color: fuchsia;">
                        Acheter
                    </div>
                </a>
            </div>

            <!-- Bouton retour aligné horizontalement -->
            <div align="center" class="marquee7">
                <a href="{{ route('annonce') }}" style="text-decoration: none; color: white; background-color: red;">
                    <div class="card" style="width: 50%; box-shadow: 0 4px 8px red; background-color: red;">
                        Retour
                    </div>
                </a>
            </div>
                        

            <!-- Scrollable Div-cards section -->
            <div style="position: relative; width: 100%; overflow: hidden;">

                <!-- Left scroll button -->
                <button id="scroll-left" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%); z-index: 10; background-color: rgb(0, 0, 118); color: white; border: none; border-radius: 50%; width: 40px; height: 40px; cursor: pointer;">
                    <ion-icon name="chevron-back-outline" style="font-size: 20px;"></ion-icon>
                </button>


                <!-- Card container -->
                <div id="card-container" style="background-color: rgba(255, 255, 255, 0.88); display: flex; overflow-x: auto; scroll-behavior: smooth; padding: 20px; margin-top: 100px">
                    
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>BOUTIQUES</th>
                                <th>RESPONSABLES</th>
                                <th>IDENTIFIANTS</th>
                                <th>NOMS DES ELEMENTS</th>
                                <th>PRIX UNITAIRES</th>
                                <th>STOCKS DES SERVICES</th>
                                <th>PRIX TOTAUX</th>
                                <th>ACTIONS</th>                                    
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                            <!-- Cart items will be populated here -->
                        </tbody>
                    </table>    
                </div>

                <!-- Right scroll button -->
                <button id="scroll-right" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); z-index: 10; background-color: rgb(0, 0, 118); color: white; border: none; border-radius: 50%; width: 40px; height: 40px; cursor: pointer;">
                    <ion-icon name="chevron-forward-outline" style="font-size: 20px;"></ion-icon>
                </button>
            </div>

            <!-- CSS -->
            <style>
                .div-card:hover {
                    background-color: rgb(0, 0, 118); /* Change background color to indigo on hover */
                    color: rgb(255, 255, 255); /* Change text color to white on hover */
                    border-color: rgb(0, 0, 118); /* Ensure border matches the background */
                    box-shadow: 0 4px 12px rgba(0, 0, 255, 0.5); /* Add a blue shadow for emphasis */
                }

                .div-card:hover h3, .div-card:hover p {
                    color: white; /* Ensure the text inside the card becomes white */
                }
            </style>

            <!-- JavaScript -->
            <script>
                document.getElementById('scroll-left').addEventListener('click', function() {
                    document.getElementById('card-container').scrollBy({ left: -300, behavior: 'smooth' });
                });

                document.getElementById('scroll-right').addEventListener('click', function() {
                    document.getElementById('card-container').scrollBy({ left: 300, behavior: 'smooth' });
                });
            </script>
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

            // Pour gérer le panier et les transactions
            document.addEventListener('DOMContentLoaded', function() {
                const cartItemsContainer = document.getElementById('cart-items');
                const cartCounter = document.getElementById('cart-counter');
                const cartCounterMoney = document.getElementById('cart-counter-money');
                let cart = JSON.parse(localStorage.getItem('cart')) || [];

                function updateCartCounter() {
                    cartCounter.textContent = cart.length;
                }

                function updateCartTotal() {
                    const total = cart.reduce((sum, item) => sum + parseFloat(item.price), 0);
                    cartCounterMoney.textContent = total.toFixed(2) + ' CFA';
                }

                function renderCartItems() {
                    cartItemsContainer.innerHTML = '';
                    cart.forEach((item, index) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${item.localisation}</td>
                            <td>"${item.role}" : ${item.vendeurNom} ${item.vendeurPrenom}</td>
                            <td>${item.id}</td>
                            <td>${item.name}</td>
                            <td>${item.unitaire} CFA</td>
                            <td>${item.stock}</td>
                            <td>${item.price} CFA</td>
                            <td>
                                <a href="#" class="btn btn-danger remove-from-cart" data-index="${index}">
                                    <font color="white"><i class="bi bi-trash"></i></font>
                                </a>
                            </td>
                        `;
                        cartItemsContainer.appendChild(row);
                    });

                    document.querySelectorAll('.remove-from-cart').forEach(button => {
                        button.addEventListener('click', function(event) {
                            event.preventDefault();
                            const index = this.getAttribute('data-index');
                            cart.splice(index, 1);
                            localStorage.setItem('cart', JSON.stringify(cart));
                            renderCartItems();
                            updateCartCounter();
                            updateCartTotal();
                        });
                    });
                }

                renderCartItems();
                updateCartCounter();
                updateCartTotal();

                // Add event listeners to the navigation buttons
                document.querySelectorAll('.navigate-to-transactions').forEach(button => {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();
                        localStorage.setItem('cart', JSON.stringify(cart));
                        window.location.href = "{{ route('listeTransactions_administrateur') }}";
                    });
                });
            });


            // Pour le remettre directement
            document.addEventListener('DOMContentLoaded', function() {
                const cartCounter = document.getElementById('cart-counter');
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                cartCounter.textContent = cart.length;
            });
     

            // Pour gérer le temps de connexion
            function startTimer(duration, display) {
                let timer = duration, minutes, seconds;
                setInterval(function () {
                    if (timer <= 0) {
                        window.location.href = "{{ route('connexion') }}";
                    }

                    minutes = parseInt(timer / 60, 10);
                    seconds = parseInt(timer % 60, 10);
                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    display.textContent = "Temps restant :  " + minutes + " min " + seconds + " sec";

                    if (--timer < 0) {
                        timer = duration;
                    }
                }, 1000);
            }

            window.onload = function () {
                const remainingTime = {{ session('remaining_time', time()) - time() }};
                const display = document.getElementById('timer');
                startTimer(remainingTime, display);
            };
        </script>

        <!-- =========== Scripts =========  -->
        <script src="assets/js/main.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


    </body>
</html>
