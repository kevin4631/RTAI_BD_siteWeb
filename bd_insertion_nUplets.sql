-- Insertion des données dans la table Entreprise
INSERT INTO Entreprise (nomE, siegeSocial, siteWeb, secteur, taille, latitude, longitude) VALUES
('EcoTech', 'Montreal', 'www.ecotech.ca', 'Technologie', 300, 45.5017, -73.5673),
('GreenPower', 'Toronto', 'www.greenpower.com', 'Energie', 800, 43.6532, -79.3832),
('BioGourmet', 'Paris', 'www.biogourmet.fr', 'Alimentation', 150, 48.8566, 2.3522),
('EcoMode', 'Lyon', 'www.ecomode.fr', 'Mode', 250, 45.75, 4.85),
('Solaris', 'Berlin', 'www.solaris.de', 'Energie', 500, 52.5200, 13.4050),
('EcoBuild', 'Marseille', 'www.ecobuild.fr', 'Construction', 200, 43.2965, 5.3698),
('GreenLife', 'New York', 'www.greenlife.com', 'Sante', 400, 40.7128, -74.0060),
('EcoTrans', 'Barcelona', 'www.ecotrans.es', 'Transport', 350, 41.3851, 2.1734);

-- Insertion des données dans la table TypeAction
INSERT INTO TypeAction (idTA, categorie, description) VALUES
(1, 'Énergies Renouvelables', 'Utilisation énergies renouvelables'),
(2, 'Recyclage', 'Mise en place de programmes recyclage'),
(3, 'Éco-conception', 'Conception de produits respectueux'),
(4, 'Collecte', 'Collecte supermarché'),
(5, 'Environement', 'Protection de l\'environement');

-- Insertion des données dans la table ProgrammeFinancement
INSERT INTO ProgrammeFinancement (nomPF, montantMaxAction, procedurePF) VALUES
('GreenInvest', 150000, 'Procédure A'),
('EcoSupport', 100000, 'Procédure B'),
('RenewableFund', 120000, 'Procédure C');

-- Insertion des données dans la table Action
INSERT INTO Action (idA, nomA, anneeA, nbLike, idTA, nomE) VALUES
(1, 'Campagne de Sensibilisation Écologique', 2015, 50, 1, 'EcoTech'),
(2, 'Programme de Bénévolat', 2016, 40, 2, 'EcoTech'),
(3, 'Projet de Reforestation', 2017, 35, 3, 'EcoTech'),
(4, 'Collecte de Déchets Électroniques', 2018, 30, 1, 'GreenPower'),
(5, 'Soutien aux Énergies Renouvelables', 2019, 25, 2, 'GreenPower'),
(6, 'Programme de Recyclage Électronique', 2020, 20, 3, 'GreenPower'),
(7, 'Agriculture Biologique', 2021, 30, 1, 'BioGourmet'),
(8, 'Promotion des Produits Locaux', 2022, 25, 2, 'BioGourmet'),
(9, 'Réduction des Emballages', 2023, 22, 3, 'BioGourmet'),
(10, 'Collection de Vêtements Recyclés', 2015, 28, 1, 'EcoMode'),
(11, 'Promotion de la Mode Éthique', 2016, 24, 2, 'EcoMode'),
(12, 'Ateliers de Couture Durables', 2017, 20, 3, 'EcoMode'),
(13, 'Installation de Stations de Recharge Solaire', 2018, 45, 1, 'Solaris'),
(14, 'Promotion des Véhicules Électriques', 2019, 38, 2, 'Solaris'),
(15, 'Projet de Ferme Solaire', 2020, 32, 3, 'Solaris'),
(16, 'Construction de Bâtiments Écologiques', 2021, 40, 1, 'EcoBuild'),
(17, 'Programme de Recyclage des Matériaux', 2022, 35, 2, 'EcoBuild'),
(18, 'Promotion de l\'Éco-Construction', 2023, 30, 3, 'EcoBuild'),
(19, 'Campagne de Santé Publique', 2015, 60, 1, 'GreenLife'),
(20, 'Programme de Sensibilisation à la Nutrition', 2016, 55, 2, 'GreenLife'),
(21, 'Promotion du Bien-Être Mental', 2017, 50, 3, 'GreenLife'),
(22, 'Expansion du Réseau de Transports Écologiques', 2018, 32, 1, 'EcoTrans'),
(23, 'Promotion des Transports Publics', 2019, 28, 2, 'EcoTrans'),
(24, 'Programme de Covoiturage', 2020, 25, 3, 'EcoTrans');


