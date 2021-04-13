<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Création d'un champion</title>
    </head>
    <style>
    form
    {
        text-align:center;
    }
    </style>
    <body>
    
        <form action="champion_envoyer.php" method="post">
            <h2>Créer un champion V0.0.1</h2>
        <p>
        <label for="nom">Nom</label> :  <input type="text" name="nom" id="nom" /><br />
        <label for="titre">Titre</label> :  <input type="text" name="titre" id="titre" /><br />
        
        <label for="role">Role</label> :  
        <select name="role">
            <option value="1">1-Assassin</option>
            <option value="2">2-Combattant</option>
            <option value="3">3-Mage</option>
            <option value="4">4-Tireur</option>
            <option value="5">5-Support</option>
            <option value="6">6-Tank</option>
        </select><br />
        
        <label for="difficulte">Difficulté</label> :  
        <select name="difficulte">
            <option value="1">1-Faible</option>
            <option value="2">2-Modérée</option>
            <option value="3">3-Élevée</option>
        </select><br />
        
        
        <label for="description">Description</label> :  <textarea type="text" name="description" id="description" rows="8" cols="45" ></textarea><br /><br /> 
        <!--
            <h3>Compétences</h3>
            
            <h4 name="passive_type" id="passive_type">Passive</h4>
        <label for="passive_nom">Nom</label> :  <input type="text" name="passive_nom" id="passive_nom" /><br />
        <label for="passive_description">Description</label> :  <textarea type="text" name="passive_description" id="passive_description" rows="8" cols="40" ></textarea><br />
        
            <h4 name="q_type" id="q_type">Q</h4>
        <label for="q_nom">Nom</label> :  <input type="text" name="q_nom" id="q_nom" /><br />
        <label for="q_description">Description</label> :  <textarea type="text" name="q_description" id="q_description" rows="8" cols="40" ></textarea><br />
        
            <h4 name="w_type" id="w_type">W</h4>
        <label for="w_nom">Nom</label> :  <input type="text" name="w_nom" id="w_nom" /><br />
        <label for="w_description">Description</label> :  <textarea type="text" name="w_description" id="w_description" rows="8" cols="40" ></textarea><br />
        
            <h4 name="e_type" id="e_type">E</h4>
        <label for="e_nom">Nom</label> :  <input type="text" name="e_nom" id="e_nom" /><br />
        <label for="e_description">Description</label> :  <textarea type="text" name="e_description" id="e_description" rows="8" cols="40" ></textarea><br />
        
            <h4 name="r_type" id="r_type">R</h4>
        <label for="r_nom">Nom</label> :  <input type="text" name="r_nom" id="r_nom" /><br />
        <label for="r_description">Description</label> :  <textarea type="text" name="r_description" id="r_description" rows="8" cols="40" ></textarea><br />
        
        -->
        
        <input type="hidden" name="utilisateur_id" value="1" /><br />
        <input type="submit" value="Envoyer" />
	</p>
    </form>

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

// Récupération des 10 derniers champions
//$reponse = $bdd->query('SELECT * FROM champions');


$reponse = $bdd->query(
        'SELECT champions.nom, roles.nom AS "role", difficultes.type AS "difficulte", utilisateurs.identifiant AS createur '
        . 'FROM champions INNER JOIN roles ON champions.role_id = roles.id '
        . 'INNER JOIN difficultes ON champions.difficulte_id = difficultes.id '
        . 'INNER JOIN utilisateurs ON champions.utilisateur_id = utilisateurs.id');


// Affichage de chaque champion (toutes les données sont protégées par htmlspecialchars)
while ($donnees = $reponse->fetch())
{
	//var_dump($donnees);
        echo '<p>' . '<strong>' . 
                htmlspecialchars($donnees['nom']) . 
                '</strong> : ' . 
                htmlspecialchars($donnees['role']) . 
                ', ' . 
                htmlspecialchars($donnees['difficulte']) . 
                ' (créé par ' . 
                htmlspecialchars($donnees['createur']) . 
                ')' . '</p>';
}

$reponse->closeCursor();

?>
    </body>
</html>