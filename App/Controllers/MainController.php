<?php

namespace App\Controllers;

class MainController extends Controller
{
    public function __invoke(): void
    {
        $this->createView('Main');
    }
}
