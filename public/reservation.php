<?php include './php/components/header.php'; ?>
</head>
<?php
if (isset ($_GET['id'])) {
    require_once './php/modele/modele_house.php';
    $modeleHouse = new ModeleHouse();
    $house = $modeleHouse->getHouse($_GET['id']);
    if ($house == null) {
        header('Location: ./sejour.php');
        exit;
    }
} else {
    header('Location: ./sejour.php');
    exit;
}
?>
<body>
    <?php include './php/components/navbar.php'; ?>

    <main class="main" id="top">
        <div class="container my-5">
            <!-- Calendrier -->
            <div class="text-center mb-4">
                <h2>Réservation pour <?php echo $house['Nom']; ?></h2>
                <?php include './php/components/calendar.php'; ?>
            </div>

            <!-- Formulaire de réservation -->
            <?php if (isset($_GET['resa'])): ?>
                <div class="card">
                    <div class="card-header">
                        Détails de la réservation
                    </div>
                    <div class="card-body">
                        <form action="./php/functions/reservation.php" method="POST">
                            <!-- Les champs du formulaire ici -->
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include './php/components/footer.php'; ?>
<script>
    function calculatePrice() {
        const startDate = new Date(document.getElementById('DateD').value);
        const endDate = new Date(document.getElementById('DateF').value);
        const diffTime = Math.abs(endDate.getTime() - startDate.getTime());
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        const pricePerDay = parseFloat(document.getElementById('prixj').textContent);
        const totalPrice = diffDays * pricePerDay;
        document.getElementById('price').textContent = totalPrice.toFixed(2);
    }
</script>
</body>

</html>