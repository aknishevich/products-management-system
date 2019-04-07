<?php

namespace App\Controllers;


class AttributesController extends Controller
{
    public function __invoke(): void
    {
        $this->createView('Attributes');
    }
}