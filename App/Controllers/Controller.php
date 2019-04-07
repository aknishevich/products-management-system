<?php

namespace App\Controllers;


class Controller
{
    public function createView($viewName)
    {
        require_once ("App/Views/$viewName.php");
    }

    public function clean($value = "") {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $value;
    }
}