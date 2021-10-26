<?php

require_once('./config/database.php');

class Bdd {
    private $link = null;
    private $sth = null;

    function __construct() {
        try {
            $this->link = new PDO('mysql:host='.BDD_HOST.';dbname='.BDD_BDD, 
            BDD_USER, BDD_PASSWORD);
        } catch (PDOException $e) {
            echo 'Erreur !: ' . $e->getMessage() . '<br/>';
            die();
        }
    }

    function fetch ($sql, $data=null) {
        $this->execute($sql, $data);
        return $this->sth->fetch(PDO::FETCH_ASSOC);
    }

    function fetchAll ($sql, $data=null) {
        $this->execute($sql, $data);
        return $this->sth->fetchAll(PDO::FETCH_ASSOC);
    }

    function execute ($sql, $data=null) {
        $this->sth = $this->link->prepare($sql);
        return $this->sth->execute($data);
    }
}

?>