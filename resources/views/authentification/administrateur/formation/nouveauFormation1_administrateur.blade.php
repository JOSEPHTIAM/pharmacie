<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Page de nouvelle formation pdf du coté administrateur</title>
          
          <!-- Bootstrap CSS -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
          
          <!-- Bootstrap Icons -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
          <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
            
          <!-- Style CSS -->        
          <style>
               body {
                    background: url('image/electromenager.jpg') no-repeat center center;
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
                         <h2>
                              <font color="#000076"><b><strong>Nouvelle formation pdf</strong></b></font>
                         </h2>
                         @if(session('error'))
                              <div class="alert alert-danger">{{ session('error') }}</div>
                         @endif

                         @if(session('success'))
                              <div class="alert alert-success">{{ session('success') }}</div>
                         @endif

                         <form action="{{ route('storeFormation1_administrateur') }}" method="post" enctype="multipart/form-data">
                              @csrf

                              <!-- Nom de la formation -->
                              <div class="form-row">
                                   <div class="form-group col-md-12">
                                        <label for="nom_formation">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
                                                  <path d="M3.5 3.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1h2zM3.5 7a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1h2zM3.5 10.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1h2z"/>
                                                  <path d="M5 3h10.5a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zM5 7h10.5a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zM5 10.5h10.5a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1z"/>
                                             </svg>
                                             Nom de la formation <font color="red">*</font> :
                                        </label>
                                        <input type="text" id="nom_formation" name="nom_formation" class="form-control" value="{{ old('nom_formation') }}" placeholder="Cours du HMTL" required>
                                   </div>
                              </div>

                              
                              <!-- Responsable de la formation -->
                              <div class="form-row">
                                   <div class="form-group col-md-12">
                                   <label for="matricule">
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
                                        <path d="M3.5 3.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1h2zM3.5 7a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1h2zM3.5 10.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1h2z"/>
                                        <path d="M5 3h10.5a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zM5 7h10.5a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zM5 10.5h10.5a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1z"/>
                                   </svg>
                                   Responsable de l'appareil <font color="red">*</font> :
                                   </label>
                                   <select name="matricule" id="matricule" class="form-control" required>
                                        <option value="">Sélectionner un administrateur ou un agent</option>                                             
                                        @foreach(\App\Models\User::where('role', 'Administrateur')->orWhere('role', 'Agent')->paginate(1000) as $user)
                                             <option value="{{ $user->matricule }}">
                                                  "{{ $user->role }}" : &nbsp;&nbsp;{{ $user->nom }} {{ $user->prenom }}
                                             </option>
                                        @endforeach
                                   </select>
                                   </div>
                              </div>

                              
                              
                              <!-- PDF de la formation -->
                              <div class="form-row">
                                   <div class="form-group col-md-12">
                                        <label for="pdf_formation">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                                  <path d="M5.5 6.5A.5.5 0 0 1 6 6h4a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5H6a.5.5 0 0 1-.5-.5v-3z"/>
                                                  <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5l3 3.5z"/>
                                             </svg>
                                             PDF de la formation :
                                        </label>
                                        <input type="file" id="pdf_formation" name="pdf_formation" class="form-control" accept="application/pdf">
                                   </div>
                              </div>
                    

                              <!-- Description de la formation -->
                              <div class="form-row">
                                   <div class="form-group col-md-12">
                                        <label for="description_formation">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                                  <path d="M4 5h8V4H4v1zM4 7h8v1H4V7zM4 9h8v1H4V9z"/>
                                                  <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5l3 3.5z"/>
                                             </svg>
                                             Description de la formation:
                                        </label>
                                        <input type="text" id="description_formation" name="description_formation" class="form-control" value="{{ old('description_formation') }}" placeholder="Compréhensif et instructif">
                                   </div>
                              </div>


                              <!-- Prix de la formation -->
                              <div class="form-row">
                                   <div class="form-group col-md-12">
                                        <label for="prix_formation">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                                                  <path d="M4 10a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                                                  <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5l3 3.5z"/>
                                             </svg>
                                             Prix de la formation (en FCFA) <font color="red">*</font> :
                                        </label>
                                        <input type="number" id="prix_formation" name="prix_formation" class="form-control" value="{{ old('prix_formation') }}" placeholder="Ex: 400" required min="0" oninput="calculateTotal()">
                                   </div>
                              </div>


                              <!-- Niveau de la formation -->
                              <div class="form-row">
                                   <div class="form-group col-md-12">
                                        <label for="niveau_formation">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
                                                  <path d="M3.5 3.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1h2zM3.5 7a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1h2zM3.5 10.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1h2z"/>
                                                  <path d="M5 3h10.5a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zM5 7h10.5a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zM5 10.5h10.5a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1z"/>
                                             </svg>
                                             Niveau de la formation <font color="red">*</font> :
                                        </label>
                                        <input type="number" id="niveau_formation" name="niveau_formation" class="form-control" value="{{ old('niveau_formation') }}" placeholder="1" required min="0" oninput="calculateTotal()">
                                   </div>
                              </div>


                              <!-- Prix total de la formation -->
                              <div class="form-row">
                                   <div class="form-group col-md-12">
                                        <label for="total_formation">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                                                  <path d="M4 10a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/>
                                                  <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5l3 3.5z"/>
                                             </svg>
                                             Prix total (en FCFA) <font color="red">*</font> :
                                        </label>
                                        <input type="number" id="total_formation" name="total_formation" class="form-control" value="{{ old('total_formation') }}" placeholder="Génération automatique du prix total" required min="0" readonly>
                                   </div>
                              </div>





                              <!-- Boutons -->
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
               
               // Pour la gestion de calculs du prix_formation * niveau_formation = total_formation
               function calculateTotal() {
                    const prixFormation = document.getElementById('prix_formation').value;
                    const niveauFormation = document.getElementById('niveau_formation').value;

                    const totalFormation = prixFormation * niveauFormation;
                    document.getElementById('total_formation').value = totalFormation;
               }
                    

               // Pour la gestion du temps
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

