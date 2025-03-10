<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Page d'ouverture service ordinateur du coté administrateur</title>
          
          <!-- Bootstrap CSS -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
          <!-- Bootstrap Icons -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
          
          <!-- Style CSS -->        
          <style>
               body {
                    background: url('{{ asset('image/ordinateur.jpg') }}') no-repeat center center;
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
                    
               </div>
               <div>
                                   
               </div>
          </nav>

          <!-- Body -->
          <div class="container">
               <div class="form-container">
                    <div class="form-left">  
                         <h2 align="center">
                              <font color="#000076"><b><strong>Détails ordinateur</strong></b></font>
                         </h2>
                         @if(session('error'))
                              <div class="alert alert-danger">{{ session('error') }}</div>
                         @endif

                         @if(session('success'))
                              <div class="alert alert-success">{{ session('success') }}</div>
                         @endif

                         <form action="{{ route('updateService1_administrateur', $service1->id_service1) }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              @method('POST')


                              <div class="form-group">
                                   <label for="photo">Photo :</label>
                                   @if($service1->ordinateur && $service1->ordinateur->image_ordinateur)
                                        <div class="photo-container" style="width:450px; background-image: url('{{ asset('storage/images'.'/'.$service1->ordinateur->image_ordinateur) }}');"></div>
                                   @else
                                        N/A
                                   @endif
                                   </div>         
                              <style>
                                   .photo-container {
                                        width: 200%;
                                        height: 300px; /* Adjust the height as needed */
                                        background-size: cover;
                                        background-position: center;
                                        border: 1px solid #ccc;
                                        border-radius: 10px;
                                   }
                              </style>

                              <br>

                              <div class="form-group">
                                   <label for="id_ordinateur">Ordinateur :</label> 
                                   <strong> {{$service1->ordinateur->nom_ordinateur ?? 'N/A'}} </strong>                        
                              </div>

                              <div class="form-group">
                                   <label for="id_ordinateur">Processeur :</label> 
                                   <strong> {{$service1->ordinateur->processeur ?? 'N/A'}} </strong>                        
                              </div>
                              <div class="form-group">
                                   <label for="id_ordinateur">Capacité du disque dur :</label> 
                                   <strong> {{$service1->ordinateur->disque ?? 'N/A'}} GO</strong>                        
                              </div>
                              <div class="form-group">
                                   <label for="id_ordinateur">Capacité de la RAM :</label> 
                                   <strong> {{$service1->ordinateur->ram ?? 'N/A'}} </strong>                        
                              </div>
                              <div class="form-group">
                                   <label for="id_ordinateur">Génération :</label> 
                                   <strong> {{$service1->ordinateur->core ?? 'N/A'}} </strong>                        
                              </div>
                                                            
                              <div class="form-group">
                                   <label for="id_localisation">Localisation :</label> 
                                   <strong> {{$service1->localisation->nom_localisation}} </strong>                        
                              </div>

                              <div class="form-group">
                                   <label for="description_service">Description :</label> 
                                   <strong> {{$service1->description_service}} </strong>                        
                              </div>

                              <div class="form-group">
                                   <label for="prix_service">Prix unitaire :</label> 
                                   <strong> {{$service1->prix_service}} CFA</strong>                        
                              </div>
                              
                              <div class="form-group">
                                   <label for="id_magasin">Stock en magasin :</label> 
                                   <strong> {{$service1->magasin->stock_magasin}} </strong>                        
                              </div>
                              
                              <div class="form-group">
                                   <label for="total_service">Prix total :</label> 
                                   <strong> {{$service1->total_service}} CFA</strong>                        
                              </div>

                              <div class="form-group">
                                   <label for="matricule">Responsable :</label> 
                                   <strong> "{{$service1->user->role}}" : &nbsp;&nbsp;{{$service1->user->nom}} {{$service1->user->prenom}} </strong>                        
                              </div>

                         
                              <div class="form-group text-center">
                              <button onclick="listeServices_administrateur()" type="reset" class="btn btn-danger">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-back" viewBox="0 0 16 16">
                                        <path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                                   </svg>
                                   <strong>Retour</strong>
                              </button>
                              <script>
                                   function listeServices_administrateur() {
                                        window.location.href = "{{ url('listeServices_administrateur') }}";
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
                    <p id="timer"></p>
               </div>
               <div class="author">
                    Admin : Mlle <b><strong>EVE_JORDANIE</strong></b>
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