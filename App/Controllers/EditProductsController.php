<?php

namespace App\Controllers;

use App\Entity\Product;
use App\Repository\ProductRepository;

class EditProductsController extends Controller
{
    public function __invoke(): void
    {
        $this->handle();
        parent::createView('EditProducts');
    }

    private function handle()
    {
        $productRepository = new ProductRepository();
        if (isset($_POST['updateProducts'])) {
            for ($i = 0; $i < count($_POST['productId']); $i++) {
                $updateProduct = new Product($_POST['productName'][$i], $_POST['productDescription'][$i], $_POST['productPrice'][$i],'', $_POST['productId'][$i]);
                $productRepository->update($updateProduct);
            }
        }
        if (isset($_POST['productDelete'])) {
            $productRepository->delete($_POST['productDelete']);
        }
    }
}