<?php
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=league_of_legends_v0_0_1;charset=utf8', 'root', 'mysql', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// Insertion du champion à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO champions (nom, titre, role_id, difficulte_id, description, utilisateur_id) VALUES(?, ?, ?, ?, ?, ?)');
$req->execute(array($_POST['nom'], $_POST['titre'], $_POST['role'], $_POST['difficulte'], $_POST['description'], $_POST['utilisateur_id']));

/*
// Insertion des compétences à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO competences (type, nom, description, champion_id) VALUES(?, ?, ?, ?)');
$req->execute(array($_POST['passive_type'], $_POST['passive_nom'], $_POST['passive_description'], $_POST['champion_id']));
$req->execute(array($_POST['q_type'], $_POST['q_nom'], $_POST['q_description'], $_POST['champion_id']));
$req->execute(array($_POST['w_type'], $_POST['w_nom'], $_POST['w_description'], $_POST['champion_id']));
$req->execute(array($_POST['e_type'], $_POST['e_nom'], $_POST['e_description'], $_POST['champion_id']));
$req->execute(array($_POST['r_type'], $_POST['r_nom'], $_POST['r_description'], $_POST['champion_id']));
*/

// Redirection du visiteur vers la page de leagueoflegends
// Mettre en commentaire pour déboguer
header('Location: index.php');
?>
<html>
    <body>
        
                <h2>Envoyer un commentaire V0.0.2</h2>
            *** Pour déboguage ***<br />
            Voici le contenu de $_POST envoyé par le formulaire d'envoi et transmis à la requête : <br />
        <?php var_dump ($_POST); ?>
        <?php // print_r($_POST); // décommentez pour comparer avec var_dump ?>
        <form action="index.php">
            <input type="submit" value="Continuer">
        </form>
    </body>
</html>