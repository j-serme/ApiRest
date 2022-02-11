<?php

namespace Controllers;

class Restaurant extends AbstractController
{
    protected $defaultModelName = \Models\Restaurant::class;


    /**
     * fonction pour afficher l'ensemble des restaurants
     *
     *
     */

    public function index() {

        return $this->json($this->defaultModel->findAll());
    }

    /**
     * fonction pour créer un restaurant
     *
     * @return void
     *
     *
     *
     */

    public function new() {

        $request = $this->post("json", ["nom"=>"text",
            "adresse" => "text",
            "ville" => "text"]);

        if (!$request) { return $this->json("Requete non conforme");}

        $restaurant = new \Models\Restaurant();
        $restaurant->setNom($request['nom']);
        $restaurant->setAdresse($request['adresse']);
        $restaurant->setVille($request['ville']);

        $this->defaultModel->save($restaurant);

        return $this->json("Restaurant bien ajouté dans la BDD");
    }

    /***
     * fonction pour supprimer un restaurant
     *
     *
     * @return void
     */
    public function suppr() {

        $request = $this->delete("json", ['id' => 'number']);

        if (!$request) { return $this->json("Requete non conforme, réessayez", "delete");}


        $restaurant = $this->defaultModel->findById($request['id']);

        if (!$restaurant) { return $this->json("Aucun restaurant trouvé dans la BDD", "delete");}

        $this->defaultModel->remove($restaurant);

        return $this->json("Le restaurant a bien été supprimé");
    }

}