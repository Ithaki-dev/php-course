<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $uploads_dir = 'uploads/';
        $tmp_name = $_FILES['archivo']['tmp_name'];
        $name = basename($_FILES['archivo']['name']);
        if (move_uploaded_file($tmp_name, $uploads_dir . $name)) {
            echo "El archivo se ha subido correctamente.";
        } else {
            echo "Error al mover el archivo.";
        }
    } else {
        echo "No se ha subido ningún archivo o ha ocurrido un error.";
    }
}