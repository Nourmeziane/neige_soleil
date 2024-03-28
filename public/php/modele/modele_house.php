<?php

class ModeleHouse {
    private $unPDO;
    public function __construct(){
        try{
            $url="mysql:host=localhost;dbname=neige_et_soleil";
            $user = "root";
            $mdp = "";
            $this->unPDO = new PDO($url, $user, $mdp);
            }
            catch (PDOException $exp){
                echo "Erreur connexion BDD :".$exp->getMessage();
            }      
    }

    public function getListOfHouse($localisation){
        // 6 éléments * 2 page => offset : 12
        // Number of element per page = 6
        // Number total
        // Number of pages -> (numberTotal / number of element per page) arrondis a l'entier supérieur
        // offset => Nombre d'élemnt que tu as déja passé => Page 2 = 6
        //13 => 3 Pages => Prmeier et deuxieme : 6 => Dernier : 1
        if ($localisation != null) {
            $requete = "SELECT * FROM Habitations WHERE Ville = :ville;"; // Chercher les habitations qui ont une localisation particulière
            $select = $this->unPDO->prepare($requete);
            $donnees = array(":ville" => $localisation);
            $select->execute($donnees);
            $res = $select->fetchAll();
        }
        else{
            // TOP 6 => Récupère les 6 prochains élements
            // OFFSET 6 ROWS => Skip les 6 premier éléments
            // $requete = "SELECT TOP 6 * FROM Habitations OFFSET 6 ROWS;";
            $requete = "SELECT * FROM Habitations;"; // Chercher les habitations
            $select = $this->unPDO->prepare($requete);
            $select->execute();
            $res = $select->fetchAll();
        }
        return $res;
    }

    public function getHouse($id){
        $requete = "SELECT * FROM Habitations where id = :id;"; // Chercher les habitations
        $select = $this->unPDO->prepare($requete);
        $donnees = array(":id" => $id);
        $select->execute($donnees);
        $res = $select->fetch();
        return $res;

    }
    public function getStations(){
        $requete = "SELECT * FROM Stations ;";  
        $select = $this->unPDO->prepare($requete);
         
        $select->execute();
        $res = $select->fetchAll();
        return $res;

    }
    public function insertHouse($tab) {
        $requete = "INSERT INTO Habitations (nom, TypeH, adresse, CP, ville, Superficie, Capacite, PrixHabJ, IdProprio, CodeSta ) VALUES (:nom, :TypeH, :adresse, :CP, :ville, :Superficie, :Capacite, :PrixHabJ, :IdProprio, :CodeSta);";
        $select = $this->unPDO->prepare($requete);
        echo $requete ; 
        $donnees = array(
            ":nom" => $tab["nom"],
            ":TypeH" => $tab["typeH"],
            ":adresse" => $tab["adresse"],
            ":CP" => $tab["CP"],
            ":ville" => $tab["ville"],
            ":Superficie" => $tab["superficie"],
            ":Capacite" => $tab["capacite"],
            ":PrixHabJ" => $tab["prixHabJ"],
            ":IdProprio" => $tab["idUser"], 
            ":CodeSta" => $tab["CodeSta"]
        );
        var_dump($donnees);
        $select->execute($donnees);
    }
    public function getHouseUser($idUser){
        $requete = "SELECT * FROM Habitations WHERE IdProprio = :IdProprio;"; // Chercher 
        $select = $this->unPDO->prepare($requete);
        $donnees = array(":IdProprio" => $idUser);
        $select->execute($donnees);
        $res = $select->fetchAll();
        return $res;
    }
    public function deleteHouse($id) {
        // Récupére notre maison
        // $requeteHouse = "SELECT * FROM Habitations WHERE id = :id;"; // Chercher 
        // $select = $this->unPDO->prepare($requeteHouse);
        // $donnees = array(":id" => $id);
        // $select->execute($donnees);
        // $res = $select->fetchAll();
        // // Check si la maison existe OU si l'idUSer n'est pas le notre
        // if($res == null || $res['IdUser'] != $_SESSION['id']){
        //     return '';
        // }
        // Requete pour supprimer
        $requete =  "DELETE FROM Habitations WHERE id = :id";
        $update = $this->unPDO->prepare($requete);
        
        $donnees = array(
            ":id"  => $id
        );
        $success = $update->execute($donnees);
        return $success;
    }

}
?>
