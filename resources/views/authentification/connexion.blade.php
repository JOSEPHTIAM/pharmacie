     <!DOCTYPE html>
     <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Page de choix de connexion</title>
          
          <!-- Bootstrap CSS -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
          <!-- Bootstrap Icons -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
          
          <!-- Style CSS -->        
          <style>
               body {
                    background: url('image/Final_accueil.jpg') no-repeat center center;
                    background-size: cover; /* This will make the background image cover the entire page */
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
                    margin: 0 20px;
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
                    background-color: white;
               }

               .center-logo img {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100vw;
                    height: 100vh;
                    object-fit: cover; /* Ensures the image fills the screen while maintaining aspect ratio */
               }

               /* Pour le Body */
               .container {
                display: flex;
                flex: 1;
                justify-content: center;
                align-items: center;
                padding: 20px;
               }

               .form-container {
                    display: flex;
                    border: 1px solid #ccc;
                    border-color: rgb(0, 0, 118);
                    box-shadow: 0 0 10px rgb(0, 0, 118);
                    border-radius: 10px;
                    overflow: hidden;
                    width: 50%;
                    max-width: 500px;
                    background-color: rgba(255, 255, 255, 0.914);
               }
               .form-right {
                    flex: 1;                    
                    background: url('image/Final_publizone.jpg') no-repeat center center;                    
                    justify-content: center;
                    width: 100px;
                    max-width: 255px;
                    max-height: 300px;                  
               }
               .form-left {
                    //flex: 1;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    padding: 20px;
               }
               .form-left h2 {
                    margin-bottom: 20px;
               }
               .form-left button {
                    margin: 10px;
                    padding: 10px 20px;
                    border: none;
                    background-color: #007bff;
                    color: white;
                    border-radius: 5px;
                    cursor: pointer;
               }
               .form-left button:hover {
                    background-color: #010101;
               }
               .form-left .utilisateur {
                    background-color: green;
               }
               .form-left .administrateur {
                    background-color: #000076;
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
                    <button class="login-button" id="button1" onclick="connexion1()">
                         <b><strong>Accueil</strong></b>
                    </button>
                    <script>
                         function connexion1() {
                         window.location.href = "{{ url('/') }}";
                         }
                    </script> 

                    <button class="login-button" id="button1" onclick="connexion()">
                         <b><strong>Annonces</strong></b>
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



          <!-- Body -->
          <div class="container">
               <div class="form-container">

                    <div class="form-left">
                         <h2>
                         <font color="#000076"><b><strong>CONNEXION</strong></b></font>
                         </h2>

                         Faites votre choix de connexion !

                         <br><br><br>

                         <button class="utilisateur" id="button1" onclick="connexionUtilisateur()">
                              <strong>En tant qu'utilisateur</strong>
                         </button>
                         <script>
                              function connexionUtilisateur() {
                                   window.location.href = "{{ url('/connexionUtilisateur') }}";
                              }
                         </script>

                         <button class="administrateur" id="button1" onclick="connexionAdministrateur()">
                              <strong>En tant qu'administrateur</strong>
                         </button>
                         <script>
                              function connexionAdministrateur() {
                                   window.location.href = "{{ url('/connexionAdministrateur') }}";
                              }
                         </script>
                              
                    </div>

                    <div class="form-right"></div>
               </div>
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
                    Société : <b><strong>MEMPHY.SARL</strong></b>
               </div>
          </footer>


     </body>
</html>


               
