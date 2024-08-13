<?php
include 'connexion.php';
// pour afficher les erreurs afin de diagnostiquer le problème
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }

// vérifions que les champs ne sont pas vides lorsqu'on appuie sur le bouton d'inscription
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
    if (!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {

        $nom = test_input($_POST["nom"]);
        $prenom = test_input($_POST["prenom"]);
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);
        $role = 'user';
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        }
        $password = md5($password);
        // Insertion des données dans la table admin
        $req = "INSERT INTO 'admin' ('nom', 'prenom', 'email', 'password', 'role') VALUES('$nom', '$prenom', '$email', '$password', '$role')";
        if ($conn->query($req) === TRUE) {
            echo "Inscription réussie !";
            header('Location: list_admin.php');
            exit;
        } else {
            echo "Erreur lors de l'inscription.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>

<?php include 'menu.php'; ?>

    <h1>Ajouter un Administrateur</h1>
    
    <form method="post" id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validateForm()">
        
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom"  require>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" require>
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" >
        <label for="pwd">mot de Passe :</label> 
        <input type="password" id="pwd" name="password" >
        <button type="submit" class="mybutton">VALIDER</button>
  </form>

  <script src="script.js"></script>
<?php include 'footer.php'; ?>