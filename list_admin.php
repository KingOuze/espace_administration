<?php 

include 'menu.php';
include 'connexion.php';

?>

<div>
  <h2>Liste des Administrateurs</h2>
  <table>
    <thead>
      <tr>
        <th>Prenom</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

     <!-- Les données seront insérées ici dynamiquement -->
    <?php

        $sql = "SELECT * FROM admin WHERE role = 'user'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
          ?>
            <tr>
              <td><?php echo $row["prenom"] ?></td>
              <td><?php echo $row["nom"] ?></td>
              <td><?php echo $row["email"] ?></td>
              <td>
                <form method="post" action="updat_etudiant.php?matricule=<?php echo $row["matricule"]; ?>" onsubmit="return confirmAction();">
                  <button class="btn btn-primary">Modifier</button>
                </form>
                <form method="post" action="acceuil.php?matricule=<?php echo $row["matricule"]; ?>" >
                  <button id="supprime-btn-<?php echo $row['matricule']; ?>" class="btn btn-danger">Supprimer</button>
                </form>
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

<?php include 'footer.php'; ?>