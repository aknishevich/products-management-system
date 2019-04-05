<?php
/**
 * Created by PhpStorm.
 * User: aknis
 * Date: 05.04.2019
 * Time: 22:21
 */

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