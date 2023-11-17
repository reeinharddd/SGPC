<?php
include '../conexion.php';
class consultas
{

    public function getProyectos()
    {
        $conexion = new conexion();
        $proyectos = array();
        if ($conexion->connect()) {
            $con = $conexion->getConexion();
            $sql = "SELECT P.idProyecto, P.nombre, P.descripcion, P.ubicacion, P.fechaInicio, P.fechaFinal, P.estado 
            FROM Proyecto P 
            INNER JOIN UsuarioProyecto UP ON P.idProyecto = UP.idProyecto
            WHERE UP.idUsuario = " . $_SESSION['id'] . " AND P.estado != 'FIN'
            ORDER BY FIELD(P.estado, 'ACT', 'RET', 'PEN')";
            $result = $conexion->exeqSelect($sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $proyectos[] = $row;
                }
                unset($result, $row);
            } else {
                echo "No se encontraron proyectos.";
            }
        }
        $conexion->close();
        return $proyectos;
    }
    public function getTareas($proyecto)
    {
        $conexion = new conexion();
        $tareas = array();

        if ($conexion->connect()) {
            $con = $conexion->getConexion();
            $usuario = $_SESSION['id'];

            $query = "SELECT
            T.titulo AS NombreTarea,
            T.descripcion AS DescripcionTarea,
            T.estado,
            T.idTarea AS idTarea
        FROM
            Proyecto AS P
            INNER JOIN UsuarioProyecto AS UP ON P.idProyecto = UP.idProyecto
            INNER JOIN UsuarioTarea AS UT ON UP.idUsuario = UT.idUsuario
            INNER JOIN Tarea AS T ON UT.idTarea = T.idTarea
            INNER JOIN ProyectoTarea AS PT ON P.idProyecto = PT.idProyecto AND T.idTarea = PT.idTarea
        WHERE
            UP.idUsuario = ?
            AND P.idProyecto = ?
            AND T.estado != 'FIN'  -- Excluir tareas finalizadas
        ORDER BY PT.fechaFinal ASC";

            // Utilizar una consulta preparada
            $stmt = $con->prepare($query);
            $stmt->bind_param("ii", $usuario, $proyecto);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $tareas[] = $row;
                }
                unset($result, $row);
            } else {
                echo "No se encontraron Tareas.";
            }

            $stmt->close();
        }

        $conexion->close();
        return $tareas;
    }

    public function getComentarios($proyecto, $tarea)
    {
        $conexion = new conexion();
        $comentarios = array();
        if ($conexion->connect()) {
            $con = $conexion->getConexion();
            $query = "SELECT *
            FROM Comentario
            WHERE idProyecto = $proyecto
              AND idTarea = $tarea
            ORDER BY fechaComentario ASC;";
            $result = $conexion->exeqSelect($query);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $comentarios[] = $row;
                }
                unset($result, $row);
            } else {
                echo "No se encontraron tareas.";
            }
        }

        $conexion->close();
        return $comentarios;
    }
    public function getUsuarioAsignado($idTarea)
    {
        $conexion = new conexion();
        $usuarioAsignado = null;
        if ($conexion->connect()) {
            $con = $conexion->getConexion();
            $query = "SELECT U.nombre, U.apellidoPat, U.apellidoMat
                      FROM Usuario U
                      JOIN UsuarioTarea UT ON U.idUsuario = UT.idUsuario
                      WHERE UT.idTarea = $idTarea
                      LIMIT 1";

            $result = $conexion->exeqSelect($query);

            if ($result && $result->num_rows > 0) {
                $usuarioAsignado = $result->fetch_assoc();
                $nombreCompleto = $usuarioAsignado['nombre'] . ' ' . $usuarioAsignado['apellidoPat'] . ' ' . $usuarioAsignado['apellidoMat'];
                return $nombreCompleto;
            } else {
                return "No asignado";
            }
        }
    }
    public function getComentariosTarea($idTarea)
    {
        $conexion = new conexion();
        $comentarios = array();
        if ($conexion->connect()) {
            $con = $conexion->getConexion();
            $query = "SELECT C.descripcion, C.fechaComentario, U.nombre AS nombreUsuario
            FROM Comentario C
            JOIN Usuario U ON C.idUsuario = U.idUsuario
            WHERE C.idTarea = $idTarea
            ORDER BY C.fechaComentario ASC";

            $result = $conexion->exeqSelect($query);

            if ($result && $result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $comentarios[] = $row;
                }
                unset($result, $row);
            } else {
                echo "No se encontraron comentarios.";
            }
        }
        return $comentarios;
    }
    public function getInfoProyecto($idProyecto)
    {
        $conexion = new conexion();
        $infoProyecto = null;
        if ($conexion->connect()) {
            $con = $conexion->getConexion();
            $query = "SELECT P.nombre, P.descripcion, P.ubicacion, P.fechaInicio, P.fechaFinal, P.estado
            FROM Proyecto P
            WHERE P.idProyecto = $idProyecto";

            $result = $conexion->exeqSelect($query);

            if ($result && $result->num_rows > 0) {
                $infoProyecto = $result->fetch_assoc();
                return $infoProyecto;
            } else {
                echo "No se encontró el proyecto.";
            }
        }
    }
    public function obtenerPrimerasTareas($usuario, $proyecto, $cantidad)
    {
        $conexion = new conexion();
        $tareas = array();

        if ($conexion->connect()) {
            $con = $conexion->getConexion();

            // Obtener la fecha actual en formato MySQL
            $fechaActual = date('Y-m-d');

            $query = "SELECT T.titulo AS NombreTarea, T.descripcion AS DescripcionTarea, T.idTarea, PT.fechaFinal, T.estado
                  FROM Tarea T
                  INNER JOIN UsuarioTarea UT ON T.idTarea = UT.idTarea
                  INNER JOIN ProyectoTarea PT ON T.idTarea = PT.idTarea
                  WHERE UT.idUsuario = ? AND T.idProyecto = ? AND PT.idProyecto = ?
                  AND PT.fechaFinal BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
                  ORDER BY PT.fechaFinal ASC LIMIT $cantidad";

            // Utilizar una consulta preparada
            $stmt = $con->prepare($query);
            $stmt->bind_param("iii", $usuario, $proyecto, $proyecto);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $tareas[] = $row;
                }
                unset($result, $row);
            } else {
                echo "No se encontraron tareas.";
            }

            $stmt->close();
        }

        $conexion->close();
        return $tareas;
    }
    public function obtenerNombreEstado($codigoEstado)
    {
        $conexion = new conexion();
        $nombreEstado = null;

        if ($conexion->connect()) {
            $con = $conexion->getConexion();
            $query = "SELECT nombre FROM Estado WHERE codigo = ?";

            // Utilizar una consulta preparada
            $stmt = $con->prepare($query);
            $stmt->bind_param("s", $codigoEstado);
            $stmt->execute();
            $stmt->bind_result($nombreEstado); // Corregir aquí

            if ($stmt->fetch()) {
                // No es necesario asignar a otra variable, ya está en $nombreEstado
            }

            $stmt->close();
        }

        $conexion->close();
        return $nombreEstado;
    }
}
