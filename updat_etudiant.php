<?php
include 'connexion.php';
?>

<?php include 'menu.php'; ?>

  <h1>Modifier un étudiant</h1>

  <?php
  // Récupérer le matricule de l'étudiant à modifier
  $matricule = $_GET['matricule'];

  // Récupérer les informations de l'étudiant depuis la base de données
  $sql = "SELECT * FROM etudiants WHERE matricule = '$matricule'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  ?>

  <form method="post" id="form" action="updat_etudiant.php" onsubmit="return validateForm()">
    <input type="hidden" name="matricule" value="<?php echo $row['matricule']; ?>">
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" value="<?php echo $row['prenom']; ?>">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" value="<?php echo $row['nom']; ?>">
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>">
    <label for="telephone">Téléphone :</label>
    <input type="tel" id="telephone" name="telephone" value="<?php echo $row['telephone']; ?>">
    <button type="submit" class="mybutton">Enregistrer</button>
  </form>

  <script src="script.js"></script>

  <?php include 'footer.php'; ?>

<?php


// Récupérer les données du formulaire
$matricule = $_POST['matricule'];
$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$email = $_POST['email'];
$telephone = $_POST['telephone'];

// Valider les données
if (empty($prenom) || empty($nom) || empty($email) || empty($telephone)) {
  echo "Veuillez remplir tous les champs obligatoires.";
  exit();
}

// Mettre à jour les informations de l'étudiant dans la base de données
$req = "UPDATE etudiants SET prenom = '$prenom', nom = '$nom', email = '$email', telephone = '$telephone' WHERE matricule = '$matricule'";
if ($conn->query($req) === TRUE) {
  echo "Données mises à jour avec succès.";
  header("Location: acceuil.php"); // Rediriger vers la page d'accueil
} else {
  echo "Erreur lors de la mise à jour des données : " . $conn->error;
}

$conn->close();
?>