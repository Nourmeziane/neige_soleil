<?php include './php/components/header.php'; 
require_once '/Applications/MAMP/htdocs/neige_soleil/public/php/modele/modele_house.php';
$modele = new ModeleHouse();
$lesStations = $modele->GetStations ();
?>

</head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un bien</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
    <style>
        /* Style pour la prévisualisation des images */
        .img-preview {
            width: 100px;
            height: 100px;
            margin-right: 10px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-start mb-3">
            <a href="gestion_house.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>

        <h2>Créer une annonce</h2>
        <form action="./php/functions/create_house.php" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="TypeH" class="form-label">Type de bien</label>
                    <select class="form-select" id="TypeH" name="TypeH" required>
                        <option value="">Choisir...</option>
                        <option value="Maison">maison</option>
                        <option value="Chalet">chalet</option>
                        <option value="Appartement">appartement</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="Nom" class="form-label">Nom du bien</label>
                    <input type="text" class="form-control" id="Nom" name="Nom" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="Adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="Adresse" name="Adresse">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="Ville" class="form-label">Ville</label>
                    <input type="text" class="form-control" id="Ville" name="Ville">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="CP" class="form-label">Code Postal</label>
                    <input type="text" class="form-control" id="CP" name="CP">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="Station" class="form-label">Station</label>
                    <select class="form-select" id="CodeSta" name="CodeSta" required>
                       <?php 
                        foreach($lesStations as $uneStation){
                            echo '<option value="'.$uneStation['CodeSta'].'">'.$uneStation['NomSta'].' </option>'; 
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="Superficie" class="form-label">Superficie (m²)</label>
                    <input type="number" class="form-control" id="Superficie" name="Superficie" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="Capacite" class="form-label">Nombre de Voyageur</label>
                    <select class="form-select" id="Capacite" name="Capacite" required>
                        <option value="">Choisir...</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="PrixHabJ" class="form-label">Prix par jour</label>
                    <input type="text" class="form-control" id="PrixHabJ" name="PrixHabJ" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="Photos" class="form-label">Photos du bien</label>
                <input type="file" class="form-control" id="Photos" name="Photos[]" multiple onchange="previewImages()">
                <div id="preview" class="d-flex mt-2"></div> <!-- Zone de prévisualisation -->
            </div>

            <button type="submit" class="btn btn-primary">Créer l'annonce</button>
        </form>
    </div>
</body>