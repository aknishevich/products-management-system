<?php

namespace App\Repository;

use App\Db\DataBase;
use App\Entity\Entity;
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
        $values = array ('name' => $product->getName(), 'description' => $product->getDescription(), 'price' => $product->getPrice(), 'attributes' => $product->getAttributes());
        $query = $this->db->insertInto('products')->values($values);
        return $query->execute();
    }

    /**
     * @param null $condition
     * @param null $parameters
     * @return array
     * @throws \Envms\FluentPDO\Exception
     */
    public function getProducts($condition = null, $parameters = null)
    {
        $this->find($condition, $parameters);
        $productsList = [];
        foreach ($this->products as $product) {
            $productsList[] = new Product($product['name'], $product['description'], $product['price'], '', $product['id']);
        }
        return $productsList;
    }

    /**
     * @param null $condition
     * @param null $parameters
     * @throws \Envms\FluentPDO\Exception
     */
    private function find($condition = null, $parameters = null)
    {
        if ($condition !== null && $parameters !== null) {
            $result = $this->db->from('products')->select('*')->where($condition, $parameters);
        } else {
            $result = $this->db->from('products')->select('*');
        }
        $this->products = $result;
    }

    /**
     * @param Product $product
     * @return bool|int|\PDOStatement
     * @throws \Envms\FluentPDO\Exception
     */
    public function update(Product $product)
    {
        $values = array('name' => $product->getName(), 'description' => $product->getDescription(), 'price' => $product->getPrice(), 'attributes' => $product->getAttributes());
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