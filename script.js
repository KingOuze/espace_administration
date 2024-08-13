
function confirmAction() {
  if (confirm("Êtes-vous sûr de vouloir effectuer cette action ?")) {
      return true;
  } else {
      return false;
  }
}

var supprimBtns = document.querySelectorAll('.btn-danger');

//Récupérer tous les boutons "Archiver"
var archiveBtns = document.querySelectorAll('.btn-archive');


// Ajouter un écouteur d'événement click sur chaque bouton
archiveBtns.forEach(function(btn) {
  btn.addEventListener('click', function() {
    var matricule = this.id.split('-')[2];
    archiveEtudiant(matricule);
  });
});

supprimBtns.forEach(function(btn) {
  btn.addEventListener('click', function() {
    var matricule = this.id.split('-')[2];
    dropEtudiant(matricule);
  });
});


function archiveEtudiant(matricule) {
  if (confirm("Êtes-vous sûr de vouloir archiver cet étudiant ?")) {
    // Envoyer une requête HTTP en utilisant l'API Fetch
    fetch('archive.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: 'matricule=' + matricule
    })
    .then(function(response) {
      return response.text();
    })
    .then(function(data) {
      alert(data);
      // Rafraîchir la page ou mettre à jour le tableau dynamiquement
      location.reload();
    })
    .catch(function(error) {
      alert("Erreur lors de l'archivage de l'étudiant : " + error);
    });
  }
}


function dropEtudiant(matricule) {
  if (confirm("Êtes-vous sûr de vouloir supprimer cet étudiant ?")) {
    // Envoyer une requête HTTP en utilisant l'API Fetch
    fetch('delete.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: 'matricule=' + matricule
    })
    .then(function(response) {
      return response.text();
    })
    .then(function(data) {
      alert(data);
      // Rafraîchir la page ou mettre à jour le tableau dynamiquement
      location.reload();
    })
    .catch(function(error) {
      alert("Erreur lors de l'archivage de l'étudiant : " + error);
    });
  }
}

function validateForm() {
  var prenom = document.getElementById("prenom").value;
  var nom = document.getElementById("nom").value;
  var email = document.getElementById("email").value;
  var telephone = document.getElementById("telephone").value;

  if (prenom == "") {
    alert("Le prénom doit être rempli.");
    return false;
  }
  if (nom == "") {
    alert("Le nom doit être rempli.");
    return false;
  }
  if (email == "") {
    alert("L'email doit être rempli.");
    return false;
  }
  if (telephone == "") {
    alert("Le numéro de téléphone doit être rempli.");
    return false;
  }
  return true;
}

 // Récupérer les boutons et les conteneurs
 var showNonArchivedBtn = document.getElementById('show-non-archived');
 var showArchivedBtn = document.getElementById('show-archived');
 var nonArchivedTableContainer = document.getElementById('non-archived-table-container');
 var archivedTableContainer = document.getElementById('archived-table-container');

 // Ajouter les écouteurs d'événement sur les boutons
 showNonArchivedBtn.addEventListener('click', function() {
   nonArchivedTableContainer.style.display = 'block';
   archivedTableContainer.style.display = 'none';
 });

 showArchivedBtn.addEventListener('click', function() {
   nonArchivedTableContainer.style.display = 'none';
   archivedTableContainer.style.display = 'block';
 });
