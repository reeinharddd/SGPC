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
            WHERE UP.idUsuario = '" . $_SESSION['id'] . "' AND P.estado != 'FIN'
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
              T.idTarea AS idTarea,
              PT.fechaInicio,
              PT.fechaFinal
            FROM
              Proyecto AS P
              INNER JOIN UsuarioProyecto AS UP ON P.idProyecto = UP.idProyecto
              INNER JOIN UsuarioTarea AS UT ON UP.idUsuario = UT.idUsuario
              INNER JOIN Tarea AS T ON UT.idTarea = T.idTarea
              INNER JOIN ProyectoTarea AS PT ON P.idProyecto = PT.idProyecto AND T.idTarea = PT.idTarea
            WHERE
              UP.idUsuario = ?
              AND P.idProyecto = ?
              
            ORDER BY PT.fechaFinal DESC";

            $stmt = $con->prepare($query);
            $stmt->bind_param("ii", $usuario, $proyecto);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result === false) {
                die("Error en la ejecución de la consulta: " . $stmt->error);
            }
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
                  WHERE C.idTarea = ?
                  ORDER BY C.fechaComentario ASC";

            $stmt = $con->prepare($query);
            $stmt->bind_param("i", $idTarea);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $comentarios[] = $row;
                }
                unset($result, $row);
            } else {
                echo "No se encontraron comentarios.";
            }

            $stmt->close();
        }
        $conexion->close();
        return $comentarios;
    }


    public function getInfoProyecto($idProyecto)
    {
        $conexion = new conexion();
        $infoProyecto = null;

        if ($conexion->connect()) {
            $con = $conexion->getConexion();
            $query = "SELECT * FROM Proyecto WHERE idProyecto = ?";

            $stmt = $con->prepare($query);
            $stmt->bind_param("i", $idProyecto);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $infoProyecto = $result->fetch_assoc();
            } else {
            }

            $stmt->close();
        } else {
        }

        $conexion->close();
        return $infoProyecto;
    }






    public function obtenerPrimerasTareas($usuario, $proyecto, $cantidad)
    {
        $conexion = new conexion();
        $tareas = array();

        if ($conexion->connect()) {
            $con = $conexion->getConexion();

            $fechaActual = date('Y-m-d');

            $query = "SELECT T.titulo AS NombreTarea, T.descripcion AS DescripcionTarea, T.idTarea, PT.fechaFinal, T.estado
                  FROM Tarea T
                  INNER JOIN UsuarioTarea UT ON T.idTarea = UT.idTarea
                  INNER JOIN ProyectoTarea PT ON T.idTarea = PT.idTarea
                  WHERE UT.idUsuario = ? AND T.idProyecto = ? AND PT.idProyecto = ?
                  AND PT.fechaFinal BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)
                  ORDER BY PT.fechaFinal ASC LIMIT $cantidad";

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

            $stmt = $con->prepare($query);
            $stmt->bind_param("s", $codigoEstado);
            $stmt->execute();
            $stmt->bind_result($nombreEstado);
            if ($stmt === false) {
                die("Error en la preparación de la consulta: " . $con->error);
            }

            if ($stmt->fetch()) {
            } else {
                echo "No se encontró el estado.";
            }

            $stmt->close();
        }

        $conexion->close();

        return $nombreEstado;
    }
    public function getProyectoIdFromTarea($idTarea)
    {
        $conexion = new conexion();
        $idProyecto = null;

        if ($conexion->connect()) {
            $con = $conexion->getConexion();
            $query = "SELECT idProyecto FROM ProyectoTarea WHERE idTarea = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("i", $idTarea);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $row = $result->fetch_assoc()) {
                $idProyecto = $row['idProyecto'];
            }

            $stmt->close();
        }

        $conexion->close();
        return $idProyecto;
    }
    public function getProyectosTerminados()
    {
        $conexion = new conexion();
        $proyectos = array();
        if ($conexion->connect()) {
            $con = $conexion->getConexion();
            $sql = "SELECT P.idProyecto, P.nombre, P.descripcion, P.ubicacion, P.fechaInicio, P.fechaFinal, P.estado 
        FROM Proyecto P 
        INNER JOIN UsuarioProyecto UP ON P.idProyecto = UP.idProyecto
        WHERE UP.idUsuario = '" . $_SESSION['id'] . "' AND P.estado = 'FIN'
        ORDER BY P.fechaFinal DESC";
            $result = $conexion->exeqSelect($sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $proyectos[] = $row;
                }
                unset($result, $row);
            } else {
                echo "No se encontraron proyectos terminados.";
            }
        }
        $conexion->close();
        return $proyectos;
    }
    public function getUsuariosPorTipoYProyecto($idProyecto, $tipoUsuario)
    {
        $conexion = new conexion();
        $usuarios = array();

        if ($conexion->connect()) {
            $con = $conexion->getConexion();

            $query = "SELECT U.nombre, U.apellidoPat, U.apellidoMat, U.email
                  FROM Usuario U
                  JOIN UsuarioProyecto UP ON U.idUsuario = UP.idUsuario
                  WHERE UP.idProyecto = ? AND U.idTipoUsuario = ?
                  ORDER BY U.apellidoPat, U.apellidoMat, U.nombre";

            $stmt = $con->prepare($query);
            $stmt->bind_param("ii", $idProyecto, $tipoUsuario);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $usuarios[] = $row;
                }
                unset($result, $row);
            } else {
                echo "No se encontraron usuarios.";
            }

            $stmt->close();
        }

        $conexion->close();
        return $usuarios;
    }
    public function getTareaPorId($idTarea)
    {
        $conexion = new conexion();
        $tarea = null;

        if ($conexion->connect()) {
            $con = $conexion->getConexion();
            $query = "SELECT
                      T.titulo AS NombreTarea,
                      T.descripcion AS DescripcionTarea,
                      T.estado,
                      T.idTarea AS idTarea,
                      PT.fechaInicio,
                      PT.fechaFinal,
                      PT.idProyecto
                    FROM
                      Tarea AS T
                      INNER JOIN ProyectoTarea AS PT ON T.idTarea = PT.idTarea
                    WHERE
                      T.idTarea = ?";

            $stmt = $con->prepare($query);
            $stmt->bind_param("i", $idTarea);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $tarea = $result->fetch_assoc();
            } else {
                echo "No se encontró la tarea.";
            }

            $stmt->close();
        }

        $conexion->close();
        return $tarea;
    }
}
