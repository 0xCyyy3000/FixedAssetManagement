<?php

$host = 'localhost';
$db_name = 'fixedasset';
$db_user = 'root';
$db_password = 

$connection = mysqli_connect($host, $db_user);
mysqli_select_db($connection, $db_name) or die(mysqli_error($connection));
mysqli_query($connection, 'SET CHARACTER SET utf8');
mysqli_query($connection, "SET NAMES 'utf8'");


switch ($_GET['action']) {
    case 'get':
        $query = mysqli_query($connection, "SELECT code FROM barcodes ORDER BY id DESC LIMIT 1");
        $count = mysqli_num_rows($query);
        if ($count) {
            $row = mysqli_fetch_assoc($query);
            print implode($row);
        } else print null;
        break;

    case 'put':
        $query = mysqli_query($connection, "INSERT INTO barcodes (code) VALUES ({$_GET['data']})");
        if ($query) {
            print json_encode(['Barcode has been sent!']);
        }
        break;

    case 'destroy':
        $query = mysqli_query($connection, "DELETE FROM barcodes WHERE code = {$_GET['data']}");
        if ($query)
            print 'Cleared!';
        break;
}
