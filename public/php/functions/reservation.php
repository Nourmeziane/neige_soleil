<?php
session_start();
require_once('../modele/modele_reservations.php');
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $DateR = date('Y-m-d'); 
    $DateD = $_POST['DateD'];
    $DateF = $_POST['DateF']; 
    $NbPers = $_POST['NbPers']; 
    $Etat = 'attente';
    $IdClient = $_SESSION['id']; 
    $IdHouse = $_POST['id']; 
   
    $modele = new ModeleReservation();
    $modele->insertReservations(array(
        "DateR" => $DateR,
        "DateD" => $DateD,
        "DateF" => $DateF,
        "NbPers" => $NbPers,
        "Etat" => $Etat,
        "IdClient" => $IdClient,
        "IdHouse" => $IdHouse,
    ));


    var_dump($modele);
    header('Location: ../../confirmation_resa.php'); 
}
?>
