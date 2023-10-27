<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Gestión de Tareas</title>
    </head>
    <header>
        <h1>Registro de Tareas</h1>
    </header>
    <body>
        <form method="post" action="addTarea.php">
            <label>Código de la Tarea: *<input type="text" name="Cod"></label>
            <br>
            <label>Nombre de la Tarea: *<input type="text" name="Nombre"></label>
            <br>
            <label>Descripción de la Tarea: *<input type="text" name="Des"></label>
            <br>
            <label>Estado de la Tarea: *<input type="text" name="estado"></label>

            <input type="reset" value="Cancel">
            <input type="submit" value="Send">
        </form>
    </body>
</html>