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
        /**
         * It is for use handle() and display errors in the right place in the template.
         * I just didn't have time to figure it out how to transfer data
         * to the template, so I used this shit solution.
         */
        $GLOBALS['handle'] = function () {
            $this->handle();
        };
        $this->createView('AddProduct');
    }

    public function handle()
    {
        /**
         * Add product handler with Validation
         */
        if (isset($_POST['productAdd'])
            && isset($_POST['productName'])
            && isset($_POST['productDescription'])
            && isset($_POST['productPrice'])
        ) {

            $productName = $this->clean($_POST['productName']);
            $productDescription = $this->clean($_POST['productDescription']);
            $productPrice = $this->clean($_POST['productPrice']);
            $attributes = $this->clean($_POST['productAttributes']);
            preg_match('/(\d+,{0,1}[ ]*)+/', $attributes, $matches);
            try {

                if (empty($productName) || empty($productDescription) || empty($productPrice)) {
                    throw new Exception("Not all required fields are filled");
                }
                if (!Validator::length(1, 3600)->validate($productName)
                    || !Validator::length(1, 1000)->validate($productDescription)
                ) {
                    throw new Exception(
                        "Length too long. Should be no more then 3600 symbols for 
                            Name and 10000 for Description"
                    );

                }
                if (!Validator::numeric()->positive()->between(0, 99999999)->validate($productPrice)) {
                    throw new Exception(
                        "Incorrect Price field. Should be positive number between 0 and 99999999"
                    );
                }
                if ((!empty($attributes) && !isset($matches[0]))
                    || (!empty($attributes) && ($matches[0] !== $attributes))
                ) {
                    throw new Exception(
                        "Incorrect Attributes field. Separate values with commas."
                    );
                }
                $productAttributes = Product::attributesToArray($attributes);
                $productRepository = new ProductRepository();
                $insertProduct = new Product(
                    $productName,
                    $productDescription,
                    $productPrice,
                    $productAttributes
                );
                $productRepository->create($insertProduct);
                unset($_POST);
                echo "<div class='alert alert-success'>Product successfully added.</div>";

            } catch (Exception $e) {
                echo "<div class='alert alert-danger'>" . $e->getMessage() . "</div>";
            }
        }
    }
}
