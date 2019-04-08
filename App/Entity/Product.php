<?php

namespace App\Entity;

use App\Repository\AttributeValueRepository;

/**
 * Product Entity
 * @package App\Entity
 */
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
     * @param array $attributes
     * @param int $id
     */
    public function __construct(string $name, string $description, int $price, array $attributes = [], int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->attributes = $attributes;
    }

    /**
     * @param string $attributes
     * @return array
     */
    public static function attributesToArray($attributes = '')
    {
        $result = [];
        $attrValueRepository = new AttributeValueRepository;
        if ($attributes !== '') {
            $attrArray = explode(',', trim($attributes));
            foreach ($attrArray as $attr) {
                $result[] = $attrValueRepository->getAttributesValue('id', $attr);
            }
        }
        return $result;
    }

    /**
     * Function for get product's attributes
     * as string separated by commas.
     * @return string
     */
    public function getAttributesAsString()
    {
        $result = "";
        if (!empty($this->attributes) && count($this->attributes) > 1) {
            $attributesCount = count($this->attributes);
            for ($i = 0; $i < $attributesCount; $i++) {
                if ($i + 1 === $attributesCount) {
                    if(method_exists($this->attributes[$i], 'getId')) {
                        $result .= $this->attributes[$i]->getId();
                    }
                } else {
                    if(method_exists($this->attributes[$i], 'getId')) {
                        $result .= $this->attributes[$i]->getId() . ',';
                    }
                }
            }
        }
        return $result;
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
     * @return array
     */
    public function getAttributes(): array
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
