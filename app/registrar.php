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

// Save photo file.

$path = "../users_data/".$ref."/";

if (!file_exists($path)) {
    mkdir($path, 0777, true);
}

$info = pathinfo($_FILES['photo']['name']);
$ext = $info['extension']; // get the extension of the file
$file_name = "picture." . $ext;
$target = $path.$file_name;

$OK = move_uploaded_file($_FILES['photo']['tmp_name'], $target);

$sql = "insert into alumno values(
    $ref,
    \"$first_name\",
    \"$last_name\",
    \"$second_last_name\",
    \"2017-04-22\",
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
    \"$target\"
)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully: ".$OK;
} else {
    echo "Error: " . $conn->error;
    unlink($target);
    rmdir($path);
}

$conn->close();
//$row = $result->fetch_array();

echo $first_name." ".$last_name;

//echo "<p> $ref</p>";
//echo "\n";
//echo "<p> $first_name</p>";
//echo "\n";
//echo "<p> $last_name</p>";
//echo "\n";
//echo "<p> $second_last_name</p>";
//echo "\n";
//echo "<p> $birthday</p>";
//echo "\n";
//echo "<p> $born_state</p>";
//echo "\n";
//echo "<p>sexo: $gender</p>";
//echo "\n";
//echo "<p> $CURP</p>";
//echo "\n";
//echo "<p> $street</p>";
//echo "\n";
//echo "<p> $address_number</p>";
//echo "\n";
//echo "<p> $CP</p>";
//echo "\n";
//echo "<p> $colony</p>";
//echo "\n";
//echo "<p> $town</p>";
//echo "\n";
//echo "<p> $state</p>";
//echo "\n";
//echo "<p> $phone</p>";
//echo "\n";
//echo "<p> $cellphone</p>";
//echo "\n";
//echo "<p> $email</p>";
//echo "\n";
//echo "<p> $previous_school</p>";
//echo "\n";
//echo "<p> $average</p>";
//echo "\n";
//echo "<p> $option</p>";
//echo "\n";
//echo "<p> $photo</p>";
