<?php
        session_start();

        // Vérifiez si l'utilisateur est connecté
        if (!isset($_SESSION['nom'])) {
            // Si non, redirigez vers la page de connexion
            header("Location: index.php?error=unauthorized");
            
            exit();
        }

        // Accédez à l'identifiant de l'utilisateur depuis la session
      //  $id_utilisateur = $_SESSION['id_utilisateur'];
        ?>
       
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="accueil.css">
    <script src="accueil.js"></script>
</head>
<body>
<?php
            include('header.php'); // Inclusion de l'en-tête de la page

            // Vérifier si l'utilisateur est connecté et que son identifiant est défini dans la session
            if (isset($_SESSION['nom'])) {
                echo '<p class="form-login">Bienvenue, ' . $_SESSION['nom'] . '</p>';
                // Affichage du message de bienvenue
            } else {
                echo '<p class="form-login">Bienvenue, visiteur</p>'; // Message par défaut si l'utilisateur n'est pas connecté
            }

            // Bouton pour ajouter un dossier
            echo '<form method="POST"><input class="btn" type="submit" value="Ajouter un dossier" name="aj"></form><br><br>';

            try {
                // Connexion à la base de données
                $pdo = new PDO('mysql:host=localhost;dbname=groupe51;charset=utf8', 'groupe5', 'MeuhMeuh123');


                // Vérifier si l'identifiant de l'utilisateur est défini

                if (isset($_SESSION['id'])) {
                    $idutilisateur=$_SESSION['id'];
                    // Préparation de la requête SQL pour sélectionner les dossiers d'inscription associés à l'identifiant de l'utilisateur
                    $query = "SELECT * FROM inscription WHERE idutilisateur= :idutilisateur";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(':idutilisateur', $idutilisateur);
                    
                    // Exécution de la requête
                    $stmt->execute();

                    // Récupération des résultats de la requête
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                 // Boucle pour chaque dossier
            foreach ($result as $row) {
                $nomenfant = $row['nomenfant'];

                // Deuxième requête pour récupérer l'avancement du dossier
                $query = "SELECT avancement FROM inscription WHERE nomenfant = :nomenfant";
                $stmt2 = $pdo->prepare($query);
                $stmt2->bindParam(':nomenfant', $nomenfant);
                // Exécution de la deuxième requête
                $stmt2->execute();
                // Récupération des résultats de la deuxième requête
                $avancement = $stmt2->fetchColumn();
                   
                    if($avancement==0){
                        $avancementimg='<img class="attente" alt="dossier en attente" src="images/attente.png">';
                    }
                    else if($avancement==1){
                        $avancementimg='<img class="manquant" alt="élément(s) manquant(s)" src="images/trait.png">';
                    }
                    else if($avancement==2){
                        $avancementimg='<img class="refus" alt="dossier refusé" src="images/refuse.png">';
                    }
                    else if($avancement==3){
                        $avancementimg='<img class="valide" alt="dossier validé" src="images/valide.png">';
                    }
                    // Affichage des résultats
                    
                        echo '<div class="dossier">';
                        echo "DOSSIER D'INSCRIPTION DE " . $row['prenomenfant'] ;
                        echo $avancementimg;
                         // Afficher d'autres informations sur le dossier d'inscription si nécessaire
                        echo "<hr>"; // Séparateur entre chaque dossier
                        echo "<br><br><br><br><br>";
                        echo '</div>';
                       
                    }
                } else {
                    echo "Veuillez vous connecter pour voir vos dossiers d'inscription."; // Message si l'utilisateur n'est pas connecté
                }
                if(isset($_POST['aj'])){
                    header("Location: inscription.php?idutilisateur=$idutilisateur");
                    
                }
        


            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            ?>


<br><br><br><footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h4>Contact</h4>
                        <p>Adresse: 43 Rue sainte-Anne, Limoges, France</p>
                        <p>Téléphone: +33 757575243</p>
                        <p>Email: info@ecole.com</p>
                    </div>
                    <div class="col-md-4">
                        <h4>Liens utiles</h4>
                        <ul>
                            <li><a href="#">À propos de nous</a></li>
                            <li><a href="#">Programmes d'études</a></li>
                            <li><a href="#">Admissions</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h4>Suivez-nous</h4>
                        
                        <ul>
                            <li><a href="#">instagram</a></li>
                            <li><a href="#">linkedin</a></li>
                            <li><a href="#">facebook</a></li>
                    
                        </ul>
                    </div>
                </div>
            </div>
        </footer>


</body>


</html>