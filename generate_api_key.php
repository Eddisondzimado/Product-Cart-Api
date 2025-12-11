<?php
require_once("db.php");

function generateApiKey() {
    return bin2hex(random_bytes(32));
}

$apiKey = generateApiKey();

$sql = "INSERT INTO api_keys (api_key) VALUES ('$apiKey')";

if (mysqli_query($con, $sql)) {
    echo "New API Key: " . $apiKey;
} else {
    echo "Error storing API key: " . mysqli_error($con);
}

mysqli_close($con);
?>
