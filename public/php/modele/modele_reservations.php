<?php

class ModeleReservation {
    private $unPDO;
    public function __construct(){
        try{
<<<<<<< HEAD
            $url="mysql:host=localhost;dbname=neige_et_soleil";
            $user = "root";
            $mdp = "";
=======
            $url="mysql:host=localhost;port=8889;dbname=neige_et_soleil";
            $user = "root";
            $mdp = "";
>>>>>>> 7ea7b9ef51947bf4cf14ba0a5fb19deb463c2135
            $this->unPDO = new PDO($url, $user, $mdp);
            }
            catch (PDOException $exp){
                echo "Erreur connexion BDD :".$exp->getMessage();
            }      
    }

    
    public function getReservations($idHouse){
        $requete = "SELECT * FROM Reservations where IdHouse = :IdHouse;"; 
        $select = $this->unPDO->prepare($requete);
        $donnees = array(":IdHouse" => $idHouse);
        $select->execute($donnees);
        $res = $select->fetchAll();
        return $res;

    }
    public function insertReservations($tab) {
        $requete = "INSERT INTO Reservations (DateR, DateD, DateF, NbPers, Etat, IdClient, IdHouse) VALUES (:DateR, :DateD, :DateF, :NbPers, :Etat, :IdClient, :IdHouse);";
        $select = $this->unPDO->prepare($requete);
        echo $requete ; 
        $donnees = array(
            ":DateR" => $tab["DateR"],
            ":DateD" => $tab["DateD"],
            ":DateF" => $tab["DateF"],
            ":NbPers" => $tab["NbPers"],
            ":Etat" => $tab["Etat"],
            ":IdClient" => $tab["IdClient"], 
            ":IdHouse" => $tab["IdHouse"]

        );
        var_dump($donnees);
        $select->execute($donnees);
    }
    public function getResaUser($idUser){
        $requete = "SELECT * FROM Reservation WHERE IdClient = :IdClient;"; // Chercher 
        $select = $this->unPDO->prepare($requete);
        $donnees = array(":IdClient" => $idUser);
        $select->execute($donnees);
        $res = $select->fetchAll();
        return $res;
    }
    public function deleteResa($id) {

        $requete =  "DELETE FROM Reservations WHERE id = :id";
        $update = $this->unPDO->prepare($requete);
        $donnees = array(
            ":id"  => $id
        );
        $success = $update->execute($donnees);
        return $success;
    }
    function getResa($idHouse, $month, $year) {
        // Convertit le mois et l'année en dates de début et de fin de mois
        $startDate = "$year-$month-01";
        $endDate = date("Y-m-t", strtotime($startDate));
    
        // Prépare et exécute la requête SQL
        $sql = "SELECT * FROM reservations WHERE IdHouse = :idHouse AND (DateD <= :endDate AND DateF >= :startDate)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['idHouse' => $idHouse, 'startDate' => $startDate, 'endDate' => $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
