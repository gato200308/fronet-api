<?php
$apiUrl = "https://carsmoviesinventoryproject-production.up.railway.app/api/v1/carsmovies";
$id = $_GET['id'] ?? null;
$movie = null;

if (!empty($id)) {
    $url = "$apiUrl/" . urlencode($id);
    $response = @file_get_contents($url);

    if ($response === false) {
        echo "❌ No se pudo obtener información del recurso con ID: $id.";
    } else {
        $movie = json_decode($response, true);
        // Aquí puedes usar $movie para llenar el formulario
    }
} else {
    echo "❗ ID no proporcionado o inválido.";
}

?>

<h2><?= $id ? "Editar Película" : "Agregar Película" ?></h2>
<form method="post" action="save.php">
    <input type="hidden" name="id" value="<?= $movie['id'] ?? '' ?>">
    <label>Nombre:</label><br>
    <input type="text" name="carMovieName" required value="<?= $movie['carMovieName'] ?? '' ?>"><br>
    <label>Año:</label><br>
    <input type="number" name="carMovieYear" required value="<?= $movie['carMovieYear'] ?? '' ?>"><br>
    <label>Duración (min):</label><br>
    <input type="number" name="duration" required value="<?= $movie['duration'] ?? '' ?>"><br><br>
    <button type="submit">Guardar</button>
    <a href="index.php">Cancelar</a>
</form>
