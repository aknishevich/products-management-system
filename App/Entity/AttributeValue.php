<?php


namespace App\Entity;


class AttributeValue
{
    private $id;
    private $parentId;
    private $name;
    private $value;

    /**
     * AttributeValue constructor.
     * @param int $id
     * @param int $parentId
     * @param string $name
     * @param string $value
     */
    public function __construct(int $id, int $parentId, string $name, string $value)
    {
        $this->id = $id;
        $this->parentId = $parentId;
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getParentId(): int
    {
        return $this->parentId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}