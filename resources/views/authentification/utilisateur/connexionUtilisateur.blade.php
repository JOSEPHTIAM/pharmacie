     <!DOCTYPE html>
     <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Page de connexion d'utilisateur</title>
          
          <!-- Bootstrap CSS -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
          
          <!-- Bootstrap Icons -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
          <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
           
          <!-- Style CSS -->        
          <style>
               body {
                    background: url('image/12.jpg') no-repeat center center;
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
                    width: 40%;
                    max-width: 500px;
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
                         <b><strong>Accueil</strong></b>
                    </button>
                    <button>
                         <b><strong>Catégories</strong></b>
                    </button>
                    <button>
                         <b><strong>Anonces</strong></b>
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
                              <font color="#000076"><b><strong>En tant qu'utilisateur !</strong></b></font>
                         </h2>

                         @if(session('error'))
                              <div class="alert alert-danger">{{ session('error') }}</div>
                         @endif

                         @if(session('success'))
                              <div class="alert alert-success">{{ session('success') }}</div>
                         @endif

                         <form action="{{ route('utilisateur.login') }}" method="post">
                              @csrf
                              <div class="form-row">
                                   <div class="form-group col-md-12">
                                        <label for="password"><i class="fas fa-lock"></i> Mot de passe :</label>
                                        <input type="password" id="password" name="password" class="form-control" value="{{ old('password') }}" required>
                                        <input type="checkbox" id="togglePassword"> Afficher le mot de passe
                                        <script>
                                        document.getElementById('togglePassword').addEventListener('change', function() {
                                             var passwordField = document.getElementById('password');
                                             if (this.checked) {
                                                  passwordField.type = 'text';
                                             } else {
                                                  passwordField.type = 'password';
                                             }
                                        });
                                        </script>
                                   </div>
                                   <br>
                                   <div class="form-group col-md-12">
                                        <label for="email"><i class="fas fa-envelope"></i> Email :</label>
                                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        Vous n'avez pas compte ?
                                        <a href="/nouveauUtilisateur">
                                        <strong>Créer un nouveau compte</strong>
                                        </a>
                                   </div>
                              </div>

                              <br>

                              <div class="form-group text-center">
                                   <button type="submit" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-browser-chrome" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M16 8a8 8 0 0 1-7.022 7.94l1.902-7.098a3 3 0 0 0 .05-1.492A3 3 0 0 0 10.237 6h5.511A8 8 0 0 1 16 8M0 8a8 8 0 0 0 7.927 8l1.426-5.321a3 3 0 0 1-.723.255 3 3 0 0 1-1.743-.147 3 3 0 0 1-1.043-.7L.633 4.876A8 8 0 0 0 0 8m5.004-.167L1.108 3.936A8.003 8.003 0 0 1 15.418 5H8.066a3 3 0 0 0-1.252.243 2.99 2.99 0 0 0-1.81 2.59M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                                        </svg>
                                        <strong>Soumettre</strong>
                                   </button>

                                   <button type="reset" class="btn btn-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace-fill" viewBox="0 0 16 16">
                                        <path d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8z"/>
                                        </svg>
                                        <strong>Effacer</strong>
                                   </button>

                                   <button onclick="connexion()" type="button" class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-back" viewBox="0 0 16 16">
                                        <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                        </svg>
                                        <strong>Retour</strong>
                                   </button>
                                   <script>
                                        function connexion() {
                                        window.location.href = "{{ url('connexion') }}";
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


               
