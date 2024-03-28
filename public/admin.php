<?php include './php/components/header.php' ?>
<?php
// Vérifiez si l'utilisateur est un administrateur
if ($_SESSION['role'] != 'admin') {
    echo "Accès refusé.";
    exit;
}

// Inclure le fichier de modèle utilisateur
require_once '\wamp64\www\neige_soleil/public/php/modele/modele_user.php';

// Fonction pour récupérer tous les utilisateurs
function getAllUsers($modele) {
    return $modele->getAllUsers();
}

// Connexion à la base de données
$modele = new Modele();

// Suppression d'un user
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == "delete") {
    $modele->deleteUser($_GET['id']);
    header('Location: ./admin.php');
}

//si on clique sur enresgitrer tu va appeler le modele avec update 
if (isset($_POST['Enregistrer'])){
    $modele->updateUserRole($_POST);
    header('Location: ./admin.php');
}


// Récupérer tous les utilisateurs
$users = getAllUsers($modele);

// Vérifier si des utilisateurs ont été récupérés
if ($users === false) {
    echo "Erreur lors de la récupération des utilisateurs.";
    exit;
}


?>
</head>
<body>
    <div class="container">
        <?php include './php/components/navbar.php' ?>
        <h2 class="mt-9">Liste des Utilisateurs</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['nom']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <td>
                        <?php
                        //suppression  et edition d'un user 
                        if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == "edit") {
                            //afficher formualaire de modification avec les infos de l'utilisateur 
                            //et un bouton enregistrer 
                            ?>
                            <form method="post">
                                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                                <select name="role"> 
                                    <option value="admin">Admin</option>
                                    <option value="admin">Proprio</option>
                                    <option value="user">User</option>
                                </select>
                                <input type ='submit' value ='Enregistrer' name ='Enregistrer'> 
                            </form>
                        <?php
                        }?>
                        <a href="admin.php?action=edit&id=<?php echo $user['id']; ?>" class="btn btn-primary">Modifier</a>
                        <a href="admin.php?action=delete&id=<?php echo $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
