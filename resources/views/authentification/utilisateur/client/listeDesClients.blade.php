     <!DOCTYPE html>
     <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Liste des clients</title>
          
          <!-- Bootstrap CSS -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
          <!-- Bootstrap Icons -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
          
          <!-- Style CSS -->        
          <style>
               body {
                    background: url('image/logo_2.jpg') no-repeat center center;
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
                    width: 55%;
                    max-width: 800px;
                    background-color: rgba(255, 255, 255, 0.914);
               }
               .form-right {
                    flex: 1;
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

               .fixed-button {
                    position: fixed;
                    bottom: 70px; /* Place le bouton juste au-dessus du footer */
                    right: 20px; /* Décalage à droite */
                    background-color: #cf0000;
                    color: white;
                    padding: 10px 20px;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    z-index: 1000;
               }

               .fixed-button:hover {
                    background-color: #E6E6FA; /* Effet hover */
                    color: #cf0000;
               }
               .btn btn-success{
                    width : 200px;
               }
               .form-control{
                    width: 107%;
               }
               
               .container .form-container .form-left .acces {
                    border-color: #000076;
                    width: 25%;
               }

          </style>

     </head>

     <body>
          
          <!-- Navbar -->
          <nav class="navbar">
               <div class="form-left"></div>

               <div class="logo">
                    <img src="{{ asset('image/logo_1.jpg') }}" alt="Logo" style="height: 40px;">
                    Client: <strong><u>EVE JORDANIE</u></strong>
               </div>

               <div class="nav-buttons">
                    <button>
                         <b><strong>Accueil</strong></b>
                    </button>
                    <button>
                         <b><strong>Catégories</strong></b>
                    </button>
                    <button>
                         <b><strong>Annonces</strong></b>
                    </button>
               </div>
               <div>
                    <button class="login-button" id="button1" onclick="connexion()">
                         <b><strong><font color="red">SE DÉCONNECTER</font></strong></b>
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
                              <font color="#000076"><b><strong>LISTE DES CLIENTS</strong></b></font>
                         </h2>

                         @if(session('success'))
                              <div id="successMessage" style="color: green;">{{ session('success') }}</div>
                              <script>
                                   setTimeout(function(){
                                   document.getElementById('successMessage').style.display = 'none';
                                   }, 3000);
                              </script>
                         @endif


                         <br><br>
                         <div class="row mb-4">
                         <div class="col-md-6">
                              <form action="/search_client" class="form-inline">
                              <div class="form-group mr-2">
                                   <label for="keyword" class="mr-2"><strong>Mots clés :</strong></label>
                                   <input type="text" id="keyword" name="keyword" class="form-control" required placeholder="Rechercher">
                              </div>
                         </div>
                         <button type="submit" class="acces">Rechercher</button>                         
                         </form>

                         <div class="table-responsive">

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
                                        <th>Photos</th>
                                        <th>Noms</th>
                                        <th>Prénoms</th>
                                        <th>Email</th>
                                        <th>Contacts</th>
                                        <th>Status</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   @if(isset($users))
                                        @foreach($users as $user)
                                             <tr>
                                                  <td>
                                                       @if($user->photo)
                                                            <img src="{{ asset($user->photo) }}" alt="Photo" width="50" height="50">
                                                       @else
                                                            N/A
                                                       @endif
                                                  </td>
                                                  <td>{{$user->nom}}</td>
                                                  <td>{{$user->prenom}}</td>
                                                  <td>{{$user->email}}</td>
                                                  <td>{{$user->contact}}</td>
                                                  <td>{{$user->statut}}</td>                                                  
                                                  <td class="text-center">
                                                  </td>
                                             </tr>
                                        @endforeach
                                   @else
                                        @foreach(\App\Models\User::where('role', 'Client')->paginate(1000) as $user)
                                             <tr>
                                                  <td>
                                                       @if($user->photo)
                                                            <img src="{{ asset($user->photo) }}" alt="Photo" width="50" height="50">
                                                       @else
                                                            N/A
                                                       @endif
                                                  </td>
                                                  <td>{{$user->nom}}</td>
                                                  <td>{{$user->prenom}}</td>
                                                  <td>{{$user->email}}</td>
                                                  <td>{{$user->contact}}</td>
                                                  <td>{{$user->statut}}</td>
                                                  <td class="text-center">
                                                  </td>
                                             </tr>
                                        @endforeach
                                   @endif
                                   </tbody>
                              </table>
                         </div>

                    </div>
               </div>
          </div>
         
          <div>
               <button class="fixed-button" onclick="accueilClient()">
                    <b><strong>Retour</strong></b>
               </button>
          </div>
          <script>
               function accueilClient() {
                    window.location.href = "{{ url('/accueilClient') }}";
               }
          </script> 



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

     </body>
</html>


               
