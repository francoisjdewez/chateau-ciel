CREATE DATABASE chateau_ciel_db charset "utf8mb4";


USE chateau_ciel_db;


CREATE TABLE gammes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);


CREATE TABLE produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    image VARCHAR(255),
    gamme_id INT,
    description TEXT,
    prix DECIMAL(6,2),

    FOREIGN KEY (gamme_id)
        REFERENCES gammes(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);



CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    mail VARCHAR(255) NOT NULL UNIQUE,
    telephone VARCHAR(20) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    date_created DATETIME DEFAULT CURRENT_TIMESTAMP
);
