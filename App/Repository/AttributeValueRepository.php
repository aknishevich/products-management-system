<?php


namespace App\Repository;


use App\Db\DataBase;
use App\Entity\AttributeValue;

class AttributeValueRepository
{
    private $db;
    private $attributesValue;

    public function __construct()
    {
        $this->db = DataBase::getDb();
    }

    public function getAttributesValue($attributeId = null)
    {
        $result = [];
        if ($attributeId !== null) {
            $this->attributesValue = $this->db->from('attributes')->select('*')->innerJoin('attributes_values ON attributes.id = attributes_values.parent')->where('attributes_values.id', $attributeId);
        } else {
            $this->attributesValue = $this->db->from('attributes')->select('*')->innerJoin('attributes_values ON attributes.id = attributes_values.parent');
        }
        foreach ($this->attributesValue as $value) {
            if($attributeId !== null) {
                return $result[] = new AttributeValue($value['id'], $value['parent'], $value['name'], $value['value']);
            }
            else {
                $result[] = new AttributeValue($value['id'], $value['parent'], $value['name'], $value['value']);
            }
        }
        return $result;
    }
}