<?php
session_start();
// Connection details for the first database (KMSCI)
define('DB_HOST_KMSCI', 'localhost');
define('DB_USER_KMSCI', 'root');
define('DB_PASSWORD_KMSCI', 'b0ykup4l');
define('DB_NAME_KMSCI', 'kmsci');
// Connection details for the second database (EPCB)
define('DB_HOST_EPCB', 'localhost');
define('DB_USER_EPCB', 'root');
define('DB_PASSWORD_EPCB', 'b0ykup4l');
define('DB_NAME_EPCB', 'epcb');
// Connection details for the third database (CF4)
define('DB_HOST_CF4', 'localhost');
define('DB_USER_CF4', 'root');
define('DB_PASSWORD_CF4', 'b0ykup4l');
define('DB_NAME_CF4', 'cf4');

try {
    // Establish connection to the first database (KMSCI)
    $dsn_kmsci = "mysql:host=" . DB_HOST_KMSCI . ";dbname=" . DB_NAME_KMSCI . ";charset=utf8mb4";
    $pdo_kmsci = new PDO($dsn_kmsci, DB_USER_KMSCI, DB_PASSWORD_KMSCI);
    $pdo_kmsci->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Establish connection to the second database (EPCB)
    $dsn_epcb = "mysql:host=" . DB_HOST_EPCB . ";dbname=" . DB_NAME_EPCB . ";charset=utf8mb4";
    $pdo_epcb = new PDO($dsn_epcb, DB_USER_EPCB, DB_PASSWORD_EPCB);
    $pdo_epcb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Establish connection to the third database (CF4)
    $dsn_cf4 = "mysql:host=" . DB_HOST_CF4 . ";dbname=" . DB_NAME_CF4 . ";charset=utf8mb4";
    $pdo_cf4 = new PDO($dsn_cf4, DB_USER_CF4, DB_PASSWORD_CF4);
    $pdo_cf4->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create indexes if they do not exist for each database
    createIndexIfNotExists($pdo_kmsci, "admission", "caseno", "idx_caseno_kmsci");
    createIndexIfNotExists($pdo_kmsci, "dischargedtable", "caseno", "idx_caseno_disctable");
    createIndexIfNotExists($pdo_kmsci, "tsekap_lib_symptoms", "SYMPTOMS_ID", "idx_symptoms_id");
    createIndexIfNotExists($pdo_kmsci, "productout", "productsubtype", "idx_productsubtype");
    createIndexIfNotExists($pdo_kmsci, "productout", "productdesc", "idx_productdesc");
    createIndexIfNotExists($pdo_kmsci, "admission", "ward", "idx_ward");
    createIndexIfNotExists($pdo_kmsci, "productout", "terminalname", "idx_terminalname");
    createIndexIfNotExists($pdo_kmsci, "productout", "datearray", "idx_datearray");
    createIndexIfNotExists($pdo_kmsci, "productout", "status", "idx_status");
    createIndexIfNotExists($pdo_kmsci, "productout", "status", "idx_status");
    createIndexIfNotExists($pdo_kmsci, "admission", "caseno", "idx_caseno");
    createIndexIfNotExists($pdo_kmsci, "productout", "invno", "idx_invno");
    createIndexIfNotExists($pdo_kmsci, "admission", "patientidno", "idx_patientidno");
    createIndexIfNotExists($pdo_kmsci, "patientprofile", "patientidno", "idx_patientprofile_patientidno");
    createIndexIfNotExists($pdo_kmsci, "admission", "status", "idx_status");

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
