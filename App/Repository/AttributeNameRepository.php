<?php


namespace App\Repository;


use App\Db\DataBase;
use App\Entity\AttributeName;

class AttributeNameRepository
{
    private $db;
    private $attributesName;

    public function __construct()
    {
        $this->db = DataBase::getDb();
    }

    /**
     * @param null $condition
     * @param null $parameters
     * @return array
     * @throws \Envms\FluentPDO\Exception
     */
    public function getAttributesName($condition = null, $parameters = null): array
    {
        $result = [];
        if ($condition !== null && $parameters !== null) {
            $this->attributesName = $this->db->from('attributes')->select('*')->where($condition, $parameters);
        } else {
            $this->attributesName = $this->db->from('attributes')->select('*');
        }
        foreach ($this->attributesName as $name) {
            $result[] = new AttributeName($name['id'], $name['name']);
        }
        return $result;
    }
}