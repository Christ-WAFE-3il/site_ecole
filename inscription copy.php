

<?php
var_dump($_POST);
try {
    $mysqlConnection = new PDO(
        'mysql:host=localhost;dbname=projetdev;charset=utf8',
        'root',
        ''
    );
    $mysqlConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['inscrit'])) {
        // Récupérer les données de l'enfant
        $nomenfant = $_POST['nomenfant'];
        $datenaissance = $_POST['datenaissance'];
        $niveauscolaire = $_POST['niveauscolaire'];
        $classesouhaitee = $_POST['classesouhaitee'];
        $situation = isset($_POST['situation']) ? 1 : 0; // Si la case "oui" est cochée, la valeur est 1, sinon 0

        // Récupérer les données du père si disponibles
        $nompere = $emailpere = $telephonepere = "";
        if (isset($_POST['pere']) && $_POST['pere'] != "non") {
            $nompere = $_POST['nompere'];
            $emailpere = $_POST['emailpere'];
            $telephonepere = $_POST['telephonepere'];
        }

        // Récupérer les données de la mère si disponibles
        $nomere = $emailmere = $telephonemere = "";
        if (isset($_POST['mere']) && $_POST['mere'] != "non1") {
            $nomere = $_POST['nomere'];
            $emailmere = $_POST['emailmere'];
            $telephonemere = $_POST['telephonemere'];
        }

        // Préparer la requête d'insertion pour l'enfant
        $sql_enfant = "INSERT INTO inscription (nomenfant, datenaissance, niveauscolaire, classesouhaitee, situation) 
                       VALUES (:nomenfant, :datenaissance, :niveauscolaire, :classesouhaitee, :situation)";
        $stmt_enfant = $mysqlConnection->prepare($sql_enfant);
        // Liaison des paramètres pour l'enfant
        $stmt_enfant->bindParam(':nomenfant', $nomenfant);
        $stmt_enfant->bindParam(':datenaissance', $datenaissance);
        $stmt_enfant->bindParam(':niveauscolaire', $niveauscolaire);
        $stmt_enfant->bindParam(':classesouhaitee', $classesouhaitee);
        $stmt_enfant->bindParam(':situation', $situation);
        // Exécution de la requête pour l'enfant
        $stmt_enfant->execute();

        // Préparer la requête d'insertion pour le père si disponible
        if ($nompere != "") {
            $sql_pere = "INSERT INTO inscription (nompere, emailpere, telephonepere) 
                         VALUES (:nompere, :emailpere, :telephonepere)";
            $stmt_pere = $mysqlConnection->prepare($sql_pere);
            // Liaison des paramètres pour le père
            $stmt_pere->bindParam(':nompere', $nompere);
            $stmt_pere->bindParam(':emailpere', $emailpere);
            $stmt_pere->bindParam(':telephonepere', $telephonepere);
            // Exécution de la requête pour le père
            $stmt_pere->execute();
        }

        // Préparer la requête d'insertion pour la mère si disponible
        if ($nomere != "") {
            $sql_mere = "INSERT INTO inscription (nomere, emailmere, telephonemere) 
                         VALUES (:nomere, :emailmere, :telephonemere)";
            $stmt_mere = $mysqlConnection->prepare($sql_mere);
            // Liaison des paramètres pour la mère
            $stmt_mere->bindParam(':nomere', $nomere);
            $stmt_mere->bindParam(':emailmere', $emailmere);
            $stmt_mere->bindParam(':telephonemere', $telephonemere);
            // Exécution de la requête pour la mère
            $stmt_mere->execute();
        }

        // Afficher un message de succès ou rediriger vers une page de succès
        echo "Les données ont été envoyées avec succès !";
    }
} catch (PDOException $e) {
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

            <h1>Inscription scolaire de  Montessori</h1>

            <form action="" method="POST">
                
                <h2>Informations sur l'enfant</h2>
                <label for="nomenfant">Nom de l'enfant :</label>
                <input type="text" id="nomenfant" name="nomenfant" required><br><br>
                
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
                                <input type="checkbox" name="pere" value="non" onclick="gererCheckbox()">
                                Non
                            </label>
                            <label for="nompere">Nom du parent/tuteur :</label>
                            <input type="text" id="nompere" name="nompere" required><br><br>
                            
                            <label for="emailpere">Email du parent/tuteur :</label>
                            <input type="text" id="emailpere" name="emaipere" required><br><br>
                            
                            <label for="telephonepere">Téléphone du parent/tuteur :</label>
                            <input type="text" id="telephonepere" name="telephonepere" required><br><br>
                </section>
                <section id="smere">
                    <label>Remplir les informations de la mère :</label><br>
                    <label>
                        <input type="checkbox" name="mere" value="non1" onclick="gererCheckbox()">
                        Non
                    </label>
                    <label for="nomere">Nom du parent/tuteur :</label>
                    <input type="text" id="nomere" name="nomere" required><br><br>
                    
                    <label for="emailmere">Email du parent/tuteur :</label>
                    <input type="text" id="emailmere" name="emailmere" required><br><br>
                    
                    <label for="telephonemere">Téléphone du parent/tuteur :</label>
                    <input type="text" id="telephonemere" name="telephonemere" required><br><br>    
                                  
                 </section>
                 <input type="submit" value="Inscrire l'enfant" id="inscrit" name="inscrit">  
            </form>
            

</body>
</html>
