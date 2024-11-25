<?php
include 'procesar.php';
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] :'';
$orden = isset($_GET['orden']) ? $_GET['orden'] : 'nombre_evento';
$direccion = isset($_GET['direccion']) ? $_GET['direccion'] : 'ASC';
$nuevaDireccion = ($direccion === 'ASC') ? 'DESC' : 'ASC';

$eventos = listarEventos($conn, $filtro, $orden, $direccion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Eventos Deportivos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>



<div class="container mt-5">

<form method="GET">

<input name="filtro" type='text' value="<?php echo $filtro  ?>" >
<button type="submit" class="btn btn-primary">Buscar</button>

</form>

<!-- EVENTOS DEPORTIVOS -->




<h2>Listado de Eventos</h2>

<table class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
            <th><a href="?orden=nombre_evento&direccion=<?php echo $nuevaDireccion; ?>">Nombre <?php echo ($orden === 'nombre_evento') ? ($direccion === 'ASC' ? '⬆️' : '⬇️') : ''; ?></a></th>
            <th><a href="?orden=tipo_deporte&direccion=<?php echo $nuevaDireccion; ?>">Tipo de Deporte <?php echo ($orden === 'tipo_deporte') ? ($direccion === 'ASC' ? '⬆️' : '⬇️') : ''; ?></a></th>
            <th><a href="?orden=fecha&direccion=<?php echo $nuevaDireccion; ?>">Fecha <?php echo ($orden === 'fecha') ? ($direccion === 'ASC' ? '⬆️' : '⬇️') : ''; ?></a></th>
            <th><a href="?orden=hora&direccion=<?php echo $nuevaDireccion; ?>">Hora <?php echo ($orden === 'hora') ? ($direccion === 'ASC' ? '⬆️' : '⬇️') : ''; ?></a></th>
            <th><a href="?orden=ubicacion&direccion=<?php echo $nuevaDireccion; ?>">Ubicación <?php echo ($orden === 'ubicacion') ? ($direccion === 'ASC' ? '⬆️' : '⬇️') : ''; ?></a></th>
            <th><a href="?orden=organizador&direccion=<?php echo $nuevaDireccion; ?>">Organizador <?php echo ($orden === 'organizador') ? ($direccion === 'ASC' ? '⬆️' : '⬇️') : ''; ?></a></th>
        </tr>
    </thead>
    <tbody>
    <?php
   
    while ($evento = $eventos->fetch_assoc()) {
        echo "<tr>
                <td>{$evento['nombre_evento']}</td>
                <td>{$evento['tipo_deporte']}</td>
                <td>{$evento['fecha']}</td>
                <td>{$evento['hora']}</td>
                <td>{$evento['ubicacion']}</td>
                <td>{$evento['organizador']}</td>
                <td>
                    <a href='formularioEvento.php?id={$evento['id']}' class='btn btn-warning btn-sm'>Editar</a>
                    <form action='procesar.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='accion' value='eliminarEvento'>
                        <input type='hidden' name='id' value='{$evento['id']}'>
                        <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este evento?\");'>Eliminar</button>
                    </form>
                </td>
            </tr>";
    }
    ?>
    </tbody>
</table>
<a href="formularioEvento.php" class="btn btn-primary">Añadir Evento</a>

<!-- ORGANIZADORES -->

<h2 class="mt-5">Listado de Organizadores</h2>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $organizadores = listarOrganizadores($conn);
    while ($organizador = $organizadores->fetch_assoc()) {
        echo "<tr>
                <td>{$organizador['nombre']}</td>
                <td>{$organizador['email']}</td>
                <td>{$organizador['telefono']}</td>
                <td>
                    <form action='procesar.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='accion' value='eliminarOrganizador'>
                        <input type='hidden' name='id' value='{$organizador['id']}'>
                        <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este organizador?\");'>Eliminar</button>
                    </form>
                </td>
            </tr>";
    }
    ?>
    </tbody>
</table>
<a href="formularioOrganizador.php" class="btn btn-primary">Añadir Organizador</a>

</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>