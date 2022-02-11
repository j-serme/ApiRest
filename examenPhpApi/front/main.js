let contenu = document.querySelector(".contenu");
const nomRestaurant = document.querySelector("#nom");
const villeRestaurant = document.querySelector("#ville");
const adresseRestaurant = document.querySelector("#adresse");



const boutonEnvoyer = document.querySelector("#envoyer");

boutonEnvoyer.addEventListener("click", () =>{

    ajouterRestaurant(nomRestaurant.value, adresseRestaurant.value, villeRestaurant.value)

})

function displayAll() {

    let url = "http://localhost/examenPhpApi/?type=restaurant&action=index"

fetch(url)
    .then(reponse => reponse.json())
    .then(restaurants => {


        console.log(restaurants)

        contenu.innerHTML = "";

        restaurants.forEach(restaurant => {

            templateRestaurant =`

            
            <div class="">
            <hr> 
            <hr>
                <h2><strong>${restaurant.nom}</strong></2>
                <h2>${restaurant.adresse}</2>
                <h2>${restaurant.ville}</2>
                <button id=${restaurant.id} class="btn btn-danger boutonSuppr">SUPPRIMER</button>
            <hr>

                <div>

                ${afficherPlats(restaurant.plats)}


                </div>

            </div>
            
            `
            contenu.innerHTML += templateRestaurant;

            
            
        });
        
        const boutonsDelete = document.querySelectorAll(".boutonSuppr");

        boutonsDelete.forEach(bouton => {
            
            bouton.addEventListener("click", ()=>{

                supprimerRestaurant(bouton.id);

            })
        });



    })
    
   
}



displayAll();



function ajouterRestaurant(nomRestaurant, adresseRestaurant, villeRestaurant){

    let url = "http://localhost/examenPhpApi/?type=restaurant&action=new"


    let corpsRequete = {

        nom: nomRestaurant,
        adresse: adresseRestaurant,
        ville: villeRestaurant

    }


    let requete = {

        method: "POST",
        headers : {"Content-type":"application/json"},
        body : JSON.stringify(corpsRequete)

    }



    fetch(url, requete)
        .then(reponse=>reponse.json())
        .then(restaurant=> {
            
            console.log(restaurant)
            displayAll();
            document.querySelector("#nom").value = "";
            document.querySelector("#ville").value = "";
            document.querySelector("#adresse").value = "";
    
    })
};


function supprimerRestaurant(restaurantId){

    let url = "http://localhost/examenPhpApi/?type=restaurant&action=suppr"

    let corpsRequete = {

        id: restaurantId
    }

    let requete = {

        method : 'DELETE',
        headers : {"Content-type":"application/json"},
        body : JSON.stringify(corpsRequete)

    }


    fetch(url, requete)
        .then(reponse => reponse.json())
        .then(restaurant => {
            console.log(restaurant)
            displayAll();
        })
        
}

function supprimerPlat(platId){

    let url = "http://localhost/examenPhpApi/?type=plat&action=suppr"

    let corpsRequete = {

        id: platId
    }

    let requete = {

        method : 'DELETE',
        headers : {"Content-type":"application/json"},
        body : JSON.stringify(corpsRequete)

    }


    fetch(url, requete)
        .then(reponse => reponse.json())
        .then(restaurant => {
            console.log(plat)
            displayAll();
        })
        
}


function afficherPlats(plats) {

    
    let mesPlats = "";

    plats.forEach(plat=>{
      
      let templatePlat = `
    
    <h6> Découvrez : <strong>${plat.description}</strong></h6>
    <h6>Le prix est de <strong>${plat.price} € </strong></h6>
    <button id=${plat.id} class="btn btn-danger boutonSupprPlat">SUPPRIMER</button>
    
    `
    mesPlats += templatePlat
    })

    const boutonsSupprPlat = document.querySelectorAll(".boutonSupprPlat");

/*     boutonsSupprPlat.forEach(element => {

        bouton.addEventListener("click", ()=>{

            supprimerPlat(element.id);

        })



    })
 */  
    
  
    return mesPlats;


}

displayAll();