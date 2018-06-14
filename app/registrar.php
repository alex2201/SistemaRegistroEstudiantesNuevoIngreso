<?php
/**
 * Created by PhpStorm.
 * User: alexander
 * Date: 9/05/18
 * Time: 06:57 PM
 */

header("Content-Type: text/html;charset=utf-8");
require "./database_connector.php";
require "collect_form_data.php";
require "./create_pdf.php";

// Check if there's the user already registered.

$registered = "select count(*) from alumno where referencia=$ref";

$result = $conn->query($registered);

if ($result->num_rows > 0) {
    $row = $result->fetch_array();

    if ($row[0] > 0) {
        exit("Ya has realizado tu registro.");
    }
}

// Save photo file.

$path = "../users_data/" . $ref . "/";

if (!file_exists($path)) {
    mkdir($path, 0777, true);
}

$info = pathinfo($_FILES['photo']['name']);
$ext = $info['extension']; // get the extension of the file
$file_name = "picture." . $ext;
$target = $path . $file_name;

$OK = move_uploaded_file($_FILES['photo']['tmp_name'], $target);

$resp = "";

if ($OK) {

    //  Create pdf.

    $pdf_path = createPDF($target);

    // SQL query.

    $sql = "insert into alumno values(
    $ref,
    \"$first_name\",
    \"$last_name\",
    \"$second_last_name\",
    \"$birthday\",
    $born_state,
    $gender,
    \"$CURP\",
    \"$street\",
    \"$address_number\",
    $CP,
    \"$colony\",
    \"$town\",
    \"$state\",
    \"$phone\",
    \"$cellphone\",
    \"$email\",
    \"$previous_school\",
    $average,
    $option,
    \"$target\",
    null
)";

    if ($conn->query($sql) === TRUE) {
        $resp = "Registro completo.\n\nSe ha enviado un pdf a tu correo electronico con la información para presentar tu examen diagnóstico.\n\nTambién puedes consultar la información de tu examen diagnóstico en la sección de consulta.";
    } else {
        echo "Error: " . $conn->error;
        unlink($target);
        rmdir($path);
    }
} else {
    $resp = "Ocurrió un error guardando el archivo.";
}

$conn->close();

echo $resp;
