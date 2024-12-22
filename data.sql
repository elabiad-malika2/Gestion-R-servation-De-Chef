CREATE DATABASE restaurant;
use restaurant;
drop table user;
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(55),
    email VARCHAR(55),
    password VARCHAR(255),
    role VARCHAR(10) DEFAULT 'user'
);
CREATE TABLE menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(55),
    prix DECIMAL(10,2)
);

CREATE TABLE plat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(55),
    categorie VARCHAR(55)
);
drop table reservation ;
CREATE TABLE reservation (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_reservation DATE,
    heure_reservation timestamp,
    status ENUM("En Attente","Annulée","Confirmée"),
    id_menu INT,
    id_client INT,
    addresse_reservation VARCHAR(255),
    nbr_personnes INT,
    FOREIGN KEY(id_menu) REFERENCES menu(id),
    FOREIGN KEY(id_client) REFERENCES user(id)
);
Create TABLE menuPlat (
    id_menu INT,
    id_plat INT,
    FOREIGN KEY(id_menu) REFERENCES menu(id),
    FOREIGN KEY(id_plat) REFERENCES plat(id)

);

ALTER TABLE plat
ADD COLUMN image varchar(25) NOT NULL;


ALTER TABLE plat MODIFY image VARCHAR(255) NULL;
