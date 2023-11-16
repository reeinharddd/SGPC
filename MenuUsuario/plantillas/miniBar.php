<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="icon" href="../img/Logo1.png" type="image/png">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
    #header {
        background-color: #f1f1f1;
        padding: 20px;
        text-align: center;
    }

    #miniBar a {
        margin: 0 15px;
        text-decoration: none;
        color: black;
        font-weight: bold;
    }

    #miniBar a:hover {
        color: blue;
    }

    .highlighted {
        background-color: yellow;
    }
    </style>
</head>

<body>
    <div id="header">
        <div id="miniBar">
            <a href="#" id="verTareas">Ver Tareas</a>
            <a href="#" id="verUsuarios">Ver Usuarios</a>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        // Función para resaltar y manejar la navegación
        function handleNavigation(elementId, targetPage) {
            // Elimina la clase 'highlighted' de todos los elementos
            $('#miniBar a').removeClass('highlighted');

            // Resalta el elemento actual
            $('#' + elementId).addClass('highlighted');

            // Maneja la navegación según el destino
            if (targetPage) {
                window.location.href = targetPage;
            } else {
                // Si no hay un destino, simplemente despliega un mensaje (puedes ajustar según sea necesario)
                console.log("No hay destino específico.");
            }
        }

        // Maneja el clic en 'Ver Tareas'
        $('#verTareas').click(function(e) {
            e.preventDefault(); // Evita la navegación normal al hacer clic
            handleNavigation('verTareas', null);
        });

        // Maneja el clic en 'Ver Usuarios'
        $('#verUsuarios').click(function(e) {
            e.preventDefault();
            handleNavigation('verUsuarios', 'usuariosProyecto.php');
        });

        // Maneja el clic en el botón "Volver"
        $('#volver').click(function(e) {
            e.preventDefault();
            history.back();
        });

        // Verifica si la página se ha cargado desde el historial
        if (performance.navigation.type == 2) {
            // Si se ha cargado desde el historial, marca como resaltado el enlace correspondiente
            $('#verUsuarios').addClass('highlighted');
        }
    });
    </script>
</body>

</html>