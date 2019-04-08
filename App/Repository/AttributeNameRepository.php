<?php

namespace App\Repository;

use App\Db\DataBase;
use App\Entity\AttributeName;

/**
 * AttributeNameRepository class provides functionality to
 * AttributeName Entity for working with a database
 * @package App\Repository
 */
class AttributeNameRepository
{
    private $db;
    private $attributesName;

    public function __construct()
    {
        $this->db = DataBase::getDb();
    }

    /**
     * Function for getting Attribute Names by condition
     * @param null $condition
     * @param null $parameters
     * @return array
     * @throws \Envms\FluentPDO\Exception
     */
    public function getAttributesName($condition = null, $parameters = null): array
    {
        $result = [];
        if ($condition !== null && $parameters !== null) {
            $this->attributesName = $this->db
                ->from('attributes')
                ->select('*')
                ->where($condition, $parameters);
        } else {
            $this->attributesName = $this->db
                ->from('attributes')
                ->select('*');
        }
        foreach ($this->attributesName as $name) {
            $result[] = new AttributeName($name['id'], $name['name']);
        }
        return $result;
    }
}
