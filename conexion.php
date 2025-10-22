<?php
$host = "mysql-sadboyz.alwaysdata.net"; 
$database = "sadboyz_bd_colegio_allis"; 
$username = "sadboyz"; 
$password = "SPKDENJI27/_/"; 
//mysql -h mysql-sadboyz.alwaysdata.net -u sadboyz -p sadboyz_bd_colegio_allis
try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa";
} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>