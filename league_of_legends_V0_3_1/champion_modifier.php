<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Modification d'un champion</title>
    </head>
    <style>
    form
    {
        text-align:center;
    }
    </style>
    <body>
        
        <?php
        // Connexion à la base de données
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=league_of_legends_v0_3_1;charset=utf8', 'root', 'mysql', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
        
        //Récupération du champion à modifier
        try {
            $req = $bdd->prepare('SELECT * FROM champions WHERE id = ?');
            $req->execute(array($_GET['id']));
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        
        //Affichage du champion à modifier (toutes les données externes sont protégées par htmlspecialchars)
        $donnees = $req->fetch();
        $req->closeCursor();
        $role = htmlspecialchars($donnees['role_id']);
        $difficulte = htmlspecialchars($donnees['difficulte_id']);
        ?>
        
        <form action="champion_mise_a_jour.php" method="post">
        <h2>Modifier un champion V0.1.1</h2>
            <p>
                <label for="nom">Nom</label> :  <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($donnees['nom']); ?>" /><br />
                <label for="titre">Titre</label> :  <input type="text" name="titre" id="titre" value="<?php echo htmlspecialchars($donnees['titre']); ?>" /><br />

                <label for="role">Role</label> :  
                <select name="role">
                    <option value="1" <?php if($role == '1'){echo('selected="selected"');}?> >1-Assassin</option>
                    <option value="2" <?php if($role == '2'){echo('selected="selected"');}?> >2-Combattant</option>
                    <option value="3" <?php if($role == '3'){echo('selected="selected"');}?> >3-Mage</option>
                    <option value="4" <?php if($role == '4'){echo('selected="selected"');}?> >4-Tireur</option>
                    <option value="5" <?php if($role == '5'){echo('selected="selected"');}?> >5-Support</option>
                    <option value="6" <?php if($role == '6'){echo('selected="selected"');}?> >6-Tank</option>
                </select><br />

                <label for="difficulte">Difficulté</label> :  
                <select name="difficulte">
                    <option value="1" <?php if($difficulte == '1'){echo('selected="selected"');}?> >1-Faible</option>
                    <option value="2" <?php if($difficulte == '2'){echo('selected="selected"');}?> >2-Modérée</option>
                    <option value="3" <?php if($difficulte == '3'){echo('selected="selected"');}?> >3-Élevée</option>
                </select><br />

                
                <label for="description">Description</label> :  <textarea type="text" name="description" id="description" rows="8" cols="45" ><?php echo htmlspecialchars($donnees['description']); ?></textarea><br /><br /> 
                
                <input type="hidden" name="champion_id" value="<?php echo $_GET['id']; ?>" />
                <input type="hidden" name="createur" value="<?php echo $_GET['utilisateur_id']; ?>" /><br />
                <input type="submit" value="Modifier" />
            </p>
        </form>
        
    </body>
</html>