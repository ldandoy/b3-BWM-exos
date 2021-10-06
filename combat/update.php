<?php
if (isset($_GET['action'])) {
    switch($_GET['action']) {
        case 'augcc':
            $perso['cc'] ++;
            $perso['win'] ++;
            $sqlUpdate = "UPDATE perso SET cc = :cc, win = :win WHERE id = 1";
            $sth = $dbh->prepare($sqlUpdate);
            $sth->execute(array(
                ':cc' => $perso['cc'],
                ':win' => $perso['win']
            ));
            break;
        case 'augcd':
            $perso['cd'] ++;
            $perso['win'] ++;
            $sqlUpdate = "UPDATE perso SET cd = :cd, win = :win WHERE id = 1";
            $sth = $dbh->prepare($sqlUpdate);
            $sth->execute(array(
                ':cd' => $perso['cd'],
                ':win' => $perso['win']
            ));
            break;
        case 'augpdv':
            $perso['pdv'] ++;
            $perso['win'] ++;
            $sqlUpdate = "UPDATE perso SET pdv = :pdv, win = :win WHERE id = 1";
            $sth = $dbh->prepare($sqlUpdate);
            $sth->execute(array(
                ':pdv' => $perso['pdv'],
                ':win' => $perso['win']
            ));
            break;
    }
}