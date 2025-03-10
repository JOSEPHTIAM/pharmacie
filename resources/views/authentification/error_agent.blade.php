     <!DOCTYPE html>
     <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Page d'aide de l'agent</title>
          
          <!-- Bootstrap CSS -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
          <!-- Bootstrap Icons -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
          
          <!-- Style CSS -->        
          <style>
               body {
                    background: url('image/logo_principal.jpg') no-repeat center center;
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
                    width: 45%;
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
                         <font color="red"><b><strong>CONNEXION</strong></b></font>
                         </h2>

                         @if(session('error'))
                         <div class="alert alert-danger">{{ session('error') }}</div>
                         @endif

                         @if(session('success'))
                              <div class="alert alert-success">{{ session('success') }}</div>
                         @endif

                         <br><br><br>
                         Une erreur est survenue duu à votre temps expiré.
                         <br>
                         <strong>Veuillez réessayer ultérieurement !</strong>
                                   
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



          
          <!-- Bootstrap JS -->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
         

     </body>
</html>


               
