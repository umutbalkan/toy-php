<?php

    $dbConn = 'testing-intro:europe-west3:test-sql';
    $dbUser = "root";
    $dbName= "test-data";
    $dbPass = "wheelock";

    try {
        $dsn = "mysql:unix_socket=/cloudsql/${dbConn};dbname=${dbName}";
        $connection =  new PDO($dsn, $dbUser, $dbPass);
        //$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Database connected successfully";
    } catch(PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
    }

?>
