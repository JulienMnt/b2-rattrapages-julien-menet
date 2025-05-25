CREATE DATABASE IF NOT EXISTS rattrapages;

CREATE TABLE commandes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    adresse TEXT,
    prix DECIMAL(10, 2),
    statut VARCHAR(255) DEFAULT 'En cours',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)