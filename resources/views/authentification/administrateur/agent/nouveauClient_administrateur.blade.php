     <!DOCTYPE html>
     <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Page du nouveau client du coté administrateur</title>
          
          <!-- Bootstrap CSS -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
          
          <!-- Bootstrap Icons -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
          <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
           
          <!-- Style CSS -->        
          <style>
               body {
                    background: url('image/user.jpg') no-repeat center center;
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
                    <img src="{{ asset('image/Final_publizone.jpg') }}" alt="Logo" style="height: 40px;">
               </div>

               <div class="nav-buttons">
                    
               </div>
               <div>
                                  
               </div>
          </nav>



          <!-- Body -->
          <div class="container">

               <div class="form-container">

                    <div class="form-left">                    
                         <h2>
                              <font color="#000076"><b><strong>Nouveau client</strong></b></font>
                         </h2>
                         @if(session('error'))
                              <div class="alert alert-danger">{{ session('error') }}</div>
                         @endif

                         @if(session('success'))
                              <div class="alert alert-success">{{ session('success') }}</div>
                         @endif

                         <form action="{{ route('store_client') }}" method="post" enctype="multipart/form-data">
                              @csrf

                              <div class="form-row">
                                   <div class="form-group col-md-12">
                                   <label for="role">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-postcard-fill" viewBox="0 0 16 16">
                                             <path d="M11 8h2V6h-2z"/>
                                             <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm8.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0zM2 5.5a.5.5 0 0 0 .5.5H6a.5.5 0 0 0 0-1H2.5a.5.5 0 0 0-.5.5M2.5 7a.5.5 0 0 0 0 1H6a.5.5 0 0 0 0-1zM2 9.5a.5.5 0 0 0 .5.5H6a.5.5 0 0 0 0-1H2.5a.5.5 0 0 0-.5.5m8-4v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5"/>
                                        </svg>
                                        Vous êtes <font color="red">*</font> : 
                                   </label>
                                   <select id="role" name="role" class="form-control" required>
                                        <option value="">Sélectionnez un rôle</option>
                                        <option value="Client">Client</option>
                                   </select>
                                   </div>
                                   <div class="form-group col-md-12">
                                        <label for="photo"><i class="fas fa-graduation-cap"></i> Photo :</label>
                                        <input type="file" id="photo" name="photo" class="form-control" value="{{ old('photo') }}">
                                   </div>
                              </div>

                              <div class="form-row">
                                   <div class="form-group col-md-12">
                                        <label for="nom">
                                             <i class="fas fa-user"></i>
                                             Nom <font color="red">*</font> :
                                        </label>
                                        <input type="text" id="nom" name="nom" class="form-control" value="{{ old('nom') }}" required>
                                   </div>
                                   <div class="form-group col-md-12">
                                        <label for="prenom">
                                             <i class="fas fa-user"></i>
                                             Prénom :
                                        </label>
                                        <input type="text" id="prenom" name="prenom" class="form-control" value="{{ old('prenom') }}">
                                   </div>
                              </div>

                              <div class="form-row">
                                   <div class="form-group col-md-12">
                                        <label for="contact">
                                             <i class="fas fa-phone"></i>
                                             Contact <font color="red">*</font> :
                                        </label>
                                        <input type="tel" id="contact" name="contact" class="form-control" value="{{ old('contact') }}" required>
                                   </div>                    
                              </div>

                              <div class="form-row">
                                   <div class="form-group col-md-12">
                                        <label for="email">
                                             <i class="fas fa-envelope"></i>
                                             Email <font color="red">*</font> :
                                        </label>
                                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                   </div>
                                   <div class="form-group col-md-12">
                                        <label for="password">
                                             <i class="fas fa-lock"></i>
                                             Mot de passe (EX: @12MemphysarlSociety) <font color="red">*</font> :
                                        </label>
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
                              </div>

                              <!-- Champs conditionnels pour le rôle Administrateur -->
                              <div class="form-row d-none" id="statut_administrateur">
                                   <div class="form-group col-md-12">
                                        <label for="statut"><i class="fas fa-id-badge"></i> Statut :</label>
                                        <input type="text" id="statut" name="statut" class="form-control" value="{{ old('statut') }}">
                                   </div>
                              </div>

                              <!-- Champs conditionnels pour le rôle Agent -->
                              <div class="form-row d-none" id="agentFields">
                                   <div class="form-group col-md-12">
                                        <label for="nom_societe">
                                             <i class="fas fa-building"></i>
                                             Nom de la société :
                                        </label>
                                        <input type="text" id="nom_societe" name="nom_societe" class="form-control" value="{{ old('nom_societe') }}">
                                   </div>
                                   <div class="form-group col-md-12">
                                        <label for="numero_societe">
                                             <i class="fas fa-address-card"></i>
                                             Numéro de la société :
                                        </label>
                                        <input type="text" id="numero_societe" name="numero_societe" class="form-control" value="{{ old('numero_societe') }}">
                                   </div>
                                   <div class="form-group col-md-12">
                                        <label for="non_redevence">
                                             <i class="fas fa-tag"></i>
                                             Numéro de Redevence :
                                        </label>
                                        <input type="file" id="non_redevence" name="non_redevence" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png" value="{{ old('non_redevence') }}">
                                   </div>
                              </div>


                              <div class="form-group text-center">
                                   <button type="submit" class="btn btn-primary">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy2" viewBox="0 0 16 16">
                                        <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v3.5A1.5 1.5 0 0 1 11.5 6h-7A1.5 1.5 0 0 1 3 4.5V1H1.5a.5.5 0 0 0-.5.5m9.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5z"/>
                                   </svg>
                                   <strong>Soumettre</strong>
                                   </button>

                                   <button type="reset" class="btn btn-warning">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-backspace-fill" viewBox="0 0 16 16">
                                        <path d="M15.683 3a2 2 0 0 0-2-2h-7.08a2 2 0 0 0-1.519.698L.241 7.35a1 1 0 0 0 0 1.302l4.843 5.65A2 2 0 0 0 6.603 15h7.08a2 2 0 0 0 2-2zM5.829 5.854a.5.5 0 1 1 .707-.708l2.147 2.147 2.146-2.147a.5.5 0 1 1 .707.708L9.39 8l2.146 2.146a.5.5 0 0 1-.707.708L8.683 8.707l-2.147 2.147a.5.5 0 0 1-.707-.708L7.976 8z"/>
                                   </svg>
                                   <strong>Effacer</strong>
                                   </button>

                                   <button onclick="listeClients_administrateur()" type="reset" class="btn btn-danger">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-back" viewBox="0 0 16 16">
                                        <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                   </svg>
                                   <strong>Retour</strong>
                                   </button>
                                   <script>
                                   function listeClients_administrateur() {
                                        window.location.href = "{{ url('listeClients_administrateur') }}";
                                   }
                                   </script>
                              </div>
                         </form>
                 
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


          <!-- Du JS -->
          <script>
               document.getElementById('role').addEventListener('change', function() {
                    const role = this.value;
                    document.getElementById('agentFields').classList.add('d-none');
                    document.getElementById('statut_administrateur').classList.add('d-none');
                    
                    if (role === 'Agent') {
                         document.getElementById('agentFields').classList.remove('d-none');
                    } else if (role === 'Administrateur') {
                         document.getElementById('statut_administrateur').classList.remove('d-none');
                    }
               });

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

     </body>
</html>

