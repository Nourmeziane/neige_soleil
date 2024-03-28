
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-5 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
    <div class="container">
        <a class="navbar-brand" href="index.php"><img src="assets/img/logo-neige-soleil.png" height="34" alt="logo" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
        <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base align-items-lg-center align-items-start">
                <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="sejour.php">Séjour</a></li>
                <!--<li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="Equipement.html">Equipement</a></li>-->
                <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" aria-current="page" href="Apropos.php">A propos</a></li>
                <?php if(!isset($_SESSION['email'])): ?>
                    <li class="nav-item px-3 px-xl-4"><a class="nav-link fw-medium" href="connexion.php">Connexion</a></li>
                    <li class="nav-item px-3 px-xl-4"><a class="btn btn-outline-dark order-1 order-lg-0 fw-medium" href="inscription.php">Inscription</a></li>
                <?php else: 
                   
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="profil.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mon profil
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"): ?>
                            <a class="dropdown-item" href="#">Dashbord</a>
                            <a class="dropdown-item" href="./admin.php">Gerer utilisateur</a>
                        <?php elseif(isset($_SESSION['role']) && $_SESSION['role'] == "user"): ?>
                            <a class="dropdown-item" href="./gerer_resa.php">Gerer réservation</a>
                            <a class="dropdown-item" href="#">Historique réservation</a>
                        <?php elseif(isset($_SESSION['role']) && $_SESSION['role'] == "proprio"): ?>
                            <a class="dropdown-item" href="./gestion_house.php">Gerer Logement</a>
                            <a class="dropdown-item" href="#">Contacter support</a>
                        <?php endif; ?>
                        <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="./modification_profile.php">Modifier profil</a>
                        </div>
                    </li>
                    <li class="nav-item px-3 px-xl-4"><a class="btn btn-outline-dark order-1 order-lg-0 fw-medium" href="./php/functions/deconnexion.php">Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>