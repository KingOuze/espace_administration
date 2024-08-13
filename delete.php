<?php
include 'connexion.php';

$matricule = $_POST['matricule'];


// Récupérer les informations de l'étudiant à archiver
$sql_select = "SELECT * FROM etudiants WHERE matricule = '$matricule'";
$result = $conn->query($sql_select);
$row = $result->fetch_assoc();

// Insérer les données de l'étudiant dans la table d'archives
$sql_insert = "INSERT INTO `archivage`(`nom`, `prenom`, `email`,'telephone', `password`, `niveau`, `date_nais`, `matricule`)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql_insert);
$stmt->bind_param("ssssssss", $row['nom'], $row['prenom'], $row['email'], $row['telephone'], $row['password'], $row['niveau'], $row['date_nais'], $row['matricule'], 1);
if ($stmt->execute()) {
  echo "Étudiant archivé avec succès.";
} else {
  echo "Erreur lors de l'archivage de l'étudiant : " . $stmt->error;
  $conn->close();
  return;
}
$stmt->close();

// Supprimer l'étudiant de la table principale
$sql_delete = "DELETE FROM etudiants WHERE matricule = '$matricule'";
if ($conn->query($sql_delete) === TRUE) {
  echo " Étudiant supprimé de la table principale.";
} else {
  echo "Erreur lors de la suppression de l'étudiant : " . $conn->error;
}

$conn->close();
?>