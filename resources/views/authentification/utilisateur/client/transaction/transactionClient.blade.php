<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CLIENT: Page de transaction </title>

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
                background-color: green;
                box-shadow: green;
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

            .marquee8 {
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
                Compte bancaire CCA
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
                            
                        </div>
                    </div>
                </a>
            </div>

            <!-- Bouton retour aligné horizontalement -->
            <div align="center" class="marquee7">
                <a href="{{ route('panierClient') }}" style="text-decoration: none; color: white; background-color: red;">
                    <div class="card" style="width: 50%; box-shadow: 0 4px 8px red; background-color: red;">
                        Retour
                    </div>
                </a>
            </div>

            <!-- Section for displaying cart items -->
            <div id="openPDF" align="center" class="marquee8" style="display: none;">
                <a href="#" style="text-decoration: none; color: white; background-color: green;">
                    <div class="card" style="width: 50%; box-shadow: 0 4px 8px green; background-color: green;">
                        Ouvrir le PDF
                    </div>
                </a>
            </div>
                            
            


            <!-- Scrollable Div-cards section -->
            <div style="position: relative; width: 100%; overflow: hidden;">

                <!-- Card container -->
                <div id="card-container" style="background-color: rgba(255, 255, 255, 0.88); display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; padding: 20px; margin-top: 100px;">
                    
                    <!-- Container for the cards -->
                    <div class="cca-cards-container" style="display: flex; flex-direction: column; align-items: center; gap: 20px; width: 100%; max-width: 400px;">
                        
                        <!-- CCA Bank Card - Front -->
                        <div class="cca-card" style="width: 100%; border: 1px solid #ddd; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background: linear-gradient(135deg, #1e5799 0%, #2989d8 50%, #207cca 100%); color: white;">
                            <div class="cca-card__header" style="display: flex; justify-content: space-between; align-items: center;">
                                <div class="cca-card__logo">
                                    <img src="{{ asset('image/cca_2.jpg') }}" alt="CCA Logo" style="width: 50px;">
                                </div>
                                <div class="cca-card__chip">
                                    <img src="{{ asset('image/cameroun.jpg') }}" alt="Chip" style="width: 50px;">
                                </div>
                            </div>
                            <div class="cca-card__number" style="margin: 20px 0; font-size: 18px; font-weight: bold; text-align: center;">
                                0000 0000 0000 0000
                            </div>
                            <div class="cca-card__details" style="display: flex; justify-content: space-between;">
                                <div class="cca-card__holder">
                                    <label>Propriétaire :</label>
                                    <div>Aucun</div>
                                </div>
                                <div class="cca-card__expiry">
                                    <label>Date expiration :</label>
                                    <div>00/00/00</div>
                                </div>
                            </div>
                        </div>

                        <!-- Middle div for total and button -->
                        <div class="cca-card-middle" style="text-align: center; margin-top: 20px;">
                            <div class="total-amount" style="font-size: 18px; font-weight: bold; color: green;">
                                <strong>Total :</strong>
                                <span id="transaction-total">0 CFA</span>
                            </div>
                            <a href="/" class="btn_nouveau" onclick="return confirm('Êtes-vous sûr de saisir vos coordonnées bancaires ?');" style="display: inline-block; margin-top: 10px; padding: 10px 20px; background-color: green; color: white; border-radius: 5px; text-decoration: none;">
                                <ion-icon name="cash-outline"></ion-icon> <font size="5">Payer</font>
                            </a>
                        </div>

                        <!-- CCA Bank Card - Back -->
                        <div class="cca-card-back" style="width: 100%; border: 1px solid #ddd; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background: linear-gradient(135deg, #1e5799 0%, #2989d8 50%, #207cca 100%); color: white;">
                            <div class="cca-card-back__stripe" style="height: 20px; background-color: black; margin-bottom: 20px;"></div>
                            <div class="cca-card-back__signature" style="display: flex; justify-content: space-between;">
                                <label>Signature :</label>
                                <div>Aucune</div>
                            </div>
                            <div class="cca-card-back__cvv" style="display: flex; justify-content: space-between; margin-top: 10px;">
                                <label>Mode de paiement :</label>
                                <div>Paypal</div>
                            </div>
                            <div class="cca-card-back__logo" style="text-align: center; margin-top: 20px;">
                                <img src="{{ asset('image/paypal.jpg') }}" alt="CCA Logo" style="width: 50px;">
                            </div>
                        </div>
                    </div>

                    <!-- PopUp for card details -->
                    <div id="cardDetailsPopup" class="popup" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgb(0, 0, 118); color: white; padding: 20px; border-radius: 10px; z-index: 1000; width: 90%; max-width: 400px;">
                        <div class="popup-content" style="color: white; text-align: center;">
                            <h2><b>Enregistrer les détails de votre carte bancaire</b></h2>
                            <br>
                            <label for="identifiant">Identifiant :</label>
                            <input type="text" id="identifiant" placeholder="1234 5678 9012 3456" style="width: 100%; margin-bottom: 10px; padding: 5px;">
                            <label for="nomProprietaire">Nom du Propriétaire :</label>
                            <input type="text" id="nomProprietaire" placeholder="DANIEL" style="width: 100%; margin-bottom: 10px; padding: 5px;">
                            <label for="dateExpiration">Date d'Expiration :</label>
                            <input type="text" id="dateExpiration" placeholder="AA/MM/YYYY" style="width: 100%; margin-bottom: 10px; padding: 5px;">
                            <label for="prenom">Prénom du propriétaire :</label>
                            <input type="text" id="prenom" placeholder="NGUEDJUI" style="width: 100%; margin-bottom: 10px; padding: 5px;">
                            <label for="gmail">Gmail du propriétaire :</label>
                            <input type="email" id="gmail" placeholder="exemple@gmail.com" style="width: 100%; margin-bottom: 10px; padding: 5px;">
                            <div class="popup-buttons" style="margin-top: 20px;">
                                <button id="confirmButton" class="btn btn-primary" style="margin-right: 10px;">Confirmer</button>
                                <button id="clearButton" type="reset" class="btn btn-warning" style="margin-right: 10px;">Effacer</button>
                                <button id="closeButton" class="btn btn-danger">Retour</button>
                            </div>
                        </div>
                    </div>
                </div>

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




        


        <!-- ============= Bootstrap =============  -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const transactionTotal = document.getElementById('transaction-total');
                let cart = JSON.parse(localStorage.getItem('cart')) || [];

                function updateTransactionTotal() {
                    const total = cart.reduce((sum, item) => sum + parseFloat(item.price), 0);
                    transactionTotal.textContent = total.toFixed(2) + ' CFA';
                }

                updateTransactionTotal();

                // PopUp elements
                const cardDetailsPopup = document.getElementById('cardDetailsPopup');
                const confirmButton = document.getElementById('confirmButton');
                const clearButton = document.getElementById('clearButton');
                const closeButton = document.getElementById('closeButton');
                const openPDFButton = document.getElementById('openPDF');

                // Show PopUp when clicking on "Payer" button
                document.querySelector('.btn_nouveau').addEventListener('click', function(event) {
                    event.preventDefault();
                    cardDetailsPopup.style.display = 'flex';
                });

                // Close PopUp
                closeButton.addEventListener('click', function() {
                    cardDetailsPopup.style.display = 'none';
                });

                // Clear inputs
                clearButton.addEventListener('click', function() {
                    document.getElementById('identifiant').value = '';
                    document.getElementById('nomProprietaire').value = '';
                    document.getElementById('dateExpiration').value = '';
                    document.getElementById('prenom').value = '';
                    document.getElementById('gmail').value = '';
                });

                // Confirm and save to localStorage
                confirmButton.addEventListener('click', function() {
                    const identifiant = document.getElementById('identifiant').value;
                    const nomProprietaire = document.getElementById('nomProprietaire').value;
                    const dateExpiration = document.getElementById('dateExpiration').value;
                    const prenom = document.getElementById('prenom').value;
                    const gmail = document.getElementById('gmail').value;

                    localStorage.setItem('identifiant', identifiant);
                    localStorage.setItem('nomProprietaire', nomProprietaire);
                    localStorage.setItem('dateExpiration', dateExpiration);
                    localStorage.setItem('prenom', prenom);
                    localStorage.setItem('gmail', gmail);

                    cardDetailsPopup.style.display = 'none';
                    updateCardDetails();
                    sendEmailNotification(gmail, cart);
                    openPDFButton.style.display = 'block';
                });

                // Update card details on the page
                function updateCardDetails() {
                    const identifiant = localStorage.getItem('identifiant');
                    const nomProprietaire = localStorage.getItem('nomProprietaire');
                    const dateExpiration = localStorage.getItem('dateExpiration');
                    const prenom = localStorage.getItem('prenom');
                    const gmail = localStorage.getItem('gmail');

                    if (identifiant && nomProprietaire && dateExpiration && prenom && gmail) {
                        document.querySelector('.cca-card__number').textContent = identifiant;
                        document.querySelector('.cca-card__holder div').textContent = nomProprietaire;
                        document.querySelector('.cca-card__expiry div').textContent = dateExpiration;
                        document.querySelector('.cca-card-back__signature div').textContent = prenom;

                        document.querySelector('.total-amount').innerHTML = '<font color="#0b840f" size="5">Paiement réussi avec succès ! Vous recevrez une notification Gmail !</font>';
                        document.querySelector('.btn_nouveau').style.display = 'none';
                        document.getElementById('openPDF').style.display = 'block';
                    }
                }

                updateCardDetails();

                // Clear localStorage when leaving the page
                window.addEventListener('beforeunload', function() {
                    localStorage.removeItem('identifiant');
                    localStorage.removeItem('nomProprietaire');
                    localStorage.removeItem('dateExpiration');
                    localStorage.removeItem('prenom');
                    localStorage.removeItem('gmail');
                });

                // Send email notification
                function sendEmailNotification(gmail, cart) {
                    const emailContent = `
                        Bonjour à vous ! josephtiam8@gmail.com de l'entreprise MEMPHYS au (+237 655964653), vous remercie d'avoir effectué le payement en ligne du service sur notre plateforme avec succès.
                        Votre liste contient :
                        ${cart.map(item => `
                            - Boutiques: ${item.id}
                            - Responsables: ${item.id}
                            - Identifiants: ${item.id}
                            - Services: ${item.name}
                            - Prix Unitaire: ${item.unitaire} CFA
                            - Stock: ${item.stock}
                            - Prix Total: ${item.price} CFA
                        `).join('\n')}
                        Le montant total de votre payement est de : ${transactionTotal.textContent} CFA avec succès.
                        Merci de votre confiance !
                    `;

                    fetch('/send-email', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            to: gmail,
                            subject: 'Confirmation de Payement',
                            text: emailContent
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Email sent successfully:', data);
                    })
                    .catch(error => {
                        console.error('Error sending email:', error);
                    });
                }

                // Generate PDF
                function generatePDF(gmail, cart) {
                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF();

                    // Contenu de l'email
                    let emailContent = `
                        Bonjour à vous !
                        josephtiam8@gmail.com de l'entreprise MEMPHYS au
                        (+237 655964653), vous remercie d'avoir effectué le 
                        payement en ligne du service sur notre plateforme.
                        Votre liste contient :
                    `;

                    // Ajouter chaque élément du panier
                    cart.forEach((item, index) => {
                        emailContent += `
                            ${index + 1}. Boutique: ${item.localisation}
                            Responsable: ${item.vendeurNom} ${item.vendeurPrenom}
                            Identifiant: ${item.id}
                            Service: ${item.name}
                            Prix Unitaire: ${item.unitaire} CFA
                            Stock: ${item.stock}
                            Prix Total: ${item.price} CFA
                        `;
                    });

                    // Ajouter le message final
                    emailContent += `
                        Le montant total de votre payement est de : ${transactionTotal.textContent} CFA avec succès.
                        Merci de votre confiance !
                    `;

                    // Diviser le contenu en lignes pour éviter les débordements
                    const lines = doc.splitTextToSize(emailContent, 180); // 180 est la largeur maximale du texte dans le PDF
                    let y = 10; // Position verticale initiale

                    // Ajouter chaque ligne au PDF
                    lines.forEach((line) => {
                        if (y > 280) { // Si la position dépasse la hauteur de la page
                            doc.addPage(); // Ajouter une nouvelle page
                            y = 10; // Réinitialiser la position verticale
                        }
                        doc.text(line, 10, y); // Ajouter le texte à la position (10, y)
                        y += 10; // Augmenter la position verticale pour la ligne suivante
                    });

                    // Générer et ouvrir le PDF
                    const pdfData = doc.output('datauristring');
                    const pdfWindow = window.open();
                    pdfWindow.document.write(`<iframe width='100%' height='100%' src='${pdfData}'></iframe>`);
                }

                // Open PDF in a new window
                openPDFButton.addEventListener('click', function() {
                    generatePDF(localStorage.getItem('gmail'), JSON.parse(localStorage.getItem('cart')));
                });
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

        <!-- =========== Scripts pour des asserts =========  -->
        <script src="assets/js/main.js"></script>

        <!-- =========== Scripts pour gérer des PDF =========  -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

        <!-- ====== ionicons ======= -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


    </body>
</html>
