<?php
$apiUrl = "https://carsmoviesinventoryproject-production.up.railway.app/api/v1/carsmovies";
$page = isset($_GET['page']) ? intval($_GET['page']) : 0;
$size = 5;

// Leer datos
$response = file_get_contents("$apiUrl?page=$page&size=$size&sort=carMovieYear,desc");
$data = json_decode($response, true);
$movies = $data["Movies"];
$totalPages = $data["TotalPages"];
?>

<h2>Películas de Autos</h2>
<a href="form.php">Agregar Nueva Película</a>
<table border="1" cellpadding="5">
    <tr>
        <th>Nombre</th>
        <th>Año</th>
        <th>Duración</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($movies as $movie): ?>
    <tr>
        <td><?= htmlspecialchars($movie['carMovieName']) ?></td>
        <td><?= htmlspecialchars($movie['carMovieYear']) ?></td>
        <td><?= htmlspecialchars($movie['duration']) ?> min</td>
        <td>
            <a href="form.php?id=<?= $movie['id'] ?>">Editar</a> |
            <a href="delete.php?id=<?= $movie['id'] ?>" onclick="return confirm('¿Seguro que quieres eliminar esta película?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<!-- Navegación -->
<div>
    <?php if ($page > 0): ?>
        <a href="?page=<?= $page - 1 ?>">Anterior</a>
    <?php endif; ?>
    Página <?= $page + 1 ?> de <?= $totalPages ?>
    <?php if ($page < $totalPages - 1): ?>
        <a href="?page=<?= $page + 1 ?>">Siguiente</a>
    <?php endif; ?>
</div>
