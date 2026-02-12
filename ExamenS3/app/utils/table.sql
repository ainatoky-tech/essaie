DROP DATABASE IF EXISTS commerce;
CREATE DATABASE commerce;
USE commerce;

CREATE TABLE commerce_categorie(
    categorie_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE commerce_utilisateur(
    utilisateur_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    MDP VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
);

CREATE TABLE commerce_produit(
    produit_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    photo VARCHAR(255) NOT NULL,
    descriptions TEXT DEFAULT NULL,
    estimation DECIMAL(10,2) NOT NULL,
    categorie_id INT NOT NULL,
    proprietaire_id INT NOT NULL,
    FOREIGN KEY (categorie_id) REFERENCES commerce_categorie(categorie_id),
    FOREIGN KEY (proprietaire_id) REFERENCES commerce_utilisateur(utilisateur_id)
);

CREATE TABLE commerce_echange(
    echange_id INT AUTO_INCREMENT PRIMARY KEY,
    demandeur_id INT,
    recepteur_id INT,
    produit1_id INT,
    produit2_id INT,
    date_echange DATETIME DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('en_attente', 'accepte', 'refuse') DEFAULT 'en_attente',
    FOREIGN KEY (produit1_id) REFERENCES commerce_produit(produit_id),
    FOREIGN KEY (produit2_id) REFERENCES commerce_produit(produit_id),
    FOREIGN KEY (demandeur_id) REFERENCES commerce_utilisateur(utilisateur_id),
    FOREIGN KEY (recepteur_id) REFERENCES commerce_utilisateur(utilisateur_id)
);

CREATE TABLE commerce_historique(
    historique_id INT AUTO_INCREMENT PRIMARY KEY,
    produit_id INT,
    utilisateur_id INT,
    date_historique DATETIME DEFAULT CURRENT_TIMESTAMP,
    action ENUM('propose', 'accepte', 'refuse') DEFAULT 'propose',
    FOREIGN KEY (produit_id) REFERENCES commerce_produit(produit_id),
    FOREIGN KEY (utilisateur_id) REFERENCES commerce_utilisateur(utilisateur_id)
);


/*Donné par défaut pour l'admin*/
INSERT INTO commerce_utilisateur (nom,email,MDP,role) VALUES ('admin','admin@commerce.com','admin123','admin');


SELECT e.*,p1.nom as nom_produit_demande,p2.nom as nom_produit_propose,u.nom_utilisateur as nom_demandeur FROM commerce_echange e JOIN commerce_produit p1 ON e.produit1_id = p1.produit_id JOIN commerce_produit p2 ON e.produit2_id = p2.produit_id JOIN commerce_utilisateur u ON e.demandeur_id = u.utilisateur_id WHERE e.recepteur_id = ? AND e.statut = 'en_attente';