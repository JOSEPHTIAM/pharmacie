<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gestion des mécaniciens</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        <style>
            .dropdown-btn {
                min-width: 200px;
            }

            .dropdown-divider {
                margin: 0.5rem 0;
            }
            .btn-brown {
                background-color: #8B4513;
                border-color: #8B4513;
                color: #FFFFFF;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1 class="mt-5 text-center">
                <font color="green"> Bienvenue à la gestion des mécaniciens !</font>
            </h1>

            <div class="d-flex justify-content-center mt-5">
                <!-- Bouton administrateur -->
                <div class="dropdown me-3"></div>
            </div>


        </div>
        <!-- Bootstrap JS (il est optionnel) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
