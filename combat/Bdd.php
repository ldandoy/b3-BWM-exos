<?php

class Bdd {
    private $dbh = null;
    private $sth = null;
    
    function __construct() {
        $user = "root";
        $pass = "root";

        try {
            $this->dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
        } catch (PDOException $e) {
            echo 'Erreur !: ' . $e->getMessage() . '<br/>';
            die();
        }
    }

    public function fetch($sql, $data = null) {
        $this->exec($sql, $data);
        return $this->sth->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll($sql, $data = null) {
        $this->exec($sql, $data);
        return $this->sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function exec($sql, $data = null) {
        $this->sth = $this->dbh->prepare($sql);
        return $this->sth->execute($data);
    }

}