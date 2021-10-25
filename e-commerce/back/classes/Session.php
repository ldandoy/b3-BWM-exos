<?php

class Session {
    function __construct() {
        session_start();
    }

    function set($key, $data) {
        $_SESSION[$key] = $data;
    }

    function get($key) {
        return $_SESSION[$key];
    }
}

?>