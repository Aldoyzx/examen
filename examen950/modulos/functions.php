<?php
function ObtenerLibros($conexion, $filtro = null) {
	$sql = "SELECT * FROM libros";
    if ($filtro) {
        $sql .= " WHERE titulo LIKE '%$filtro%'";
    }
    $resultado = mysqli_query($conexion, $sql);
    $libros =[];
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $libros[] = $fila;
    }

$resultado = $conexion->query($sql);

    
    if(!$resultado){
        return ['error' => 'Error en la consulta: ' . $conexion->error];
    }

    $libros = [];
    if($resultado->num_rows > 0){
        while($fila = $resultado->fetch_assoc()){
            $libros[] = $fila;
        }
    }
    return $libros;
}

function ObtenerLibroPorId($conexion, $id){
    $id = (int)$id;
    $sql = "SELECT * FROM libros WHERE id = $id";
    $resultado = $conexion->query($sql);
    
    if($resultado && $resultado->num_rows > 0){
        return $resultado->fetch_assoc();
    }
    return null;
}

function ObtenerCategorias($conexion){
    $sql = "SELECT DISTINCT categoria FROM libros ORDER BY categoria";
    $resultado = $conexion->query($sql);
    
    $categorias = [];
    if($resultado && $resultado->num_rows > 0){
        while($fila = $resultado->fetch_assoc()){
            $categorias[] = $fila['categoria'];
        }
    }
    return $categorias;
}

function ValidarConexion($conexion){
    if(!$conexion){
        return false;
    }
    return true;
}

function FormatearPrecio($precio){
    return number_format($precio, 2, '.', ',');

    return $libros;
}

function RegistrarUsuario($conexion, $nombre, $email, $password){
    $nombre = $conexion->real_escape_string($nombre);
    $email = $conexion->real_escape_string($email);
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    
    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$passwordHash')";
    return $conexion->query($sql);
}

function actualizarLibro($conexion, $id, $titulo, $autor, $categoria, $precio){
    $id = (int)$id;
    $titulo = $conexion->real_escape_string($titulo);
    $autor = $conexion->real_escape_string($autor);
    $categoria = $conexion->real_escape_string($categoria);
    $precio = (float)$precio;
    
    $sql = "UPDATE libros SET titulo='$titulo', autor='$autor', categoria='$categoria', precio=$precio WHERE id=$id";
    return $conexion->query($sql);
}

function eliminarLibro($conexion, $id){
    $id = (int)$id;
    $sql = "DELETE FROM libros WHERE id=$id";
    return $conexion->query($sql);
}
function agregarLibro($conexion, $titulo, $autor, $categoria, $precio){
    $titulo = $conexion->real_escape_string($titulo);
    $autor = $conexion->real_escape_string($autor);
    $categoria = $conexion->real_escape_string($categoria);
    $precio = (float)$precio;
    
    $sql = "INSERT INTO libros (titulo, autor, categoria, precio) VALUES ('$titulo', '$autor', '$categoria', $precio)";
    return $conexion->query($sql);
}
?>