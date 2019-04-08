<?php

namespace App\Repository;

use App\Db\DataBase;
use App\Entity\Product;

/**
 * ProductRepository class provides functionality to
 * Product Entity for working with a database
 * @package App\Repository
 */
class ProductRepository
{
    private $products;
    private $db;

    public function __construct()
    {
        $this->db = DataBase::getDb();
    }

    /**
     * @param Product $product
     * @return bool|int
     * @throws \Envms\FluentPDO\Exception
     */
    public function create(Product $product)
    {
        $values = array(
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'attributes' => $product->getAttributesAsString()
        );
        $query = $this->db->insertInto('products')->values($values);
        return $query->execute();
    }

    /**
     * Get products from database by page number & page size
     * (optional, for pagination) or by condition
     * (id, for example)
     * @param $pageSize
     * @param $page
     * @param null $condition
     * @param null $parameters
     * @return array
     * @throws \Envms\FluentPDO\Exception
     */
    public function getProducts($page, $pageSize, $condition = null, $parameters = null)
    {
        /**
         * Condition to determine if pagination is necessary
         */
        if ($condition === 'id' && $parameters !== null) {
            $this->products = $this->db
                ->from('products')
                ->select('*')
                ->where($condition, $parameters);
        } elseif ($condition !== null && $parameters !== null) {
            $this->products = $this->db
                ->from('products')
                ->select('*')
                ->where($condition, $parameters)
                ->limit($pageSize)
                ->offset(($page - 1) * $pageSize);
        } else {
            $this->products = $this->db
                ->from('products')
                ->select('*')
                ->limit($pageSize)
                ->offset(($page - 1) * $pageSize);
        }
        $productsList = [];
        foreach ($this->products as $product) {
            $attributes = Product::attributesToArray($product['attributes']);
            $productsList[] = new Product(
                $product['name'],
                $product['description'],
                $product['price'],
                $attributes,
                $product['id']
            );
        }
        return $productsList;
    }

    /**
     * Get count of products (for pagination)
     * @return int
     * @throws \Envms\FluentPDO\Exception
     */
    public function getCount()
    {
        foreach ($this->db->from('products')->select(null)->select('COUNT(*)')->fetch() as $item) {
            return $item;
        }
        return 0;
    }

    /**
     * Update product in database
     * @param Product $product
     * @return bool|int|\PDOStatement
     * @throws \Envms\FluentPDO\Exception
     */
    public function update(Product $product)
    {
        $values = array(
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'attributes' => $product->getAttributesAsString()
        );
        return $this->db->update('products')->set($values)->where('id', $product->getId())->execute();
    }

    /**
     * Delete product from database
     * @param int $id
     * @return bool
     * @throws \Envms\FluentPDO\Exception
     */
    public function delete(int $id)
    {
        return $this->db->delete('products', $id)->execute();
    }
}
