<?php
    $conn = new PDO("pgsql:host=localhost;dbname=postgres", "postgres", "postgresql");
    function getAllData() {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM tienda.productos");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            echo getAllData();
            break;
        // case 'POST':
        //     addData();
        //     break;
        // case 'PUT':
        //     updateData();
        //     break;
        // case 'DELETE':
        //     deleteData();
        //     break;
    }
?>
