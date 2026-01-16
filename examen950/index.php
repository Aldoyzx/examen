<?php
require 'config/db.php';
require 'modulos/functions.php';

if (!ValidarConexion($conexion)) {
    die("Error de conexión a la base de datos");
}

$filtro = null;
if (isset($_GET['buscar']) && !empty($_GET['buscar'])) {
    $filtro = $_GET['buscar'];
}

$libros = ObtenerLibros($conexion, $filtro);
$categorias = ObtenerCategorias($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f2f2f2; }
        form { margin-bottom: 20px; }
    </style>
</head>
<body>

<h1>📚 Biblioteca</h1>

<form method="GET">
    <input type="text" name="buscar" placeholder="Buscar por título"
           value="<?php echo htmlspecialchars($filtro ?? ''); ?>">
    <button type="submit">Buscar</button>
</form>

<h3>Categorías</h3>
<ul>
    <?php foreach ($categorias as $cat): ?>
        <li><?php echo htmlspecialchars($cat); ?></li>
    <?php endforeach; ?>
</ul>

<!-- LISTADO DE LIBROS -->
<h3>Listado de libros</h3>

<?php if (isset($libros['error'])): ?>
    <p style="color:red;"><?php echo $libros['error']; ?></p>

<?php elseif (count($libros) === 0): ?>
    <p>No hay libros registrados.</p>

<?php else: ?>
<table>
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Categoría</th>
        <th>Precio</th>
    </tr>

    <?php foreach ($libros as $libro): ?>
        <tr>
            <td><?php echo $libro['id_libro']; ?></td>
            <td><?php echo htmlspecialchars($libro['titulo']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>

</body>
</html>
