<?php

namespace App\Controllers;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Exception;
use Respect\Validation\Validator;


class AddProductController extends Controller
{
    public function __invoke(): void
    {
        $GLOBALS['handle'] = function () {
            $this->handle();
        };
        $this->createView('AddProduct');
    }

    public function handle()
    {
        if (isset($_POST['productAdd']) && isset($_POST['productName']) && isset($_POST['productDescription']) && isset($_POST['productPrice'])) {
            $productName = $this->clean($_POST['productName']);
            $productDescription = $this->clean($_POST['productDescription']);
            $productPrice = $this->clean($_POST['productPrice']);
            $productAttributes = Product::attributesToArray($this->clean($_POST['productAttributes']));
            try {
                if (!empty($productName) && !empty($productDescription) && !empty($productPrice)) {
                    if (Validator::length(1,3600)->validate($productName) && Validator::length(1,1000)->validate($productDescription)) {
                        if (Validator::numeric()->positive()->between(0,99999999)->validate($productPrice)) {
                            $productRepository = new ProductRepository();
                            $insertProduct = new Product($productName, $productDescription, $productPrice, $productAttributes);
                            $productRepository->create($insertProduct);
                            unset($_POST);
                            echo "<div class='p-3 mt-2 bg-success text-white'>Product successfully added.</div>";
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
            catch (Exception $e) {
                echo "<div class='p-3 mt-2 bg-danger text-white'>" . $e->getMessage() . "</div>";
            }
        }
    }
}