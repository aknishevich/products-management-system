<?php

namespace App\Repository;

use App\Db\DataBase;
use App\Entity\AttributeValue;

/**
 * AttributeValueRepository class provides functionality to
 * AttributeValue Entity for working with a database
 * @package App\Repository
 */
class AttributeValueRepository
{
    private $db;
    private $attributesValue;

    public function __construct()
    {
        $this->db = DataBase::getDb();
    }

    /**
     * Function for getting Attributes Values by condition
     * @param null $condition
     * @param null $parameter
     * @return AttributeValue|array
     * @throws \Envms\FluentPDO\Exception
     */
    public function getAttributesValue($condition = null, $parameter = null)
    {
        $result = [];
        if ($condition !== null && $parameter !== null) {
            $this->attributesValue = $this->db
                ->from('attributes')
                ->select('*')
                ->innerJoin('attributes_values ON attributes.id = attributes_values.parent')
                ->where('attributes_values.' . $condition, $parameter);
        } else {
            $this->attributesValue = $this->db
                ->from('attributes')
                ->select('*')
                ->innerJoin('attributes_values ON attributes.id = attributes_values.parent');
        }
        foreach ($this->attributesValue as $value) {
            if ($condition === 'id') {
                return new AttributeValue($value['id'], $value['parent'], $value['name'], $value['value']);
            }
            $result[] = new AttributeValue($value['id'], $value['parent'], $value['name'], $value['value']);
        }
        return $result;
    }
}
