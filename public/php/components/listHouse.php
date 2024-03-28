<?php
if (isset($_SESSION['email'])) {
    require_once '/Applications/MAMP/htdocs/neige_soleil/public/php/modele/modele_house.php';
    $localisation = null;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $localisation = $_POST['localisation']; 
    }
    $modele = new ModeleHouse();
    $houses = $modele->getListOfHouse($localisation);
    ?>
    <div class="row align-items-center justify-content-center px-10 mb-5">
    <?php 
    if (empty($houses)) {
        echo "<p>Aucun logement trouvé pour cette localisation.</p>";
    } else {
        foreach ($houses as $house) { ?>
            <div class="col-md-4 mb-4">
              <div class="card overflow-hidden shadow">
                <img class="card-img-top"
                <?php if($house['TypeH'] == "maison"): ?>
                  src="assets/img/logements/Acceuil1.jpg"
                <?php elseif($house['TypeH'] == "chalet"): ?>
                  src="assets/img/logements/acceuil2.jpg.jpg"
                <?php elseif($house['TypeH'] == "appartement"): ?>
                  src="assets/img/logements/acceuil3.jpg.jpg"
                <?php endif; ?> 
                  alt="Image de logement" />
                <div class="card-body py-4 px-3">
                  <div class="d-flex flex-column flex-lg-row justify-content-between mb-3">
                    <h4 class="text-secondary fw-medium">
                      <a class="link-900 text-decoration-none stretched-link" href="house.php?id=<?php echo $house['id']?>">
                        <?php echo $house['Ville']?>
                      </a>
                    </h4>
                    <span class="fs-1 fw-medium"><?php echo $house['PrixHabJ']?> euros/nuit</span>
                  </div>
                  <div class="d-flex align-items-center"> 
                    <img src="assets/img/dest/navigation.svg" style="margin-right: 14px" width="20" alt="navigation" />
                    <span class="fs-0 fw-medium"><?php echo $house['Adresse']?> <?php echo $house['CP']?></span></div>
                </div>
              </div>
            </div>
        <?php
        }
    }
    ?>
    </div>
<?php
}
else {
    echo "Vous n'êtes pas connecté";
}
?>
