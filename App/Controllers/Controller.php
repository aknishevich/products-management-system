<?php

namespace App\Controllers;


class Controller
{
    public static function createView($viewName)
    {
        require_once ("App/Views/$viewName.php");
    }
}