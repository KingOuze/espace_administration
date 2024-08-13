<?php
include 'connexion.php';

// Récupérer le matricule de l'étudiant à archiver
$matricule = $_POST['matricule'];
$date = date("Y-m-d H:i:s");

// Mettre à jour le statut d'archivage de l'étudiant dans la base de données
$sql = "UPDATE etudiants SET archivage = 'true', date_archive = '$date' WHERE matricule = '$matricule'";
if ($conn->query($sql) === TRUE) {
  echo "Étudiant archivé avec succès.";
} else {
  echo "Erreur lors de l'archivage de l'étudiant : " . $conn->error;
}

$conn->close();
?>