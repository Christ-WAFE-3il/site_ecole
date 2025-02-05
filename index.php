<?php
                          
                          try{
                              $mysqlConnection=new PDO('mysql:host=localhost;dbname=groupe51;charset=utf8', 'groupe5', 'MeuhMeuh123');

                          }
                          catch(Exception $e)
                          {
                               ('Erreur :'. $e-> getMessage());
                          }
                        
                         if(isset($_POST['creer']))

                         {
                            
                          $nom = $_POST['nom'];
                          $email = $_POST['email'];
                          $motdepasse = $_POST['motdepasse'];
                          var_dump($nom);
            
                          
                          // Vérifier si l'utilisateur existe déjà avec la même adresse e-mail
                          $sql_verification = "SELECT COUNT(*) AS count FROM devconnexion WHERE `email` = :email";
                          $stmt_verification = $mysqlConnection->prepare($sql_verification);
                          $stmt_verification->bindParam(':email', $email);
                          $stmt_verification->execute();
                          $result_verification = $stmt_verification->fetch(PDO::FETCH_ASSOC);
                          
                          if ($result_verification['count'] > 0) {
                              // L'utilisateur existe déjà, afficher un message d'erreur
                              echo "Un utilisateur avec cette adresse e-mail existe déjà.";
                          } else {
                              // L'utilisateur n'existe pas, procéder à l'insertion
                              // Crypter le mot de passe avec password_hash
                              $motdepassecrypte = password_hash($motdepasse, PASSWORD_DEFAULT);
        
                              // Requête SQL pour l'insertion
                              $sql_insertion = "INSERT INTO `devconnexion` (`nom`, `email`, `motdepasse`) VALUES (:nom, :email, :motdepasse)";
                              $stmt_insertion = $mysqlConnection->prepare($sql_insertion);
                          
                              // Liaison des paramètres
                              $stmt_insertion->bindParam(':nom', $nom);
                              $stmt_insertion->bindParam(':email', $email);
                              $stmt_insertion->bindParam(':motdepasse', $motdepassecrypte);
                          
                              // Exécution de la requête
                              $stmt_insertion->execute();
                          
                              // Afficher un message de succès ou rediriger vers une page de succès
                              echo "Inscription réussie !";
                          }
                            
                           
                         }
                         
                         if(isset($_POST['connexion']))
                       {
                          $nom=$_POST['nom'];
                          var_dump($nom);

                          $motdepasse=$_POST['motdepasse'];
                          var_dump($motdepasse);
                          // Requête SQL pour récupérer les informations de l'utilisateur
                          $sql = "SELECT * FROM `devconnexion` WHERE `nom` = :nom";
                          $stmt = $mysqlConnection->prepare($sql);
                          $stmt->bindParam(':nom', $nom);
                          $stmt->execute();
                           
                          // Récupérer les données de l'utilisateur
                          $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
                          $idutilisateur=$utilisateur['id'];
                          
                        
                          
                          // Vérifier si l'utilisateur existe
                          if ($utilisateur) {
                              // Vérifier si le mot de passe correspond
                              if (password_verify($motdepasse, $utilisateur['motdepasse'])) {
                               
                                  // Le mot de passe est correct, vous pouvez procéder à la connexion
                                  // Par exemple, définir des sessions, rediriger vers une page d'accueil, etc.
                                  header("Location: inscription.php?nom=$nom");
                                  echo "Connexion réussie !";
                                  session_start();
                                  $_SESSION['nom'] = $nom ;
                                  $_SESSION['id']=$idutilisateur;
                                 header("Location: accueil.php");
                                 
                                exit();
                            
                              } else {
                                  // Mot de passe incorrect
                                  echo "Mot de passe incorrect.";
                                 
                              }
                          } else {
                              // L'utilisateur n'existe pas
                              echo "Aucun utilisateur trouvé cet email.";
                              
                          }
                          
                      }
                      if (isset($_GET['error'])) {
                        $errorMessage = '';
                    
                        // Déterminez le message d'erreur en fonction de la valeur du paramètre GET
                        switch ($_GET['error']) {
                            case 'unauthorized':
                                $errorMessage = "Accès non autorisé. Veuillez vous connecter pour accéder à cette page.";
                                break;
                            // Ajoutez d'autres cas si nécessaire
                    
                            default:
                                $errorMessage = "Une erreur inattendue s'est produite.";
                        }
                    
                        // Affichez le message d'erreur
                        echo '<p style="color: red;">' . $errorMessage . '</p>';
                    }
                      
                    
                     
                 
              ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
    <script src="index.js"></script>
</head>
<body>
<nav>
        <p>MONTESSORI</p>
        <!-- Ajoutez d'autres liens vers vos pages ici -->
         <a href="apropos.php">A PROPOS</a>

    </nav>
        <div class="div">
            <h1>BIENVENUE A MONTESSORI</h1>
            <p>le meilleur choix pour vos enfants</p>
        </div>
         <section class="wrapper"  id="connexion">
                <form action="" method="POST">
                    <p class="form-login">LOGIN</p>
                    <div class="input-box">
                    <input required="" placeholder="Username" type="text" id="nom" name="nom"/>
                    </div>
                    <div class="input-box">
                    <input required="" placeholder="Password" type="password" id="motdepasse" name="motdepasse"/>
                    </div>
                    <input class="btn" type="submit" value="Login " id="connexion" name="connexion">
                    <div class="register-link">
                    <label id="lien-creation">Don't have an account? click here</label>
                    </div>
          
                </form>     
    </section>

    <section class="wrapper"  id="creation">
                <form action="" method="POST">
                    <p class="form-login">SIGN UP</p>
                    <div class="input-box">
                    <input required="" placeholder="Username" type="text" id="nom" name="nom" />
                    </div>
                    <div class="input-box">
                    <input required="" placeholder="email" type="text"  id="email" name="email"/>
                    </div>
                    <div class="input-box">
                    <input required="" placeholder="Password" type="password" id="motdepasse" name="motdepasse" oninput="verifierMotDePasse()"/>
                    </div>
                    <input class="btn" type="submit" value="sign up"  id="creer" name="creer"><br>
            <label id="lien-connexion">return</label>
        </form>    
    </section>
</body>
</html>
