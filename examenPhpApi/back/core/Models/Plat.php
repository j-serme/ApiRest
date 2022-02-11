<?php

namespace Models;


class Plat extends AbstractModel implements \JsonSerializable
{

    protected string $nomDeLaTable = "plats";

    private $id;
    private $description;
    private $price;
    private $restaurant_id;




    /**
 * @return mixed
 */public function getId()
{
    return $this->id;
}/**
 * @return mixed
 */public function getDescription()
{
    return $this->description;
}/**
 * @param mixed $description
 */public function setDescription($description): void
{
    $this->description = $description;
}/**
 * @return mixed
 */public function getPrice()
{
    return $this->price;
}/**
 * @param mixed $price
 */public function setPrice($price): void
{
    $this->price = $price;
}/**
 * @return mixed
 */public function getRestaurantId()
{
    return $this->restaurant_id;
}/**
 * @param mixed $restaurant_id
 */public function setRestaurantId($restaurant_id): void
{
    $this->restaurant_id = $restaurant_id;
}



/**
 * @inheritDoc
 */
    public function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "description" => $this->description,
            "price" => $this->price,
            "restaurant_id" => $this->restaurant_id
        ];
    }

    public function findAllByRestaurant(Restaurant $restaurant)
    {
        $sql = $this->pdo->prepare("SELECT * FROM {$this->nomDeLaTable}
            WHERE restaurant_id = :restaurant_id
        ");

        $sql->execute([
            "restaurant_id" => $restaurant->getId()
        ]);

        $plats = $sql->fetchAll(\PDO::FETCH_CLASS, get_class($this));

        return $plats;

    }


}