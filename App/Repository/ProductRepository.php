<?php

namespace App\Repository;

use App\Db\DataBase;
use App\Entity\Product;

class ProductRepository
{
    private $products;
    /**
     * @var \Envms\FluentPDO\Query
     */
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
     * @param $pageSize
     * @param $page
     * @param null $condition
     * @param null $parameters
     * @return array
     * @throws \Envms\FluentPDO\Exception
     */
    public function getProducts($page, $pageSize, $condition = null, $parameters = null)
    {
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

    public function getCount()
    {
        foreach ($this->db->from('products')->select(null)->select('COUNT(*)')->fetch() as $item) {
            return $item;
        }
        return 0;
    }

    /**
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
     * @param int $id
     * @return bool
     * @throws \Envms\FluentPDO\Exception
     */
    public function delete(int $id)
    {
        return $this->db->delete('products', $id)->execute();
    }
}
