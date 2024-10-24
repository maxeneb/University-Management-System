<?php 

    $info = parse_ini_file('db.ini');
    //var_dump($info);

    try {
        $dbconnection = new PDO("mysql:host=" . $info['host'] . ";dbname=" . $info['dbname'] .  
                        ";port=" . $info['port'], $info['user'], $info['password']);
    } catch(PDOException $e) {
        echo $e->getMessage();
    }