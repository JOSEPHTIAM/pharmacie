<!DOCTYPE html>
     <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Page de modification d'electronique du coté administrateur</title>
          
          <!-- Bootstrap CSS -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
          <!-- Bootstrap Icons -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
          
          <!-- Style CSS -->        
          <style>
               body {
                    background: url('{{ asset('image/Final_electronique.jpg') }}') no-repeat center center;
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
                    width: 35%;
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
                    <h2 align="center">
                        <font color="#000076"><b><strong>Modification du service électronique</strong></b></font>
                    </h2>
                    @if(session('error'))
                         <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @if(session('success'))
                         <div class="alert alert-success">{{ session('success') }}</div>
                    @endif



                    <form action="{{ route('updateService_administrateur', $service->id_service) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        
                        <div class="form-group">
                            <label for="id_electromenager">Electronique :</label>
                            <select name="id_electromenager" id="id_electromenager" class="form-control">
                                @foreach(\App\Models\Electromenager::all() as $electromenager)
                                    <option value="{{ $electromenager->id_electromenager }}" {{ $service->id_electromenager == $electromenager->id_electromenager ? 'selected' : '' }}>
                                        "" {{ $electromenager->nom_electromenager }} "" de {{ $electromenager->puissance_electromenager }}Watts -- {{ $electromenager->tension_electromenager }}Volts
                                    </option>
                                @endforeach
                            </select>
                            @error('id_electromenager')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="id_localisation">Localisation :</label>
                            <select name="id_localisation" id="id_localisation" class="form-control" required>
                                @foreach(\App\Models\Localisation::all() as $localisation)
                                    <option value="{{ $localisation->id_localisation }}" {{ $service->id_localisation == $localisation->id_localisation ? 'selected' : '' }}>
                                        "" {{ $localisation->nom_localisation }} "" de {{ $localisation->quartier_localisation }}--{{ $localisation->ville_localisation }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_localisation')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="description_service">Description :</label>
                            <input type="text" class="form-control" id="description_service" name="description_service" value="{{ old('description_service', $service->description_service) }}">
                                @error('description_service')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="prix_service">Prix unitaire (en FCFA) :</label>
                            <input type="number" class="form-control" id="prix_service" name="prix_service" value="{{ old('prix_service', $service->prix_service) }}" required min="0" oninput="calculateTotal()">
                            @error('prix_service')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="id_magasin">Stock en magasin :</label>
                            <select name="id_magasin" id="id_magasin" class="form-control" required onchange="calculateTotal()">
                                @foreach(\App\Models\Magasin::all() as $magasin)
                                    <option value="{{ $magasin->id_magasin }}" {{ $service->id_magasin == $magasin->id_magasin ? 'selected' : '' }}>
                                        "" {{ $magasin->stock_magasin }} ""
                                    </option>
                                @endforeach
                            </select>
                            @error('id_magasin')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="matricule">Responsable :</label>
                            <select name="matricule" id="matricule" class="form-control" required>
                                @foreach(\App\Models\User::where('role', 'Administrateur')->orWhere('role', 'Agent')->get() as $user)
                                    <option value="{{ $user->matricule }}" {{ $service->matricule == $user->matricule ? 'selected' : '' }}>
                                        "{{ $user->role }}" : &nbsp;&nbsp;{{ $user->nom }} {{ $user->prenom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('matricule')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
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
               // Pour la gestion de calculs du prix_unitaire*stock_magasin=total_prix
               function calculateTotal() {
                    const prixService = document.getElementById('prix_service').value;
                    const idMagasin = document.getElementById('id_magasin');
                    const selectedMagasin = idMagasin.options[idMagasin.selectedIndex];
                    const stockMagasin = selectedMagasin ? selectedMagasin.getAttribute('data-stock') : 0;

                    const totalService = prixService * stockMagasin;
                    document.getElementById('total_service').value = totalService;
               }
               

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

