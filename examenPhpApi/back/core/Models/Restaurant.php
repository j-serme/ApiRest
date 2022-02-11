<?php

namespace Models;


class Restaurant extends AbstractModel implements \JsonSerializable
{

    protected string $nomDeLaTable = "restaurants";

    private $id;
    private $nom;
    private $adresse;
    private $ville;
    private $plats;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse): void
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville): void
    {
        $this->ville = $ville;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "nom" => $this->nom,
            "adresse" => $this->adresse,
            "ville" => $this->ville,
            "plats" => $this->getPlats()
        ];
    }

    public function save(Restaurant $restaurant) {

        $sql = $this->pdo->prepare("INSERT INTO {$this->nomDeLaTable}(nom, adresse, ville) VALUES (:nom, :adresse, :ville)");

        $sql->execute([
            "nom" => $restaurant->nom,
            "adresse" => $restaurant->adresse,
            "ville" => $restaurant->ville
        ]);
    }

    public function getPlats(){

        $modelPlat = new \Models\Plat();
        return $modelPlat->findAllByRestaurant($this);
    }

}