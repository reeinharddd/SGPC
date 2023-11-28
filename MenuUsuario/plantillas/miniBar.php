<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGPC</title>
    <link rel="stylesheet" href="../../css/proyectos.css">
    <link rel="icon" href="../../img/Logo1.png" type="image/png">
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

    #miniBar a.disabled {
        pointer-events: none;
        color: grey;
    }
    </style>
</head>

<body>
    <div id="header">
        <div id="miniBar">
            <a href="#" id="verTareas" class="<?php echo ($current_page === 'Proyectos.php') ? 'disabled' : ''; ?>">Ver
                Tareas</a>
            <a href="#" id="verUsuarios"
                class="<?php echo ($current_page === 'usuariosProyecto.php') ? 'disabled' : ''; ?>">Ver
                Usuarios</a>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        function handleNavigation(elementId, targetPage) {
            $('#miniBar a').removeClass('highlighted');

            $('#' + elementId).addClass('highlighted');

            if (targetPage) {
                window.location.href = targetPage;
            } else {
                history.back();
            }
        }

        $('#verTareas').click(function(e) {
            e.preventDefault();
            handleNavigation('verTareas');
        });

        $('#verUsuarios').click(function(e) {
            e.preventDefault();
            handleNavigation('verUsuarios', 'usuariosProyecto.php');
        });
        $('#volver').click(function(e) {
            e.preventDefault();
            history.back();
        });

        if (performance.navigation.type == 2) {
            $('#verUsuarios').addClass('highlighted');
        }
    });
    </script>
</body>

</html>