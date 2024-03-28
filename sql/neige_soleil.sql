drop database if exists neige_et_soleil;
create database neige_et_soleil;
use neige_et_soleil;

CREATE TABLE User (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(255),
  prenom VARCHAR(255),
  adresse VARCHAR(255),
  CP VARCHAR(255),
  ville VARCHAR(255),
  email VARCHAR(255),
  telephone VARCHAR(255),
  mdp VARCHAR(255),
  role VARCHAR(255) DEFAULT 'user'
);


CREATE TABLE Stations (
  CodeSta INT PRIMARY KEY AUTO_INCREMENT,
  NomSta VARCHAR(255),
  Adresse VARCHAR(255),
  CP VARCHAR(255),
  Ville VARCHAR(255)
);

CREATE TABLE Habitations (
  id INT PRIMARY KEY AUTO_INCREMENT,
  TypeH VARCHAR(255),
  Nom VARCHAR(255),
  Superficie DECIMAL(10, 2),
  Capacite INT,
  Adresse VARCHAR(255),
  CP VARCHAR(255),
  Ville VARCHAR(255),
  PrixHabJ DECIMAL(10, 2),
  EtatHab VARCHAR(255),
  Description VARCHAR(255),
  IdProprio INT NOT NULL,
  CodeSta INT  NOT NULL, 
  FOREIGN KEY (IdProprio) REFERENCES User(id), 
  FOREIGN KEY (CodeSta) REFERENCES Stations(CodeSta)
);

CREATE TABLE Reservations (
  id INT PRIMARY KEY AUTO_INCREMENT,
  DateR DATE,
  DateD DATE,
  DateF DATE,
  NbPers INT,
  Etat VARCHAR(255),
  IdClient INT,
  IdHouse INT,
  FOREIGN KEY (IdClient) REFERENCES User(id),
  FOREIGN KEY (IdHouse) REFERENCES Habitations(id) 
);

CREATE TABLE Contrat (
  NumC INT PRIMARY KEY AUTO_INCREMENT,
  DateCon DATE,
  DateFin DATE,
  EtatCon VARCHAR(255),
  Description TEXT,
  IDR INT NOT NULL, 
  FOREIGN KEY (IDR) REFERENCES Reservations(id)
);
 

INSERT INTO `User` (`id`, `nom`, `prenom`, `adresse`, `CP`, `ville`, `email`, `telephone`, `mdp`, `role`) VALUES
(6, 'proprio', 'proprio', '84 rue du docteur vaillant', '91700', 'Saint-Genevieve-des-Bois', 'proprio@gmail.com', '0619994533', '4f61953bd5c9e113c5359a08f9645b9d289ebe51', 'admin'),
(8, 'CHARLES', 'Fabien', '84 rue du docteur vaillant', '91700', 'Saint-Genevieve-des-Bois', 'fabien2124@gmail.com', '0619994533', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'admin');

INSERT INTO Stations VALUES(null, "Station Alpes", "rue de Lyon", "69800", "Grenoble"); 
INSERT INTO Stations VALUES(null, "Station Massif", "rue de Limoges", "87100", "Brive"); 


INSERT INTO `Habitations` (`id`, `TypeH`, `Nom`, `Superficie`, `Capacite`, `Adresse`, `CP`, `Ville`, `PrixHabJ`, `EtatHab`,`IdProprio`, `CodeSta`) VALUES
(1, 'chalet', 'Villa justine', '200.00', 12, 'huijkdr ', '91200', 'Paris', '200.00', 'Luxe',8, 1),
(2, 'maison', 'chalet nover', '100.00', 8, '84 rurbhb hds', '75008', 'MARSEILLE', '800.00', 'null',8,1),
(3, 'appartement', 'app test 3', '200.00', 10, 'je sais pas ', '09786', 'londres', '1000.00', 'passable',8,2),
(4, 'appartement', 'app test 5', '200.00', 10, 'je sais pas ', '09786', 'londres', '1000.00', 'passable',8,2),
(5, 'maison', 'test', '200.00', 10, 'test', '08768', 'nantes', '700.00', 'null',8,2),
(6, 'chalet', 'test34', '200.00', 10, 'test', '08768', 'nantes', '700.00', 'null',8,2),
(7, 'appartement', 'test34', '200.00', 10, 'test', '08768', 'villejust', '700.00', 'null',8,2),
(8, 'Maison', NULL, '123.00', 123, NULL, '91700', NULL, NULL, NULL,8,1),
(9, 'maison', NULL, '123.00', 123, NULL, '91700', NULL, NULL, NULL,8,1),
(10, 'maison', NULL, '111.00', 11, NULL, '91700', NULL, NULL, NULL,8,1),
(11, 'maison', 'Fabien CHARLES', '111.00', 11, '84 rue du docteur vaillant', '91700', 'Saint-Genevieve-des-Bois', NULL, NULL,8,1),
(12, 'maison', 'Fabien CHARLES', '111.00', 11, '84 rue du docteur vaillant', '91700', 'Saint-Genevieve-des-Bois', '11.00', NULL,8,1),
(13, 'maison', 'Fabien CHARLES', '111.00', 11, '84 rue du docteur vaillant', '91700', 'Saint-Genevieve-des-Bois', '11.00', NULL,8,1);

INSERT INTO Reservations VALUES(1, "2024-01-23", "2024-04-10", "2024-04-20", 5, "attente", 6, 1); 
INSERT INTO Reservations VALUES(2, "2024-01-17", "2024-04-01", "2024-04-09", 5, "refus", 6, 1); 
INSERT INTO Reservations VALUES(3, "2024-01-17", "2024-03-15", "2024-03-29", 5, "valide", 6, 1);