-- Insertion des données dans la table EvolutionEntreprise
INSERT INTO EvolutionEntreprise (idEE, anneeEE, chiffreAffaire, montantTotalInvestisement, nbRecrutement, quantiteCarbone, nomE) VALUES
(1, 2015, 1500000, 80000, 20, 120, 'EcoTech'),
(2, 2016, 1300000, 70000, 18, 110, 'EcoTech'),
(3, 2017, 1100000, 60000, 15, 100, 'EcoTech'),
(4, 2018, 900000, 50000, 12, 90, 'EcoTech'),
(5, 2019, 800000, 45000, 10, 80, 'EcoTech'),
(6, 2020, 1200000, 70000, 15, 100, 'EcoTech'),
(7, 2021, 1500000, 80000, 18, 120, 'EcoTech'),
(8, 2022, 1800000, 90000, 20, 140, 'EcoTech'),
(9, 2023, 2000000, 100000, 22, 150, 'EcoTech'),

(10, 2015, 2000000, 100000, 25, 150, 'GreenPower'),
(11, 2016, 1800000, 90000, 22, 140, 'GreenPower'),
(12, 2017, 1500000, 80000, 20, 130, 'GreenPower'),
(13, 2018, 1300000, 70000, 18, 120, 'GreenPower'),
(14, 2019, 1200000, 60000, 15, 110, 'GreenPower'),
(15, 2020, 2500000, 120000, 30, 180, 'GreenPower'),
(16, 2021, 3000000, 150000, 35, 200, 'GreenPower'),
(17, 2022, 3500000, 180000, 40, 220, 'GreenPower'),
(18, 2023, 4000000, 200000, 45, 250, 'GreenPower'),

(19, 2015, 800000, 50000, 10, 50, 'BioGourmet'),
(20, 2016, 700000, 45000, 8, 40, 'BioGourmet'),
(21, 2017, 600000, 40000, 6, 30, 'BioGourmet'),
(22, 2018, 500000, 35000, 5, 20, 'BioGourmet'),
(23, 2019, 450000, 30000, 5, 15, 'BioGourmet'),
(24, 2020, 400000, 25000, 4, 10, 'BioGourmet'),
(25, 2021, 450000, 28000, 5, 15, 'BioGourmet'),
(26, 2022, 500000, 30000, 6, 20, 'BioGourmet'),
(27, 2023, 550000, 32000, 7, 25, 'BioGourmet'),

(28, 2015, 1200000, 70000, 18, 80, 'EcoMode'),
(29, 2016, 1000000, 60000, 15, 70, 'EcoMode'),
(30, 2017, 900000, 50000, 12, 60, 'EcoMode'),
(31, 2018, 800000, 45000, 10, 50, 'EcoMode'),
(32, 2019, 750000, 40000, 8, 45, 'EcoMode'),
(33, 2020, 700000, 35000, 7, 40, 'EcoMode'),
(34, 2021, 800000, 40000, 8, 45, 'EcoMode'),
(35, 2022, 900000, 45000, 10, 50, 'EcoMode'),
(36, 2023, 1000000, 50000, 12, 55, 'EcoMode'),

(37, 2015, 2500000, 120000, 30, 120, 'Solaris'),
(38, 2016, 2200000, 100000, 25, 110, 'Solaris'),
(39, 2017, 2000000, 80000, 22, 100, 'Solaris'),
(40, 2018, 1800000, 70000, 20, 90, 'Solaris'),
(41, 2019, 1600000, 60000, 18, 80, 'Solaris'),
(42, 2020, 1800000, 80000, 20, 100, 'Solaris'),
(43, 2021, 2000000, 90000, 22, 110, 'Solaris'),
(44, 2022, 2500000, 120000, 25, 120, 'Solaris'),
(45, 2023, 3000000, 150000, 30, 150, 'Solaris'),

(46, 2015, 1200000, 70000, 18, 80, 'EcoBuild'),
(47, 2016, 1000000, 60000, 15, 70, 'EcoBuild'),
(48, 2017, 900000, 50000, 12, 60, 'EcoBuild'),
(49, 2018, 800000, 45000, 10, 50, 'EcoBuild'),
(50, 2019, 750000, 40000, 8, 45, 'EcoBuild'),
(51, 2020, 700000, 35000, 7, 40, 'EcoBuild'),
(52, 2021, 800000, 40000, 8, 45, 'EcoBuild'),
(53, 2022, 900000, 45000, 10, 50, 'EcoBuild'),
(54, 2023, 1000000, 50000, 12, 55, 'EcoBuild'),

