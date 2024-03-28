<<?php include './php/components/header.php' ?>
<?php

require_once '/Applications/MAMP/htdocs/neige_soleil/public/php/modele/modele_reservations.php';

function getModeleResaUser($modele) {
    return $modele->getResaUser($_SESSION['id']);
}

// Connexion à la base de données
$modele = new ModeleReservation();

// Suppression d'une House
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == "delete") {
    $modele->deleteHouse($_GET['id']);
    header('Location: ./gestion_resa.php');
}

// Récupérer c'est Resa
$houses= getModeleResaUser($modele);

// Vérifier si des utilisateurs ont été récupérés
if ($reservations === false) {
    echo "Erreur lors de la récupération des biens.";
    exit;
}

<div class="row align-items-center justify-content-center px-10 mb-5">
  
    if (empty($reservations)) {
        echo "<p>Aucune réservation trouvée.</p>";
    } else {
        foreach ($reservations as $reservation) { ?>
            <div class="col-md-4 mb-4">
              <div class="card overflow-hidden shadow">
                <img class="card-img-top" src="<?php echo $reservation['photoUrl']; ?>" alt="Image du bien" />
                <div class="card-body py-4 px-3">
                  <div class="d-flex flex-column flex-lg-row justify-content-between mb-3">
                    <h4 class="text-secondary fw-medium">
                      <?php echo $reservation['nomBien']; ?>
                    </h4>
                    <span class="fs-1 fw-medium"><?php echo $reservation['prixPaye']; ?> euros</span>
                  </div>
                  <div class="d-flex align-items-center"> 
                    <span class="badge <?php echo $reservation['etat'] == 'Confirmé' ? 'bg-success' : ($reservation['etat'] == 'En attente' ? 'bg-warning' : 'bg-danger'); ?>">
                        <?php echo $reservation['etat']; ?>
                    </span>
                  </div>
                </div>
              </div>
            </div>
        <?php
        }
    }
    ?>
    </div>