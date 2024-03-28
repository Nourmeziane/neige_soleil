<?php

class Modele {
    private $unPDO;
    
    public function __construct(){
        $this->connect();
    }
    
    private function connect() {
        try {
            $url="mysql:host=localhost;dbname=neige_et_soleil";
            $user = "root";
            $mdp = "";
            $this->unPDO = new PDO($url, $user, $mdp);
        } catch (PDOException $exp){
            echo "Erreur connexion BDD :".$exp->getMessage();
        }
    }

    public function insertUser($tab) {
        $requete = "INSERT INTO user (nom, prenom, adresse, CP, ville, email, telephone, mdp) VALUES (:nom, :prenom, :adresse, :CP, :ville, :email, :telephone, :mdp);";
        $select = $this->unPDO->prepare($requete);
        $donnees = array(
            ":nom" => $tab["nom"],
            ":prenom" => $tab["prenom"],
            ":adresse" => $tab["adresse"],
            ":CP" => $tab["CP"],
            ":ville" => $tab["ville"],
            ":email" => $tab["email"],
            ":telephone" => $tab["telephone"],
            ":mdp" => sha1($tab["mdp"]) 
        );

        $select->execute($donnees);
    }

    public function connectUser($tab){
        $requete = "SELECT * FROM User WHERE email = :email and mdp = :mdp;";
        $select = $this->unPDO->prepare($requete);
        $donnees = array(":email" => $tab["email"], ":mdp" => $tab["mdp"]);
        $select->execute($donnees);

        $res= $select->fetch();
         
        return $res;
    }
    
    public function getUser($email){
        $requete = "SELECT * FROM User WHERE email = :email;";
        $select = $this->unPDO->prepare($requete);
        $donnees = array(":email" => $email);
        $select->execute($donnees);

        $res= $select->fetch();
         
        return $res;
    }

    public function getUserId($idUtilisateur){
        $requete = "SELECT * FROM User WHERE id = :id;";
        $select = $this->unPDO->prepare($requete);
        $donnees = array(":id" => $idUtilisateur);
        $select->execute($donnees);

        $res= $select->fetch();
         
        return $res;
    }

    public function getAllUsers() {
        $requete = "SELECT * FROM user";
        $select = $this->unPDO->query($requete);
        return $select->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUser($tab) {
        $requete = "UPDATE user SET adresse = :adresse, CP = :CP, ville = :ville, telephone = :telephone";
        if ($tab["mdp"] != null) {
            $requete = $requete.", mdp = :mdp where id = :id;";
        }
        else{
            $requete = $requete." where id = :id;";
        }
        $update = $this->unPDO->prepare($requete);
        $hashedMdp = sha1($tab["mdp"]);
        $donnees = array(
            ":id"  => $tab["id"],
            ":adresse" => $tab["adresse"],
            ":CP" => $tab["CP"],
            ":ville" => $tab["ville"],
            ":telephone" => $tab["telephone"],
        );
        if ($tab["mdp"] != null) {
            $donnees[":mdp"] = $hashedMdp;
        }
        $success = $update->execute($donnees);
        return $success;
    }

    public function updateUserRole($tab) {
        $requete = "UPDATE user SET   role = :role where id = :id;";
        $update = $this->unPDO->prepare($requete);
         
        $donnees = array(
            ":id"  => $tab["id"],
            
            ":role" => $tab["role"]
        );
        $success = $update->execute($donnees);
        return $success;
    }

    public function deleteUser($id) {
        $requete =  "DELETE FROM user WHERE id = :id";
        $update = $this->unPDO->prepare($requete);
        
        $donnees = array(
            ":id"  => $id
        );
        $success = $update->execute($donnees);
        return $success;
    }
}

?>
