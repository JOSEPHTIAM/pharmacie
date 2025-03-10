<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Liste des transactions chez l'administrateur</title>
        
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        
        <!-- Style CSS -->        
        <style>
            /* =========== Google Fonts ============ */
            @import url("https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap");

            /* =============== Globals ============== */
            * {
            font-family: "Ubuntu", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            }

            :root {
            --blue: #2a2185;
            --white: #fff;
            --gray: #f5f5f5;
            --black1: #222;
            --black2: #999;
            }

            body {
            min-height: 100vh;
            overflow-x: hidden;
            }

            .container {
            position: relative;
            width: 100%;
            }

            /* =============== Navigation ================ */
            .navigation {
            position: fixed;
            width: 300px;
            height: 100%;
            background: var(--blue);
            border-left: 10px solid var(--blue);
            transition: 0.5s;
            overflow: hidden;
            }
            .navigation.active {
            width: 80px;
            }

            .navigation ul {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            }

            .navigation ul li {
            position: relative;
            width: 100%;
            list-style: none;
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
            }

            .navigation ul li:hover,
            .navigation ul li.hovered {
            background-color: var(--white);
            }

            .navigation ul li:nth-child(1) {
            margin-bottom: 40px;
            pointer-events: none;
            }

            .navigation ul li a {
            position: relative;
            display: block;
            width: 100%;
            display: flex;
            text-decoration: none;
            color: var(--white);
            }
            .navigation ul li:hover a,
            .navigation ul li.hovered a {
            color: var(--blue);
            }

            .navigation ul li a .icon {
            position: relative;
            display: block;
            min-width: 60px;
            height: 60px;
            line-height: 75px;
            text-align: center;
            }

            .navigation ul li a .icon_actuellement {
            position: relative;
            display: block;
            min-width: 60px;
            height: 60px;
            line-height: 75px;
            text-align: center;
            background: var(--white);
            color: var(--blue);
            }

            .navigation ul li a .icon ion-icon {
            font-size: 1.75rem;
            }

            .navigation ul li a .icon_actuellement ion-icon {
            font-size: 1.75rem;
            }

            .navigation ul li a .title {
            position: relative;
            display: block;
            padding: 0 10px;
            height: 60px;
            line-height: 60px;
            text-align: start;
            white-space: nowrap;
            }

            .navigation ul li a .title_actuellement {
            position: relative;
            display: block;
            padding: 0 10px;
            height: 60px;
            line-height: 60px;
            text-align: start;
            white-space: nowrap;
            background: var(--white);
            color: var(--blue);
            }
            
            .cardBox .card .iconBx .cart-counter {
                position: absolute;
                top: 20px;
                right: 20px;
                background: fuchsia;
                color: white;
                border-radius: 70%;
                padding: 5px 10px;
                font-size: 14px;              
            }

            .cardBox .card_actuellement .iconBx .transaction-total {
                position: absolute;
                top: 80px;
                right: 20px;
                background: green;
                color: white;
                border-radius: 70%;
                padding: 5px 100px;
                font-size: 17px;              
            }
            




            /* --------- curve outside ---------- */
            .navigation ul li:hover a::before,
            .navigation ul li.hovered a::before {
            content: "";
            position: absolute;
            right: 0;
            top: -50px;
            width: 50px;
            height: 50px;
            background-color: transparent;
            border-radius: 50%;
            box-shadow: 35px 35px 0 10px var(--white);
            pointer-events: none;
            }
            .navigation ul li:hover a::after,
            .navigation ul li.hovered a::after {
            content: "";
            position: absolute;
            right: 0;
            bottom: -50px;
            width: 50px;
            height: 50px;
            background-color: transparent;
            border-radius: 50%;
            box-shadow: 35px -35px 0 10px var(--white);
            pointer-events: none;
            }

            /* ===================== Main ===================== */
            .main {
                position: absolute;
                width: calc(100% - 300px);
                left: 300px;
                min-height: 100vh;
                background: var(--white);
                transition: 0.5s;
                background-image: url("{{ asset('image/logo_principal.jpg') }}");
                background-size: cover; /* Pour que l'image couvre tout le conteneur */
                background-position: center; /* Pour centrer l'image */
                background-repeat: no-repeat; /* Empêche la répétition de l'image */                
                align-items: center;
                justify-content: center;
            }

            .main.active {
            width: calc(100% - 80px);
            left: 80px;
            }

            .topbar {
            width: 100%;
            height: 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 10px;
            }

            .toggle {
            position: relative;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2.5rem;
            cursor: pointer;
            }

            .search {
            position: relative;
            width: 400px;
            margin: -50px;
            }

            .search label {
            position: relative;
            width: 100%;
            }

            .search label input {
            width: 100%;
            height: 40px;
            border-radius: 40px;
            padding: 5px 20px;
            padding-left: 35px;
            font-size: 18px;
            outline: none;
            border: 1px solid var(--black2);
            }

            .search label ion-icon {
            position: absolute;
            top: 0;
            left: 10px;
            font-size: 1.2rem;
            }

            button.acces {
               padding: 10px 20px;
               margin: -50px;
               background-color: #cf0000;
               color: white;
               border: 1px solid #ccc;
               border-radius: 0 5px 5px 0;
               cursor: pointer;
               font-weight: bold;
            }

          .search button.acces:hover {
               background-color: #E6E6FA;
               color: #cf0000;
          }


            .user {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden; 
            cursor: pointer;
            }

            .user img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            }

            /* ======================= Cards ====================== */
            .cardBox {
            position: relative;
            width: 100%;
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 30px;
            }

            .cardBox .card {
            position: relative;
            background: var(--white);
            padding: 30px;
            border-radius: 20px;
            display: flex;
            justify-content: space-between;
            cursor: pointer;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            }

            .cardBox .card_actuellement {
            position: relative;
            background: var(--blue);
            padding: 30px;
            border-radius: 20px;
            display: flex;
            justify-content: space-between;
            cursor: pointer;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            }

            .cardBox .card .numbers {
            position: relative;
            font-weight: 500;
            font-size: 2.5rem;
            color: var(--blue);
            }

            .cardBox .card_actuellement .numbers_actuellement {
            position: relative;
            font-weight: 500;
            font-size: 2.5rem;
            color: var(--white);
            }

            .cardBox .card .cardName {
            color: var(--black2);
            font-size: 1.1rem;
            margin-top: 5px;
            }

            .cardBox .card_actuellement .cardName {
            color: var(--white);
            font-size: 1.1rem;
            margin-top: 5px;
            }

            .cardBox .card .iconBx {
            font-size: 3.5rem;
            color: var(--black2);
            }

            .cardBox .card_actuellement .iconBx {
            font-size: 3.5rem;
            color: var(--white);
            }

            .cardBox .card:hover {
            background: var(--blue);
            }

            .cardBox .card_actuellement:hover {
            background: var(--white);
            color: var(--white);
            }

            .cardBox .card:hover .numbers,
            .cardBox .card:hover .cardName,
            .cardBox .card:hover .iconBx {
            color: var(--white);
            }

            .cardBox .card_actuellement:hover .numbers_actuellement,
            .cardBox .card_actuellement:hover .cardName,
            .cardBox .card_actuellement:hover .iconBx {
            color: var(--blue);
            }

            /* ================== Order Details List ============== */
            .details {
            position: relative;
            width: 150%;
            padding: 20px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            grid-gap: 30px;
            /* margin-top: 10px; */
            }

            .details .recentOrders {
            position: relative;
            display: grid;
            min-height: 500px;
            background: #ffffffe5;
            padding: 20px;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            border-radius: 20px;
            }

            .details .cardHeader {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            }
            .cardHeader h2 {
            font-weight: 600;
            color: var(--blue);
            text-align: center;
            }

            .cardHeader .btn {
            position: relative;
            padding: 10px 60px;
            background: var(--blue);
            text-decoration: none;
            color: var(--white);
            border-radius: 6px;
            }

            .cardHeader .btn_nouveau {
            position: relative;
            padding: 10px 130px;            
            background: green;
            text-decoration: none;
            color: var(--white);
            border-radius: 6px;
            }

            .details table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            }
            .details table thead td {
            font-weight: 600;
            }
            .details .recentOrders table tr {
            color: var(--black1);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            }
            .details .recentOrders table tr:last-child {
            border-bottom: none;
            }
            .details .recentOrders table tbody tr:hover {
            background: var(--blue);
            color: var(--white);
            }
            .details .recentOrders table tr td {
            padding: 10px;
            }
            .details .recentOrders table tr td:last-child {
            text-align: end;
            }
            .details .recentOrders table tr td:nth-child(2) {
            text-align: end;
            }
            .details .recentOrders table tr td:nth-child(3) {
            text-align: center;
            }
            .status.delivered {
            padding: 2px 4px;
            background: #8de02c;
            color: var(--white);
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            }
            .status.pending {
            padding: 2px 4px;
            background: #e9b10a;
            color: var(--white);
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            }
            .status.return {
            padding: 2px 4px;
            background: #f00;
            color: var(--white);
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            }
            .status.inProgress {
            padding: 2px 4px;
            background: #1795ce;
            color: var(--white);
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            }

            .recentCustomers {
            position: relative;
            display: grid;
            min-height: 500px;
            padding: 20px;
            background: var(--white);
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            border-radius: 20px;
            }
            .recentCustomers .imgBx {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 50px;
            overflow: hidden;
            }
            .recentCustomers .imgBx img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            }
            .recentCustomers table tr td {
            padding: 12px 10px;
            }
            .recentCustomers table tr td h4 {
            font-size: 16px;
            font-weight: 500;
            line-height: 1.2rem;
            }
            .recentCustomers table tr td h4 span {
            font-size: 14px;
            color: var(--black2);
            }
            .recentCustomers table tr:hover {
            background: var(--blue);
            color: var(--white);
            }
            .recentCustomers table tr:hover td h4 span {
            color: var(--white);
            }

            /* ====================== Responsive Design ========================== */
            @media (max-width: 991px) {
            .navigation {
                left: -300px;
            }
            .navigation.active {
                width: 300px;
                left: 0;
            }
            .main {
                width: 100%;
                left: 0;
            }
            .main.active {
                left: 300px;
            }
            .cardBox {
                grid-template-columns: repeat(2, 1fr);
            }
            }

            @media (max-width: 768px) {
            .details {
                grid-template-columns: 1fr;
            }
            .recentOrders {
                overflow-x: auto;
            }
            .status.inProgress {
                white-space: nowrap;
            }
            }

            @media (max-width: 480px) {
                .cardBox {
                    grid-template-columns: repeat(1, 1fr);
                }
                .cardHeader h2 {
                    font-size: 20px;
                    text-align: center;
                }
                .user {
                    min-width: 40px;
                }
                .navigation {
                    width: 100%;
                    left: -100%;
                    z-index: 1000;
                }
                .navigation.active {
                    width: 100%;
                    left: 0;
                }
                .toggle {
                    z-index: 10001;
                }
                .main.active .toggle {
                    color: #fff;
                    position: fixed;
                    right: 0;
                    left: initial;
                }
            }
            /* Footer styles */
            footer {
                background-color: rgb(12, 13, 13);
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



            /* ===================== CCA Bank Card ===================== */
            /* Container for the cards */
            .cca-cards-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin: 20px 0;
                gap: 20px; /* Add space between the cards */
            }

            /* CCA Bank Card - Front */
            .cca-card {
                width: 400px;
                height: 250px;
                background: linear-gradient(135deg, #1e5799 0%, #2989d8 50%, #207cca 100%);
                border-radius: 15px;
                color: white;
                padding: 30px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            .cca-card__header {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .cca-card__logo img {
                height: 50px;
            }
            .cca-card__chip img {
                height: 40px;
            }
            .cca-card__number {
                font-size: 2em;
                letter-spacing: 3px;
                margin: 20px 0;
            }
            .cca-card__details {
                display: flex;
                justify-content: space-between;
            }
            .cca-card__holder, .cca-card__expiry {
                text-align: left;
            }
            .cca-card__holder label, .cca-card__expiry label {
                font-size: 1em;
                color: #ccc;
            }

            /* CCA Bank Card - Back */
            .cca-card-back {
                width: 400px;
                height: 250px;
                background: linear-gradient(135deg, #1e5799 0%, #2989d8 50%, #207cca 100%);
                border-radius: 15px;
                color: white;
                padding: 30px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                position: relative;
            }
            .cca-card-back__stripe {
                width: 100%;
                height: 50px;
                background: black;
                margin-bottom: 20px;
            }
            .cca-card-back__signature {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }
            .cca-card-back__signature label {
                font-size: 1em;
                color: #ccc;
            }
            .cca-card-back__signature div {
                background: white;
                color: black;
                padding: 5px;
                border-radius: 5px;
                width: 200px;
                text-align: center;
            }
            .cca-card-back__cvv {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }
            .cca-card-back__cvv label {
                font-size: 1em;
                color: #ccc;
            }
            .cca-card-back__cvv div {
                background: white;
                color: black;
                padding: 5px;
                border-radius: 5px;
                width: 50px;
                text-align: center;
            }
            .cca-card-back__logo {
                position: absolute;
                bottom: 20px;
                right: 20px;
            }
            .cca-card-back__logo img {
                height: 50px;
            }

            .cca-card-middle {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 20px;
                width: 40%;
                padding: 20px;
                background: #f5f5f5;
                border-radius: 15px;
                box-shadow: 0 4px 8px #2989d8;
            }
            .total-amount {
                font-size: 1.5em;
                color: black;
            }
            .btn_nouveau {
                padding: 10px 70px;
                background: green;
                color: white;
                text-decoration: none;
                border-radius: 6px;
                display: flex;
                align-items: center;
                gap: 10px;
            }
            .btn_nouveau ion-icon {
                font-size: 1.5em;
            }

            .cardBox .card_actuellement .iconBx .cart-counter-money {
                position: absolute;
                top: 80px;
                right: 20px;
                background: green;
                color: white;
                border-radius: 70%;
                padding: 5px 120px;
                font-size: 17px;              
            }

            /* PopUp styles */
            .popup {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;                
                justify-content: center;
                align-items: center;
                z-index: 1000;
                border-radius : 100px
            }
            .popup-content {
                background: white;
                padding: 20px;
                border-radius: 10px;
                text-align: left;
                background : #2a2185;
                color : "white";
                width: 450px;
            }
            .popup-content input {
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                border: 1px solid #0031f3;
                border-radius: 5px;
            }
            .popup-buttons {
                display: flex;
                justify-content: space-between;
            }
            .popup-buttons button {
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
            #confirmButton {
                background: green;
                color: white;
            }
            #clearButton {
                background: orange;
                color: white;
            }
            #closeButton {
                background: red;
                color: white;
            }


        </style>
    </head>



    <body>
        <!-- =============== Navigation ================ -->
        <div class="container">
            <div class="navigation">
                <ul>
                    <li>
                        <a href="#">
                            <span class="icon">
                                <img src="{{ asset('image/logo_1.jpg') }}" alt="Logo" style="height: 40px;">
                            </span>
                            <span class="title"><strong>Gestion de Plateforme d'Annonces</strong></span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('accueilAdministrateur') }}">
                            <span class="icon">
                                <ion-icon name="home-outline"></ion-icon>
                            </span>
                            <span class="title">Accueil de l'administrateur</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('listeAnnonces_administrateur') }}">
                            <span class="icon">
                                <ion-icon name="chatbubble-outline"></ion-icon>
                            </span>
                            <span class="title">Annonces</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('listePaniers_administrateur') }}">
                            <span class="icon">
                                <ion-icon name="chatbubble-outline"></ion-icon>
                            </span>
                            <span class="title">Paniers</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('listeTransactions_administrateur') }}">
                            <span class="icon_actuellement">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                            </span>
                            <span class="title_actuellement">Transactions</span>
                        </a>
                    </li>             

                    <li>
                        <a href="{{ route('connexion') }}">
                            <span class="icon">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </span>
                            <span class="title"><strong>Se déconnecter</strong></span>
                        </a>
                    </li>
                </ul>
            </div>


               <!-- ========================= Main ==================== -->
               <div class="main">
                    
                    
                    <div class="topbar">
                        <div class="toggle">
                            <img src="{{ asset('image/logo_7.jpg') }}" alt="Logo" style="height: 40px;">                            
                        </div>
                        
                        <div class="search">
                            <label>
                                <input type="text" placeholder="Rechercher non disponible">
                                <ion-icon name="search-outline"></ion-icon>
                            </label>
                        </div>

                        <font color="white" size="6">Administrateur: <strong><u>EVE JORDANIE</u></strong></font>
                                            
                        <div class="user">
                            <img src="{{ asset('image/logo_8.jpg') }}" alt="Logo" style="height: 40px;">                                                                           
                        </div>
                </div>



                <!-- ======================= Cards ================== -->
                <div class="cardBox">
                    
                    <a href="{{ route('listeClients_administrateur') }}" style="text-decoration: none; color: inherit;">
                        <div class="card">
                            <div>
                                <div class="numbers">Consulter</div>
                                <div class="cardName">Les acteurs</div>
                            </div>
                            <div class="iconBx">
                                <ion-icon name="eye-outline"></ion-icon>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('listePaniers_administrateur') }}" style="text-decoration: none; color: inherit;">
                        <div class="card">
                            <div>
                                <div class="numbers">Panier</div>
                                <div class="cardName">Sélectionner</div>
                            </div>
                            <div class="iconBx">
                                <ion-icon name="cart-outline"></ion-icon>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('listeAnnonces_administrateur') }}" style="text-decoration: none; color: inherit;">
                        <div class="card">
                            <div>
                                <div class="numbers">Annonces</div>
                                <div class="cardName">Informations</div>
                            </div>
                            <div class="iconBx">
                                <ion-icon name="chatbubbles-outline"></ion-icon>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('listeTransactions_administrateur') }}" style="text-decoration: none; color: inherit;">
                        <div class="card_actuellement">
                            <div>
                                <div class="numbers_actuellement">Transactions</div>
                                <div class="cardName">En fcfa</div>
                            </div>
                            <div class="iconBx">
                                <ion-icon name="cash-outline"></ion-icon>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- ======================= Outline ================== -->
                <div class="details">
                    <div class="recentOrders">
                        
                        @if(session('success'))
                            <div id="successMessage" style="color: green;">{{ session('success') }}</div>
                            <script>
                                setTimeout(function(){
                                    document.getElementById('successMessage').style.display = 'none';
                                }, 3000);
                            </script>
                        @endif
                        
                        <!-- Section for displaying cart items -->
                        <div class="cardHeader">
                            <h2 align="center"><font size="7">MODE DE PAIEMENT BANCAIRE</font></h2>
                            <button id="openPDF" class="btn btn-warning" style="display: none;">
                                <font size="5">Ouvrir le PDF</font>
                            </button>
                        </div>


                        <!-- Container for the cards -->
                        <div class="cca-cards-container">
                            
                            <!-- CCA Bank Card - Front -->
                            <div class="cca-card">
                                <div class="cca-card__header">
                                    <div class="cca-card__logo">
                                        <img src="{{ asset('image/cca_2.jpg') }}" alt="CCA Logo">
                                    </div>
                                    <div class="cca-card__chip">
                                        <img src="{{ asset('image/cameroun.jpg') }}" alt="Chip">
                                    </div>
                                </div>
                                <div class="cca-card__number">
                                    0000 0000 0000 0000
                                </div>
                                <div class="cca-card__details">
                                    <div class="cca-card__holder">
                                        <label>Propriétaire :</label>
                                        <div>Aucun</div>
                                    </div>
                                    <div class="cca-card__expiry">
                                        <label>Date expiration : </label>
                                        <div>00/00/00</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Middle div for total and button -->
                            <div class="cca-card-middle">
                                <div class="total-amount">
                                    <strong><font color="green" size="5">Total : </font></strong>
                                    <span id="transaction-total">
                                        0 CFA
                                    </span>
                                </div>
                                <a href="/" class="btn_nouveau" onclick="return confirm('Êtes-vous sûr de saisir vos coordonnées bancaires ?');">
                                    <ion-icon name="cash-outline"></ion-icon> <font size="5">Payer</font>
                                </a>
                            </div>

                            <!-- CCA Bank Card - Back -->
                            <div class="cca-card-back">
                                <div class="cca-card-back__stripe"></div>
                                <div class="cca-card-back__signature">
                                    <label>Signature :</label>
                                    <div>Aucune</div>
                                </div>
                                <div class="cca-card-back__cvv">
                                    <label>Mode de paiement :</label>
                                    <div>Paypal</div>
                                </div>
                                <div class="cca-card-back__logo">
                                    <img src="{{ asset('image/paypal.jpg') }}" alt="CCA Logo">
                                </div>
                            </div>
                        </div>


                        <!-- PopUp for card details -->
                        <div id="cardDetailsPopup" class="popup">
                            <div class="popup-content">
                                <h2><font color="white">Enregistrer les détails de votre carte bancaire</font></h2>
                                
                                <br><br>
                                
                                <label for="identifiant"><font color="white">Identifiant :</font></label>
                                <input type="text" id="identifiant" placeholder="1234 5678 9012 3456">
                                
                                <label for="nomProprietaire"><font color="white">Nom du Propriétaire :</font></label>
                                <input type="text" id="nomProprietaire" placeholder="DANIEL">
                                
                                <label for="dateExpiration"><font color="white">Date d'Expiration :</font></label>
                                <input type="text" id="dateExpiration" placeholder="AA/MM/YYYY">
                                
                                <label for="prenom"><font color="white">Prénom du propriétaire :</font></label>
                                <input type="text" id="prenom" placeholder="NGUEDJUI">

                                <label for="gmail"><font color="white">Gmail du propriétaire :</font></label>
                                <input type="email" id="gmail" placeholder="exemple@gmail.com">

                                <br>
                                
                                <div class="popup-buttons">
                                    <button id="confirmButton" class="btn btn-primary" onclick="listeTransactions_administrateur()">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy2" viewBox="0 0 16 16">
                                            <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v3.5A1.5 1.5 0 0 1 11.5 6h-7A1.5 1.5 0 0 1 3 4.5V1H1.5a.5.5 0 0 0-.5.5m9.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5z"/>
                                        </svg> 
                                        <strong><font size="5">Confirmer</font></strong>
                                    </button>
                                    <script>
                                            function listeTransactions_administrateur() {
                                                    window.location.href = "{{ url('listeTransactions_administrateur') }}";
                                            }
                                    </script>

                                    <button id="clearButton" type="reset" class="btn btn-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace-fill" viewBox="0 0 16 16">
                                                <path d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8z"/>
                                            </svg> 
                                            <strong><font size="5">Effacer</font></strong>
                                    </button>

                                    <button id="closeButton" onclick="listeTransactions_administrateur()" type="reset" class="btn btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-back" viewBox="0 0 16 16">
                                                <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                            </svg> 
                                            <strong><font size="5">Retour</font></strong>
                                    </button>
                                <script>
                                function listeTransactions_administrateur() {
                                        window.location.href = "{{ url('listeTransactions_administrateur') }}";
                                }
                                </script>

                                </div>
                            </div>
                        </div>

                    </div>
                    
                </div>
                
            </div>
        </div>

        <!-- Footer -->
          <footer>
               <div class="contact">
                    Joindre : <b><strong>+237659435256</strong></b>
               </div>
               <div class="app-name">
                    <b>GESTION DE LA PLATEFORME D'ANNONCES</b>
                    <p id="timer"></p>
               </div>
               <div class="author">
                    Admin : Mlle <b><strong>EVE_JORDANIE</strong></b>
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

                    const emailContent = `
                        Bonjour à vous !
                        josephtiam8@gmail.com de l'entreprise MEMPHYS au
                        (+237 655964653), vous remercie d'avoir effectué le 
                        payement en ligne du service sur notre plateforme.
                        Votre liste contient :
                        ${cart.map(item => `
                            - Boutique: ${item.localisation}
                            - Responsable: ${item.vendeurNom} ${item.vendeurPrenom}
                            - Identifiant: ${item.id}
                            - Service: ${item.name}
                            - Prix Unitaire: ${item.unitaire} CFA
                            - Stock: ${item.stock}
                            - Prix Total: ${item.price} CFA
                        `).join('\n')}
                        Le montant total de votre payement est de : ${transactionTotal.textContent}.
                        Merci de votre confiance !
                    `;

                    doc.text(emailContent, 10, 10);
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