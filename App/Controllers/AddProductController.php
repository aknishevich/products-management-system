<?php

namespace App\Controllers;

use App\Entity\Product;
use App\Repository\ProductRepository;


class AddProductController extends Controller
{
    public function __invoke(): void
    {
        $this->handle();
        parent::createView('AddProduct');
    }
    private function handle()
    {
        if (isset($_POST['productAdd']))
        {
            $productRepository = new ProductRepository();
            $insertProduct = new Product($_POST['productName'], $_POST['productDescription'], $_POST['productPrice']);
            $productRepository->create($insertProduct);
        }
    }
}