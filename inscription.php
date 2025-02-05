

<?php
try {
    // Connexion à la base de données
    $mysqlConnection =new PDO('mysql:host=localhost;dbname=groupe51;charset=utf8', 'groupe5', 'MeuhMeuh123');

    $mysqlConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si le formulaire a été soumis
    if (isset($_POST['inscrit'])) {
        echo isset($_GET['idutilisateur']) ? $_GET['idutilisateur'] : '';
        $idutilisateur=$_GET['idutilisateur'];
                $nomenfant = $_POST['nomenfant'];
                $prenomenfant = $_POST['prenomenfant'];
                $datenaissance = $_POST['datenaissance'];
                $niveauscolaire = $_POST['niveauscolaire'];
                $classesouhaitee = $_POST['classesouhaitee'];
                $situation = ($_POST['situation'] == "oui") ? 1 : 0; // Si la case "oui" est cochée, la valeur est 1, sinon 0

                // Récupérer les données du père si disponibles
                $nompere = $emailpere = $telephonepere = null;
                if (!isset($_POST['pere'])) {
                    $nompere = $_POST['nompere'];
                    $emailpere = $_POST['emailpere'];
                    $telephonepere = $_POST['telephonepere'];
                }

                // Récupérer les données de la mère si disponibles
                $nomere = $emailmere = $telephonemere = null;
                if (!isset($_POST['mere'])) {
                    $nomere = $_POST['nomere'];
                    $emailmere = $_POST['emailmere'];
                    $telephonemere = $_POST['telephonemere'];
                }

                // Préparer la requête d'insertion pour l'enfant
                $sql_enfant = "INSERT INTO inscription ( nomenfant, datenaissance, niveauscolaire, classesouhaitee, situation, nompere, emailpere, telephonepere,
                                                        nomere, emailmere, telephonemere,idutilisateur, prenomenfant) 
                            VALUES ( :nomenfant, :datenaissance, :niveauscolaire, :classesouhaitee, :situation, :nompere, :emailpere, :telephonepere,
                                    :nomere, :emailmere, :telephonemere,:idutilisateur, :prenomenfant)";
                $stmt_enfant = $mysqlConnection->prepare($sql_enfant);
                // Liaison des paramètres pour l'enfant
            
                $stmt_enfant->bindParam(':nomenfant', $nomenfant);
                $stmt_enfant->bindParam(':datenaissance', $datenaissance);
                $stmt_enfant->bindParam(':niveauscolaire', $niveauscolaire);
                $stmt_enfant->bindParam(':classesouhaitee', $classesouhaitee);
                $stmt_enfant->bindParam(':situation', $situation);
                $stmt_enfant->bindParam(':nompere', $nompere);
                $stmt_enfant->bindParam(':emailpere', $emailpere);
                $stmt_enfant->bindParam(':telephonepere', $telephonepere);
                $stmt_enfant->bindParam(':nomere', $nomere);
                $stmt_enfant->bindParam(':emailmere', $emailmere);
                $stmt_enfant->bindParam(':telephonemere', $telephonemere);
                $stmt_enfant->bindParam(':idutilisateur', $idutilisateur); 
                $stmt_enfant->bindParam(':prenomenfant', $prenomenfant);
                // Ajoutez cette ligne après les autres liaisons de paramètres



                $stmt_enfant->execute();

                // Afficher un message de succès ou rediriger vers une page de succès
                echo "Les données ont été envoyées avec succès !";
                // Arrête l'exécution du script après la redirection
                
            }
 }
  catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

 <title>Inscription à l'école Santa</title>
 <link rel="stylesheet" href="inscription.css">
 <script src="inscription.js"></script>
</head>

<body>
        <?php include('header.php'); // Inclusion de l'en-tête de la page?>
            <h1>Inscription scolaire de  Montessori</h1>

            <form action="" method="POST">
                
                <h2>Informations sur l'enfant</h2>
                <label for="nomenfant">Nom de l'enfant :</label>
                <input type="text" id="nomenfant" name="nomenfant" required><br><br>

                <label for="prenomenfant">Prenom de l'enfant :</label>
                <input type="text" id="prenomenfant" name="prenomenfant" required><br><br>
                
                <label for="datenaissance">Date de naissance de l'enfant :</label>
                <input type="date" id="datenaissance" name="datenaissance" required><br><br>
                
                <label for="niveauscolaire">Niveau scolaire de l'enfant :</label>
                <select id="niveauscolaire" name="niveauscolaire" required>
                    <option value="CP">CP</option>
                    <option value="CE1">CE1</option>
                    <option value="CE2">CE2</option>
                    <option value="CM1">CM1</option>
                    <option value="CM2">CM2</option>
                </select><br><br>
                
                <label for="classesouhaitee">Classe souhaitée :</label>
                <input type="text" id="classesouhaitee" name="classesouhaitee" required><br><br>

                <label>Situation d'handicap? :</label><br>
                <label><input type="radio" name="situation" value="oui"> Oui</label>
                 <label><input type="radio" name="situation" value="non"> Non</label><br>
                
                   <section id="spere">
                                <label>Remplir les informations du père :</label><br>
                            <label>
                                <input type="checkbox" name="pere" value="non"<!--onclick="gererCheckbox()"-->>
                                Non
                            </label>
                            <label for="nompere">Nom du parent/tuteur :</label>
                            <input type="text" id="nompere" name="nompere" ><br><br>
                            
                            <label for="emailpere">Email du parent/tuteur :</label>
                            <input type="text" id="emailpere" name="emailpere"><br><br>
                            
                            <label for="telephonepere">Téléphone du parent/tuteur :</label>
                            <input type="text" id="telephonepere" name="telephonepere" ><br><br>
                </section>
                <section id="smere">
                    <label>Remplir les informations de la mère :</label><br>
                    <label>
                        <input type="checkbox" name="mere" value="non1" <!--onclick="gererCheckbox()"-->>
                        Non
                    </label>
                    <label for="nomere">Nom du parent/tuteur :</label>
                    <input type="text" id="nomere" name="nomere" ><br><br>
                    
                    <label for="emailmere">Email du parent/tuteur :</label>
                    <input type="text" id="emailmere" name="emailmere" ><br><br>
                    
                    <label for="telephonemere">Téléphone du parent/tuteur :</label>
                    <input type="text" id="telephonemere" name="telephonemere"><br><br>    
                                  
                 </section>
                 <input type="submit" value="Inscrire l'enfant" id="inscrit" name="inscrit">  
            </form>
            

</body>
</html>
