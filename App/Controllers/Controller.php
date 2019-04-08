<?php

namespace App\Controllers;

class Controller
{
    /**
     * View generating including templates
     * @param $viewName
     */
    public function createView($viewName)
    {
        require_once("App/Views/$viewName.php");
    }

    /**
     * Function to clear data coming from the form
     * @param string $value
     * @return string
     */
    public function clean($value = "")
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $value;
    }
}
