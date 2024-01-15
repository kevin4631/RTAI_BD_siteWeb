CREATE TABLE Entreprise(
   nomE VARCHAR(50),
   siegeSocial VARCHAR(50),
   siteWeb VARCHAR(50),
   secteur VARCHAR(50),
   taille INT,
   latitude DECIMAL(9,6),
   longitude DECIMAL(9,6),
   PRIMARY KEY(nomE)
);

CREATE TABLE TypeAction(
   idTA INT,
   categorie VARCHAR(50),
   description VARCHAR(200),
   PRIMARY KEY(idTA)
);

CREATE TABLE ProgrammeFinancement(
   nomPF VARCHAR(50),
   montantMaxAction INT,
   procedurePF VARCHAR(200),
   PRIMARY KEY(nomPF)
);

CREATE TABLE Action(
   idA INT,
   nomA VARCHAR(50),
   anneeA INT,
   nbLike INT,
   idTA INT NOT NULL,
   nomE VARCHAR(50) NOT NULL,
   PRIMARY KEY(idA),
   FOREIGN KEY(idTA) REFERENCES TypeAction(idTA),
   FOREIGN KEY(nomE) REFERENCES Entreprise(nomE)
);

CREATE TABLE EvolutionEntreprise(
   idEE INT,
   anneeEE INT NOT NULL,
   chiffreAffaire INT,
   montantTotalInvestisement INT,
   nbRecrutement INT,
   quantiteCarbone INT,
   nomE VARCHAR(50) NOT NULL,
   PRIMARY KEY(idEE),
   FOREIGN KEY(nomE) REFERENCES Entreprise(nomE)
);

CREATE TABLE Impact(
   nomI VARCHAR(100),
   PRIMARY KEY(nomI)
);

CREATE TABLE PeutSoutenir(
   nomE VARCHAR(50),
   idTA INT,
   PRIMARY KEY(nomE, idTA),
   FOREIGN KEY(nomE) REFERENCES Entreprise(nomE),
   FOREIGN KEY(idTA) REFERENCES TypeAction(idTA)
);

CREATE TABLE Eligible(
   idTA INT,
   nomPF VARCHAR(50),
   PRIMARY KEY(idTA, nomPF),
   FOREIGN KEY(idTA) REFERENCES TypeAction(idTA),
   FOREIGN KEY(nomPF) REFERENCES ProgrammeFinancement(nomPF)
);

CREATE TABLE Labeliser(
   nomE VARCHAR(50),
   idA INT,
   label VARCHAR(50),
   PRIMARY KEY(nomE, idA),
   FOREIGN KEY(nomE) REFERENCES Entreprise(nomE),
   FOREIGN KEY(idA) REFERENCES Action(idA)
);

CREATE TABLE Generer(
   idTA INT,
   nomI VARCHAR(100),
   PRIMARY KEY(idTA, nomI),
   FOREIGN KEY(idTA) REFERENCES TypeAction(idTA),
   FOREIGN KEY(nomI) REFERENCES Impact(nomI)
);

CREATE TABLE PeutLabeliser(
   nomE VARCHAR(50),
   idTA INT,
   label VARCHAR(50),
   PRIMARY KEY(nomE, idTA),
   FOREIGN KEY(nomE) REFERENCES Entreprise(nomE),
   FOREIGN KEY(idTA) REFERENCES TypeAction(idTA)
);

CREATE TABLE Financer(
   nomPF VARCHAR(50),
   idA INT,
   anneeF INT,
   montantF INT,
   PRIMARY KEY(nomPF, idA),
   FOREIGN KEY(nomPF) REFERENCES ProgrammeFinancement(nomPF),
   FOREIGN KEY(idA) REFERENCES Action(idA)
);

CREATE TABLE EstCumulable(
   nomPF VARCHAR(50),
   nomPF_1 VARCHAR(50),
   PRIMARY KEY(nomPF, nomPF_1),
   FOREIGN KEY(nomPF) REFERENCES ProgrammeFinancement(nomPF),
   FOREIGN KEY(nomPF_1) REFERENCES ProgrammeFinancement(nomPF)
);

CREATE TABLE FaireDemande(
   nomPF VARCHAR(50),
   idA INT,
   PRIMARY KEY(nomPF, idA),
   FOREIGN KEY(nomPF) REFERENCES ProgrammeFinancement(nomPF),
   FOREIGN KEY(idA) REFERENCES Action(idA)
);
