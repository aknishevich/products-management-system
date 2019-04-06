<?php

namespace App\Controllers;


class ProductController extends Controller
{
    public function __invoke(): void
    {
        $this->handle();
        parent::createView('Product');
    }

    private function handle()
    {
    }
}