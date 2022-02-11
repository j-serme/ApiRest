<?php

namespace Controllers;

class Plat extends AbstractController
{

    protected $defaultModelName = \Models\Plat::class;

    public function suppr() {

        $request = $this->delete("json", ['id' => 'number']);

        if (!$request) { return $this->json("Requete non conforme, réessayez", "delete");}


        $plat= $this->defaultModel->findById($request['id']);

        if (!$plat) { return $this->json("Aucun restaurant trouvé dans la BDD", "delete");}

        $this->defaultModel->remove($plat);

        return $this->json("Le restaurant a bien été supprimé");


    }

}