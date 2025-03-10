     <!DOCTYPE html>
     <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Page du token de l'agent</title>
          
          <!-- Bootstrap CSS -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
          <!-- Bootstrap Icons -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
          
          <!-- Style CSS -->        
          <style>
               body {
                    background: url('image/a111111.jpg') no-repeat center center;
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
                    max-width: 450px;
                    background-color: rgba(255, 255, 255, 0.914);
               }
               .form-right {
                    flex: 1;
                    background: url('image/logo_5.jpg') no-repeat center center;                    
                    justify-content: center;                    
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
               .form-right .retour {
                    background-color: #000076;
               }
               .form-container input[type="checkbox"] {
                    margin-left: 10px;
               }

               form label {
                    font-weight: bold;
               }
               .form-left .btn-primary {
                    background-color: #000076;
                    border-color: #000076;
               }
               .form-left .btn-warning {
                    background-color: #e68a00;
                    border-color: #e68a00;
               }
               .form-left .btn-danger {
                    background-color: #cf0000;
                    border-color: #cf0000;
               }

               .btn-primary:hover {
                    background-color: #000000;
                    border-color: #000000;
               }
               .btn-warning:hover {
                    background-color: #000000;
                    border-color: #000000;
                    color: white;
               }
               .btn-danger:hover {
                    background-color: #000000;
                    border-color: #000000;
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
                    <button>
                         <b><strong><del>Accueil</del></strong></b>
                    </button>
                    <button>
                         <b><strong><del>Catégories</del></strong></b>
                    </button>
                    <button>
                         <b><strong><del>Anonces</del></strong></b>
                    </button>
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
                              <font color="#000076"><b><strong>Vous êtes à présent un agent !</strong></b></font>
                         </h2>
                         @if(session('error'))
                              <div class="alert alert-danger">{{ session('error') }}</div>
                         @endif

                         @if(session('success'))
                              <div class="alert alert-success">{{ session('success') }}</div>
                         @endif

                         <br>
                         <form id="timeForm" action="{{ route('storeTimeAgent') }}" method="POST">
                              @csrf

                              <div class="form-group text-center">
                                   <label for="time_option">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-postcard-fill" viewBox="0 0 16 16">
                                             <path d="M11 8h2V6h-2z"/>
                                             <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm8.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0zM2 5.5a.5.5 0 0 0 .5.5H6a.5.5 0 0 0 0-1H2.5a.5.5 0 0 0-.5.5M2.5 7a.5.5 0 0 0 0 1H6a.5.5 0 0 0 0-1zM2 9.5a.5.5 0 0 0 .5.5H6a.5.5 0 0 0 0-1H2.5a.5.5 0 0 0-.5.5m8-4v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5"/>
                                        </svg>
                                        Choississez une plage horaire
                                   </label>
                                   <select id="time_option" name="time_option" class="form-control col-md-12" required>
                                        <option value="">Sélectionnez une période</option>
                                        <option value="5">05 secondes</option>
                                        <option value="1800">30 minutes</option>
                                        <option value="3600">01 heure</option>
                                        <option value="5400">01 heure 30 minutes</option>
                                        <option value="7200">02 heures</option>
                                        <option value="9000">02 heures 30 minutes</option>
                                        <option value="10800">03 heures</option>
                                   </select>
                              </div>

                              <br>

                              <div class="form-group text-center">
                                   <button type="submit" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy2" viewBox="0 0 16 16">
                                             <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v3.5A1.5 1.5 0 0 1 11.5 6h-7A1.5 1.5 0 0 1 3 4.5V1H1.5a.5.5 0 0 0-.5.5m9.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5z"/>
                                        </svg>
                                        <strong>Valider</strong>
                                   </button>

                                   <button onclick="connexionUtilisateur()" type="reset" class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-back" viewBox="0 0 16 16">
                                             <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                        </svg>
                                        <strong>Retour</strong>
                                   </button>
                                   <script>
                                        function connexionUtilisateur() {
                                             window.location.href = "{{ url('connexionUtilisateur') }}";
                                        }
                                   </script>
                              </div>

                         </form>
                              
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
               </div>
               <div class="author">
                    Admin : Mlle <b><strong>EVE_JORDANIE</strong></b>
               </div>
          </footer>


     </body>
</html>


               
