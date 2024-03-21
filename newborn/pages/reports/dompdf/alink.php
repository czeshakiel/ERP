<?php
session_start();
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'b0ykup4l');
define('DB_NAME', 'kmsci');
try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME."; charset=utf8mb4";
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    createIndexIfNotExists($pdo, "productout", "productdesc", "idx_productdesc");
    createIndexIfNotExists($pdo, "productout", "productsubtype", "idx_productsubtype");
    createIndexIfNotExists($pdo, "admission", "ward", "idx_ward");
    createIndexIfNotExists($pdo, "productout", "terminalname", "idx_terminalname");
    createIndexIfNotExists($pdo, "productout", "datearray", "idx_datearray");
    createIndexIfNotExists($pdo, "productout", "status", "idx_status");
    createIndexIfNotExists($pdo, "productout", "status", "idx_status");
    createIndexIfNotExists($pdo, "admission", "caseno", "idx_caseno");
    createIndexIfNotExists($pdo, "productout", "invno", "idx_invno");
    createIndexIfNotExists($pdo, "admission", "patientidno", "idx_patientidno");
    createIndexIfNotExists($pdo, "patientprofile", "patientidno", "idx_patientprofile_patientidno");
    createIndexIfNotExists($pdo, "admission", "status", "idx_status");
} catch (PDOException $e) {
    die("Unable to connect to the database: " . $e->getMessage());
}

function createIndexIfNotExists($pdo, $table, $columns, $indexName) {
    $query = "SHOW INDEX FROM $table WHERE Key_name = :indexName";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':indexName' => $indexName]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$result || $result['Column_name'] !== $columns) {
        $createIndexQuery = "CREATE INDEX $indexName ON $table ($columns)";
        $pdo->query($createIndexQuery);
    }
}
?>