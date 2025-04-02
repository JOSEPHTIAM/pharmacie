<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Liste des agents chez l'administrateur</title>
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
                background-image: url("{{ asset('image/Final_acteur.jpg') }}");
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
            padding: 10px 40px;
            background: var(--blue);
            text-decoration: none;
            color: var(--white);
            border-radius: 6px;
            }

            .cardHeader .btn_nouveau {
            position: relative;
            padding: 10px 70px;            
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
            .status.actuellement {
            padding: 2px 4px;
            background: green;
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
                                <img src="{{ asset('image/Final_publizone.jpg') }}" alt="Logo" style="height: 40px;">
                            </span>
                            <span class="title"><strong>PUBLIZONE</strong></span>
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
                        <a href="{{ route('listeClients_administrateur') }}">
                            <span class="icon">
                                <ion-icon name="people-outline"></ion-icon>
                            </span>
                            <span class="title">Clients</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('listeAgents_administrateur') }}">
                            <span class="icon_actuellement">
                                <ion-icon name="people-outline"></ion-icon>
                            </span>
                            <span class="title_actuellement">Agents</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('listeAdministrateurs_administrateur') }}">
                            <span class="icon">
                                <ion-icon name="people-outline"></ion-icon>
                            </span>
                            <span class="title">Administrateurs</span>
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
                        <a href="{{ route('listeTransactions_administrateur') }}">
                            <span class="icon">
                                <ion-icon name="lock-closed-outline"></ion-icon>
                            </span>
                            <span class="title">Transactions</span>
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
                    
                    <form action="/searchAgent_administrateur" class="form-inline">
                    <div class="topbar">
                    <div class="toggle">
                        <img src="{{ asset('image/logo_7.jpg') }}" alt="Logo" style="height: 40px;">                            
                    </div>
                    
                    <div class="search">
                         <label for="keyword">
                            <input type="text" id="keyword" name="keyword" class="form-control" required placeholder="Rechercher un agent">
                            <ion-icon name="search-outline"></ion-icon>                            
                         </label>
                    </div>

                    <button type="submit" class="acces"><strong>Rechercher</strong></button>
                    
                    <font color="#2a2185" size="6">Société : <strong><u>MEMPHY.SARL</u></strong></font>
                                                               
                    <div class="user">
                        <img src="{{ asset('image/logo_8.jpg') }}" alt="Logo" style="height: 40px;">                                                                           
                    </div>
                </div>



                <!-- ======================= Cards ================== -->
                <div class="cardBox">
                    
                    <a href="{{ route('listeClients_administrateur') }}" style="text-decoration: none; color: inherit;">
                        <div class="card_actuellement">
                            <div>
                                <div class="numbers_actuellement">Consulter</div>
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
                                <div class="cardName">Messages</div>
                            </div>
                            <div class="iconBx">
                                <ion-icon name="chatbubbles-outline"></ion-icon>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('listeTransactions_administrateur') }}" style="text-decoration: none; color: inherit;">
                        <div class="card">
                            <div>
                                <div class="numbers">Transactions</div>
                                <div class="cardName">En fcfa</div>
                            </div>
                            <div class="iconBx">
                                <ion-icon name="cash-outline"></ion-icon>
                            </div>
                        </div>
                    </a>
                </div>


                <!-- ================ Order Details List ================= -->
                <div class="details">
                    <div class="recentOrders">
                        <div class="cardHeader">
                            <h2 align="center"><font size="7">LISTE DES AGENTS</font></h2>
                            
                            <a href="/nouveauAgent_administrateur" class="btn_nouveau">
                                <i class="bi bi-person-plus"></i> Nouveau
                            </a>                            
                        </div>

                            @if(session('success'))
                                <div id="successMessage" style="color: green;">{{ session('success') }}</div>
                                <script>
                                    setTimeout(function(){
                                    document.getElementById('successMessage').style.display = 'none';
                                    }, 3000);
                                </script>
                            @endif
                                                  
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <td>Photos</td>
                                        <td>Matricules</td>
                                        <td>Noms</td>
                                        <td>Prénoms</td>
                                        <td>Email</td>
                                        <td>Contacts</td>
                                        <td>Sociétés</td>
                                        <td>Numéros sociétés</td>
                                        <td class="text-center"><strong><font color="black">Actions</font></strong></td>                                                                              
                                    </tr>
                                </thead>

                                <tbody>
                                    @if(isset($users))
                                            @foreach($users as $user)
                                                <tr>
                                                    <td>
                                                        @if($user->photo)
                                                            <img src="{{asset('storage/images'.'/'.$user->photo)}}" alt="Photo" width="50" height="50">
                                                        @else
                                                                N/A
                                                        @endif
                                                    <td>{{$user->matricule}}</td>
                                                    <td>{{$user->nom}}</td>
                                                    <td>{{$user->prenom}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$user->contact}}</td>
                                                    <td>{{$user->nom_societe}}</td>
                                                    <td>{{$user->numero_societe}}</td>
                                                    <td>                                                        
                                                        <span class="status actuellement">
                                                            <a href="{{ url('/OpenAgent_administrateur/' . $user->matricule) }}" class="btn btn-secondary" onclick="return confirm('Êtes-vous sûr de visualiser les détails de cet agent ?');">
                                                                <font color="white"><ion-icon name="eye-outline"></ion-icon></font>
                                                            </a>
                                                        </span> &nbsp;&nbsp;
                                                        <span class="status pending">
                                                            <a href="{{ route('editAgent_administrateur', $user->matricule) }}" class="btn btn-primary" onclick="return confirm('Êtes-vous sûr de vouloir modifier cet agent ?');">
                                                                <font color="white"><i class="bi bi-pencil"></i></font>
                                                            </a>
                                                        </span> &nbsp;&nbsp;
                                                        <span class="status return">
                                                            <a href="{{ url('/deleteAgent_administrateur/' . $user->matricule) }}" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet agent ?');">
                                                                <font color="white"><i class="bi bi-trash"></i></font>
                                                            </a>
                                                        </span>                                                         
                                                    </td> 
                                                </tr>
                                            @endforeach
                                    @else
                                            @foreach(\App\Models\User::where('role', 'Agent')->paginate(1000) as $user)
                                                <tr>
                                                    <td>
                                                        @if($user->photo)
                                                            <img src="{{asset('storage/images'.'/'.$user->photo)}}" alt="Photo" width="50" height="50">
                                                        @else
                                                                N/A
                                                        @endif
                                                    </td>
                                                    <td>{{$user->matricule}}</td>
                                                    <td>{{$user->nom}}</td>
                                                    <td>{{$user->prenom}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>{{$user->contact}}</td>
                                                    <td>{{$user->nom_societe}}</td>
                                                    <td>{{$user->numero_societe}}</td>
                                                    <td>
                                                        <span class="status actuellement">
                                                            <a href="{{ url('/OpenAgent_administrateur/' . $user->matricule) }}" class="btn btn-secondary" onclick="return confirm('Êtes-vous sûr de visualiser les détails de cet agent ?');">
                                                                <font color="white"><ion-icon name="eye-outline"></ion-icon></font>
                                                            </a>
                                                        </span> &nbsp;&nbsp;
                                                        <span class="status pending">
                                                            <a href="{{ route('editAgent_administrateur', $user->matricule) }}" class="btn btn-primary" onclick="return confirm('Êtes-vous sûr de vouloir modifier cet agent ?');">
                                                                <font color="white"><i class="bi bi-pencil"></i></font>
                                                            </a>
                                                        </span> &nbsp;&nbsp;
                                                        <span class="status return">
                                                            <a href="{{ url('/deleteAgent_administrateur/' . $user->matricule) }}" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet agent ?');">
                                                                <font color="white"><i class="bi bi-trash"></i></font>
                                                            </a>
                                                        </span>                                                         
                                                    </td> 
                                                </tr>
                                            @endforeach
                                    @endif
                            </table>
                        </div>
                </div>
            </div>
        </div>


        <!-- Footer -->
        <footer>
            <div class="contact">
                    Joindre : <b><strong>(+237) 659435256 / 655964653</strong></b>
            </div>
            <div class="app-name">
                    <b>PUBLIZONE</b>
                    <p id="timer"></p>
            </div>
            <div class="author">
                    Société : <b><strong>MEMPHY.SARL</strong></b>
            </div>
        </footer>


          <!-- JavaScript to change logos -->
          <script>
               // Array of logo paths
               const logos = [
                    "{{ asset('image/logo_1.jpg') }}",
                    "{{ asset('image/logo_2.jpg') }}",
                    "{{ asset('image/logo_3.jpg') }}",
                    "{{ asset('image/logo_4.jpg') }}"
               ];

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