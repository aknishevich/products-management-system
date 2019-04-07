<?php

namespace App\Controllers;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Exception;
use Respect\Validation\Validator;

class EditProductsController extends Controller
{
    public function __invoke(): void
    {
        $GLOBALS['handle'] = function () {
            $this->handle();
        };
        $this->createView('EditProducts');
    }

    private function handle()
    {
        $productRepository = new ProductRepository();
        if (isset($_POST['updateProducts'])&& isset($_POST['productId']) && isset($_POST['productName']) && isset($_POST['productDescription']) && isset($_POST['productPrice'])) {
            $errors = [];
            for ($i = 0; $i < count($_POST['productId']); $i++) {
                if (isset($_POST['productId'][$i]) && isset($_POST['productName'][$i]) && isset($_POST['productDescription'][$i]) && isset($_POST['productPrice'][$i])) {
                    $productId = $this->clean($_POST['productId'][$i]);
                    $productName = $this->clean($_POST['productName'][$i]);
                    $productDescription = $this->clean($_POST['productDescription'][$i]);
                    $productPrice = $this->clean($_POST['productPrice'][$i]);
                    $productAttributes = Product::attributesToArray($this->clean($_POST['productAttributes'][$i]));
                    try {
                        if ($productRepository->getProducts('id', $productId)) {
                            if (!empty($productId) && !empty($productName) && !empty($productDescription) && !empty($productPrice)) {
                                if (Validator::length(1,3600)->validate($productName) && Validator::length(1,1000)->validate($productDescription)) {
                                    if (Validator::numeric()->positive()->between(0,99999999)->validate($productPrice)) {
                                        $updateProduct = new Product($productName, $productDescription, $productPrice, $productAttributes, $productId);
                                        $productRepository->update($updateProduct);
                                    }
                                    else {
                                        throw new Exception("Incorrect Price field. Should be positive number between 0 and 99999999");
                                    }
                                }
                                else {
                                    throw new Exception("Length too long. Should be no more then 3600 symbols for Name and 10000 for Description");
                                }
                            }
                            else {
                                throw new Exception("Not all required fields are filled");
                            }
                        }
                        else {
                            throw new Exception("Product is not exist!");
                        }
                    }
                    catch (Exception $e) {
                        $errors[] = $e;
                    }
                }
            }
            $errors = array_unique($errors);
            if (!empty($errors)) {
                echo "<div class='p-3 mt-2 bg-danger text-white'>";
                echo '<strong>Not all products have been updated. Some of them have the next errors:</strong><br>';
                foreach ($errors as $error) {
                    echo '- ' . $error->getMessage() . '<br>';
                }
                echo '</div>';
            }
            else {
                echo "<div class='p-3 mt-2 bg-success text-white'>All products was successfully updated.</div>";
            }
        }
        if (isset($_POST['productDelete'])) {
            $productRepository->delete($_POST['productDelete']);
        }
    }
}