(55, 2015, 3000000, 150000, 30, 150, 'GreenLife'),
(56, 2016, 3500000, 180000, 35, 180, 'GreenLife'),
(57, 2017, 4000000, 200000, 40, 200, 'GreenLife'),
(58, 2018, 4500000, 220000, 45, 220, 'GreenLife'),
(59, 2019, 5000000, 250000, 50, 250, 'GreenLife'),
(60, 2020, 4800000, 230000, 48, 230, 'GreenLife'),
(61, 2021, 5200000, 260000, 52, 260, 'GreenLife'),
(62, 2022, 5500000, 280000, 55, 280, 'GreenLife'),
(63, 2023, 6000000, 300000, 60, 300, 'GreenLife'),

(64, 2015, 2000000, 100000, 25, 120, 'EcoTrans'),
(65, 2016, 2200000, 120000, 30, 140, 'EcoTrans'),
(66, 2017, 2500000, 150000, 35, 160, 'EcoTrans'),
(67, 2018, 2700000, 180000, 40, 180, 'EcoTrans'),
(68, 2019, 3000000, 200000, 45, 200, 'EcoTrans'),
(69, 2020, 2800000, 190000, 42, 190, 'EcoTrans'),
(70, 2021, 3100000, 210000, 47, 210, 'EcoTrans'),
(71, 2022, 3400000, 230000, 50, 230, 'EcoTrans'),
(72, 2023, 3600000, 250000, 55, 250, 'EcoTrans');


-- Insertion des données dans la table Impact
INSERT INTO Impact (nomI) VALUES
('Réduction CO2'),
('Réduction Déchets'),
('Éco-conception');

-- Insertion des données dans la table PeutSoutenir
INSERT INTO PeutSoutenir (nomE, idTA) VALUES
('EcoTech', 1),
('GreenPower', 2),
('BioGourmet', 3),
('Solaris', 1),
('GreenLife', 1),
('EcoTrans', 2);

-- Insertion des données dans la table Eligible
INSERT INTO Eligible (idTA, nomPF) VALUES
(1, 'GreenInvest'),
(2, 'EcoSupport'),
(3, 'RenewableFund');

-- Insertion des données dans la table Generer
INSERT INTO Generer (idTA, nomI) VALUES
(1, 'Réduction CO2'),
(2, 'Réduction Déchets'),
(3, 'Éco-conception');

-- Insertion des données dans la table PeutLabeliser
INSERT INTO PeutLabeliser (nomE, idTA, label) VALUES
('EcoTech', 1, 'ÉcoCertifié'),
('GreenPower', 2, 'GreenLabel'),
('BioGourmet', 3, 'BioCertifié'),
('Solaris', 1, 'ÉnergiePropre'),
('GreenLife', 1, 'VieVerte'),
('EcoTrans', 2, 'TransEco');


-- Insertion des données dans la table Financer
INSERT INTO Financer (nomPF, idA, anneeF, montantF) VALUES
('GreenInvest', 1, 2015, 50000),
('EcoSupport', 5, 2020, 80000),
('RenewableFund', 10, 2015, 60000),
('GreenInvest', 14, 2019, 75000),
('EcoSupport', 18, 2023, 90000),
('RenewableFund', 23, 2019, 55000),
('GreenInvest', 7, 2021, 48000),
('EcoSupport', 11, 2016, 72000),
('RenewableFund', 21, 2017, 58000),
('GreenInvest', 3, 2017, 51000),
('GreenInvest', 18, 2023, 60000),
('EcoSupport', 8, 2022, 50000),
('RenewableFund', 17, 2022, 55000),
('EcoSupport', 16, 2022, 10000);

-- Insertion des données dans la table EstCumulable
INSERT INTO EstCumulable (nomPF, nomPF_1) VALUES
('GreenInvest', 'EcoSupport'),
('EcoSupport', 'RenewableFund');

-- Insertion des données dans la table FaireDemande
INSERT INTO FaireDemande (nomPF, idA) VALUES
('GreenInvest', 1),
('EcoSupport', 2),
('RenewableFund', 5),
('GreenInvest', 6),
('EcoSupport', 8);

-- Insertion des données dans la table Labeliser
INSERT INTO Labeliser (nomE, idA, label) VALUES
('EcoTech', 1, 'ÉcoCertifié'),
('GreenPower', 1, 'GreenLabel'),
('EcoTech', 7, 'ÉcoCertifié'),
('GreenPower', 7, 'GreenLabel'),
('BioGourmet', 3, 'BioCertifié'),
('Solaris', 5, 'ÉnergiePropre'),
('EcoBuild', 6, 'ConstructionÉcologique'),
('BioGourmet', 6, 'BioCertifié'),
('GreenPower', 6, 'GreenLabel'),
('EcoTech', 6, 'ÉcoCertifié');


