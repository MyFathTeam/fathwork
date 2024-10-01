<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_prototype";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data dari Arduino (DHT11 dan Soil Moisture)
$humidity = isset($_GET['humidity']) ? $_GET['humidity'] : null;
$temperature = isset($_GET['temperature']) ? $_GET['temperature'] : null;
$soil_moisture = isset($_GET['soil_moisture']) ? $_GET['soil_moisture'] : null;

// Menyimpan data ke database
$sql = "INSERT INTO sensor_data (humidity, temperature, soil_moisture) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

// Bind parameter
$stmt->bind_param("sss", $humidity, $temperature, $soil_moisture);

// Eksekusi query
if ($stmt->execute()) {
    echo "Data berhasil disimpan ke database";
} else {
    echo "Error: " . $stmt->error;
}

// Menutup statement
$stmt->close();

// Menutup koneksi
$conn->close();
?>
