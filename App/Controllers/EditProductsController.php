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
        /**
         * It is for use handle() and display errors in the right place in the template.
         * I just didn't have time to figure it out how to transfer data
         * to the template, so I used this shit solution.
         */
        $GLOBALS['handle'] = function () {
            $this->handle();
        };
        $this->createView('EditProducts');
    }

    private function handle()
    {
        /**
         * Edit products handler with validation
         */
        $productRepository = new ProductRepository();
        if (isset($_POST['updateProducts'])
            && isset($_POST['productId'])
            && isset($_POST['productName'])
            && isset($_POST['productDescription'])
            && isset($_POST['productPrice'])
        ) {
            $errors = [];
            for ($i = 0; $i < count($_POST['productId']); $i++) {
                if (isset($_POST['productId'][$i])
                    && isset($_POST['productName'][$i])
                    && isset($_POST['productDescription'][$i])
                    && isset($_POST['productPrice'][$i])
                ) {

                    $productId = $this->clean($_POST['productId'][$i]);
                    $productName = $this->clean($_POST['productName'][$i]);
                    $productDescription = $this->clean($_POST['productDescription'][$i]);
                    $productPrice = $this->clean($_POST['productPrice'][$i]);
                    $attributes = $this->clean($_POST['productAttributes'][$i]);
                    preg_match('/(\d+,{0,1}[ ]*)+/', $attributes, $matches);
                    try {
                        if ($productRepository->getProducts(null, null, 'id', $productId)) {

                        } else {
                            throw new Exception("Product is not exist!");
                        }
                        if (empty($productId)
                            || empty($productName)
                            || empty($productDescription)
                            || empty($productPrice)
                        ) {
                            throw new Exception("Not all required fields are filled");
                        }
                        if (!Validator::length(1, 3600)->validate($productName)
                            || !Validator::length(1, 1000)->validate($productDescription)
                        ) {
                            throw new Exception(
                                "Length too long. Should be no more then 3600 
                                        symbols for Name and 10000 for Description"
                            );
                        }

                        if (!Validator::numeric()->positive()->between(0, 99999999)
                            ->validate($productPrice)
                        ) {
                            throw new Exception(
                                "Incorrect Price field. 
                                            Should be positive number between 0 and 99999999"
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
                        $updateProduct = new Product(
                            $productName,
                            $productDescription,
                            $productPrice,
                            $productAttributes,
                            $productId
                        );
                        $productRepository->update($updateProduct);
                    } catch (Exception $e) {
                        $errors[] = $e;
                    }
                }
            }
            $errors = array_unique($errors);
            if (!empty($errors)) {
                echo "<div class='alert alert-danger mt-3'>";
                echo '<strong>Not all products have been updated. Some of them have the next errors:</strong><br>';
                foreach ($errors as $error) {
                    echo '- ' . $error->getMessage() . '<br>';
                }
                echo '</div>';
            } else {
                echo "<div class='alert alert-success mt-3'>All products was successfully updated.</div>";
            }
        }
        if (isset($_POST['productDelete'])) {
            try {
                $productRepository->delete($_POST['productDelete']);
            } catch (\Envms\FluentPDO\Exception $e) {
            }
        }
    }
}
