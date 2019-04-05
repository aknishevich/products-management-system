<?php


namespace App\Entity;


class Product
{
    private $id;
    private $name;
    private $description;
    private $price;
    private $attributes;

    /**
     * Product constructor.
     * @param string $name
     * @param string $description
     * @param int $price
     * @param string $attributes
     * @param int|null $id
     */
    public function __construct(string $name, string $description, int $price, string $attributes = '', int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->attributes = $attributes;
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
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getAttributes(): string
    {
        return $this->attributes;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


}