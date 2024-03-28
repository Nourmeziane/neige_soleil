<?php include './php/components/header.php'; ?>

</head>
<body>

<?php
if (isset($_GET['id'])) {
    require_once './php/modele/modele_house.php';
    $modele = new ModeleHouse();
    $house = $modele->getHouse($_GET['id']);
    if ($house == null) {
        header('Location: ./index.php');
    }
    
} else {
    header('Location: ./index.php');
}
?>

<main class="main" id="top">
  <?php include './php/components/navbar.php'; ?>
    <section class="container mt-5">
        <div class="row">
            <div class="col-12 mb-4">
                <h1 class="text-center"><?php echo htmlspecialchars($house["Nom"]); ?></h1>
            </div>
            <!-- Détails du bien -->
            <div class="col-md-6">
                <img src=<?php echo $house[""]; ?>class="img-fluid" alt="Image du bien">
            </div>
            <div class="col-md-6">
                <h3>Description</h3>
                <p><?php echo htmlspecialchars($house["Description"]); ?></p>
                <h4>Caractéristiques</h4>
                <ul>
                    <li>Prix: <?php echo htmlspecialchars($house["PrixHabJ"]); ?> €/nuit</li>
                    <li>Surface: <?php echo htmlspecialchars($house["Superficie"]); ?> m²</li>
                    <li>Ville: <?php echo htmlspecialchars($house["Ville"]); ?> </li>
                    <!-- Ajoutez plus de détails selon vos données -->
                </ul>
                
                <a href="./reservation.php?id=<?php echo $house['id']; ?>" class="btn btn-primary">Réserver</a>
            </div>
        </div>
    </section>
</main>

<?php include './php/components/footer.php'; ?>

</body>
</html>
