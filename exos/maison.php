<?php

class Maison {
    private $nbPersonne = 0;

    function addpersonnes(int $nb):void {
        if (gettype($nb) == 'integer') {
            $this->nbPersonne += $nb;
        }
    }

    function getNbPersonnes():int {
        return $this->nbPersonne;
    }
}