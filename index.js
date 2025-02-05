window.onload = function(){
    var connexion = document.getElementById("connexion");
    var creation = document.getElementById("creation");
    creation.style.display = "none";
    var lienConnexion = document.getElementById("lien-connexion");
    var lienCreation = document.getElementById("lien-creation");

    lienConnexion.onclick = function(){
        connexion.style.display = "block";
        creation.style.display = "none";
    }
    lienCreation.onclick = function(){
        connexion.style.display = "none";
        creation.style.display = "block";
    }
}



        // Fonction JavaScript pour gérer la déconnexion
      /*  function logout() {
            // Vous devrez adapter cela en fonction de votre système de gestion de session
            window.location.href = 'connexion.php';
        }

        function redirigerVersAutrePage1() {
            window.location.href = 'annuelle.php';
        }
        
        function redirigerVersAutrePage2() {
            window.location.href = 'mensuelle.php';
        }
        
        function redirigerVersAutrePage3() {
            window.location.href ='budget.php';
        }*/