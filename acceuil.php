<?php


$servername = "localhost";
$username = "root@localhost";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de bord de l'administrateur</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Tableau de bord de l'administrateur</h1>
    <nav>
      <ul>
        <li><a href="acceuil.php">Accueil</a></li>
        <li><a href="add_admin.php">ajout Admin</a></li>
        <li><a href="add_etudiants.php">Ajout Etudiant</a></li>
        <li><a href="deconnect.php">Déconnexion</a></li>
      </ul>
    </nav>
  </header>
  
  <main>
    <div class="dashboard-section">
      <h2>Résumé</h2>
      <ul>
        <li>Nombre total d'utilisateurs : 250</li>
        <li>Nouveaux utilisateurs cette semaine : 15</li>
        <li>Transactions effectuées aujourd'hui : 100</li>
      </ul>
    </div>
    
    <div class="dashboard-section">
      <h2>Activité récente</h2>
      <ul>
        <li>Nouvel utilisateur inscrit : John Doe</li>
        <li>Mise à jour du profil utilisateur : Jane Smith</li>
        <li>Nouvelle transaction effectuée : 50 €</li>
      </ul>
    </div>
  </main>
  
  <footer>
    <p>&copy; 2024 Tableau de bord de l'administrateur. Tous droits réservés.</p>
  </footer>
</body>
</html>