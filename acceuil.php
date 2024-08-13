<?php

include 'connexion.php';
?>
  
<?php include 'menu.php'; ?>

<h1>Tableau de bord des étudiants</h1>

<div>
  <button id="show-non-archived" class="btn btn-primary">Etudiants Non Archivés</button>
  <button id="show-archived" class="btn btn-primary">Etudiants Archivés</button>
</div>

<div id="non-archived-table-container" style="display: none;">
  <h2>Étudiants non archivés</h2>
  <table id="non-archived-table">
    <thead>
      <tr>
        <th>Matricule</th>
        <th>Prenom</th>
        <th>Nom</th>
        <th>Date de Naissance</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Niveau</th>
        <th>Action</th>
        <th>Archiver</th>
      </tr>
    </thead>
    <tbody id="data-table-body">

     <!-- Les données seront insérées ici dynamiquement -->
    <?php

        $sql = "SELECT * FROM etudiants WHERE archivage = 'false'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
          ?>
            <tr>
              <td><?php echo $row["matricule"]; ?></td>
              <td><?php echo $row["prenom"] ?></td>
              <td><?php echo $row["nom"] ?></td>
              <td><?php echo $row["date_nais"] ?></td>
              <td><?php echo $row["email"] ?></td>
              <td><?php echo $row["telephone"] ?></td>
              <td><?php echo $row["niveau"] ?></td>
              <td>
                <form method="post" action="updat_etudiant.php?matricule=<?php echo $row["matricule"]; ?>" onsubmit="return confirmAction();">
                  <button class="btn btn-primary">Modifier</button>
                </form>
                <form method="post" action="acceuil.php?matricule=<?php echo $row["matricule"]; ?>" >
                  <button id="supprime-btn-<?php echo $row['matricule']; ?>" class="btn btn-danger">Supprimer</button>
                </form>
              </td>
              <td>
                <button id="archive-btn-<?php echo $row['matricule']; ?>" class="btn btn-archive">Archiver</button>
              </td>
          </tr>
          <?php
          }
        } else {
          echo "<tr><td colspan='9'>Aucun étudiant non archivé</td></tr>";
        }
        ?>
 
    </tbody>
  </table>
</div>

<div id="archived-table-container" style="display: none;">
  <h2>Étudiants archivés</h2>
  <table id="archived-table">
        <!-- Tableau des étudiants archivés -->
        <thead>
      <tr>
        <th>Matricule</th>
        <th>Prenom</th>
        <th>Nom</th>
        <th>Date de Naissance</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Niveau</th>
        <th>date Archivage</th>
        <th>Archiver</th>
      </tr>
    </thead>
        <?php

    $sql = "SELECT * FROM etudiants WHERE archivage = 'true'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
      ?>
        <tr>
          <td><?php echo $row["matricule"]; ?></td>
          <td><?php echo $row["prenom"] ?></td>
          <td><?php echo $row["nom"] ?></td>
          <td><?php echo $row["date_nais"] ?></td>
          <td><?php echo $row["email"] ?></td>
          <td><?php echo $row["telephone"] ?></td>
          <td><?php echo $row["niveau"] ?></td>
          <td><?php echo $row["date_archive"] ?></td>
          <td>
            <button id="archive-btn-<?php echo $row['matricule']; ?>" class="btn btn-archive">Désarchiver</button>
          </td>
      </tr>
      <?php
      }
    } else {
      echo "<tr><td colspan='9'>Aucun étudiant non archivé</td></tr>";
    }
    ?>

    </tbody>
  </table>
</div>
 

<script src="script.js"></script> 
<?php include 'footer.php'; ?>


<?php

// Récupérer le matricule de l'étudiant à archiver
$matricule = $_POST['matricule'];

// Mettre à jour le statut d'archivage de l'étudiant dans la base de données
$sql = "UPDATE etudiants SET archivage = 'true' WHERE matricule = '$matricule'";
if ($conn->query($sql) === TRUE) {
  echo "Étudiant archivé avec succès.";
} else {
  echo "Erreur lors de l'archivage de l'étudiant : " . $conn->error;
}
