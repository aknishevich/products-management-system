<?php


namespace App\Entity;


use App\Repository\AttributeValueRepository;

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
     * @param int|null $id
     */
    public function __construct(string $name, string $description, int $price, array $attributes = [], int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->attributes = $attributes;
    }

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

    public function getAttributesAsString()
    {
        $result = "";
        if (!empty($this->attributes) && count($this->attributes) > 1) {
            $attributesCount = count($this->attributes);
            for ($i = 0; $i < $attributesCount; $i++) {
                if ($i + 1 === $attributesCount) {
                    $result .= $this->attributes[$i]->getId();
                } else {
                    $result .= $this->attributes[$i]->getId() . ',';
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