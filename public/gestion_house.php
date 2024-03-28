<?php include './php/components/header.php' ?>
<?php
// Inclure le fichier de modèle house
require_once '/Applications/MAMP/htdocs/neige_soleil/public/php/modele/modele_house.php';

// Fonction pour récupérer tous les house Utilisateur
function getModeleHouseUser($modele) {
    return $modele->getHouseUser($_SESSION['id']);
}

// Connexion à la base de données
$modele = new ModeleHouse();

// Suppression d'une House
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == "delete") {
    $modele->deleteHouse($_GET['id']);
    header('Location: ./gestion_house.php');
}

// Récupérer c'est House
$houses= getModeleHouseUser($modele);

// Vérifier si des utilisateurs ont été récupérés
if ($houses === false) {
    echo "Erreur lors de la récupération des biens.";
    exit;
}


?>
</head>
<body>
    <div class="container">
        <?php include './php/components/navbar.php' ?>
        
        <div class="d-flex align-items-center justify-content-between mt-9">
            <h2>Gestions des Biens : <?php echo count($houses) ?></h2>
            <a href="insert_house.php" class="btn btn-success">
                Ajouter un bien
            </a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Ville</th>
                    <th>TypeH</th>
                    <th>Station</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($houses as $house): ?>
                <tr>
                    <td><?php echo htmlspecialchars($house['id']); ?></td>
                    <td><?php echo htmlspecialchars($house['Nom']); ?></td>
                    <td><?php echo htmlspecialchars($house['Ville']); ?></td>
                    <td><?php echo htmlspecialchars($house['TypeH']); ?></td>
                    <td><?php echo htmlspecialchars($house['CodeSta']); ?></td>
                    <td>
                    <a href="#" class="btn btn-info">
                            Reservations
                        </a>    
                    <a href="#" class="btn btn-primary">
                            Modifier
                        </a>
                        <a href="gestion_house.php?action=delete&id=<?php echo $house['id']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>


