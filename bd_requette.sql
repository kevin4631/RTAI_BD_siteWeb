/* 
Lot 1 : Sensibilisation des entreprises aux initiatives écologiques par secteur 
*/

/* F1. Créer un formulaire/vue qui affiche les entreprises d'un secteur donné et leurs actions */
-- Kevin
SELECT E.nomE, A.nomA, A.anneeA, A.nbLike
FROM Entreprise E, Action A
WHERE E.nomE = A.nomE
AND E.secteur = 'Énergie'
ORDER BY E.nomE ASC, A.anneeA ASC;

/* R1. Informations sur l'évolution dans le temps des entreprises d'un secteur donné. */
-- Kevin
SELECT EE.nomE, EE.anneeEE, EE.chiffreAffaire, EE.montantTotalInvestisement, EE.nbRecrutement, EE.quantiteCarbone
FROM EvolutionEntreprise EE, Entreprise E
WHERE EE.nomE = E.nomE
AND E.secteur = 'Énergie'
ORDER BY EE.nomE ASC, EE.anneeEE DESC;

/* R2. Nombre d'actions subventionnées et montant total des subventions reçues par secteur. 
    Limité aux secteurs ayant reçu plus de X subventions et tri selon le montant.
    Donnez également une représentation graphique de la réponse. */
-- Kevin
SELECT E.secteur, COUNT(A.idA) nbAction, SUM(F.montantF) montantTotal
FROM Financer F, Action A, Entreprise E
WHERE F.idA = A.idA
AND A.nomE = E.nomE
GROUP BY E.secteur
HAVING COUNT(A.idA) >= 0
ORDER BY montantTotal DESC;

/* R3. Pour chaque type d'action, affichez les entreprises qui peuvent aider à sa réalisation. */
-- Bouziane 

SELECT TA.categorie AS TypeAction, E.nomE AS Entreprise
FROM TypeAction TA
JOIN PeutSoutenir PS ON TA.idTA = PS.idTA
JOIN Entreprise E ON PS.nomE = E.nomE;


/* R4. Nombre d'entreprises par localisation. Donnez une carte du monde 
    (importez les données en excel..., cherchez un tutoriel à ce sujet). */
-- Bouziane 
SELECT siegeSocial AS Localisation, COUNT(*) AS NombreEntreprises
FROM Entreprise
GROUP BY siegeSocial;

/*
Lot 2 : Analyse de la réputation et de l'évolution des entreprises
*/

/* R5. Entreprises par ordre décroissant du nombre total de likes qu'elles ont obtenu pour leurs actions. */
-- Bouziane 
SELECT E.nomE AS Entreprise, A.nomA AS Action, SUM(A.nbLike) AS TotalLikes
FROM Entreprise E
JOIN Action A ON E.nomE = A.nomE
GROUP BY E.nomE, A.nomA
ORDER BY E.nomE ASC, TotalLikes DESC;


/* R6. L'entreprise qui a obtenu le plus grand nombre d'actions certifiées. */
-- Kevin
SELECT nomE, COUNT(idA) AS nbActionL
FROM(
	SELECT A.nomE, L.idA
	FROM Action A, Labeliser L
	WHERE A.IdA = L.IdA
	GROUP BY L.idA) AS tab
GROUP BY nomE
HAVING COUNT(idA) = (
	SELECT MAX(nbAL)
	FROM(
		SELECT COUNT(idA) AS nbAL
		FROM(
			SELECT A.nomE, L.idA
			FROM Action A, Labeliser L
			WHERE A.IdA = L.IdA
			GROUP BY L.idA) AS tab
		GROUP BY nomE ) AS tab);

-- entreprise qui a obtenu l'action la plus certifié
SELECT A.nomE, A.nomA, COUNT(L.idA) AS nbL
FROM Action A, Labeliser L
WHERE A.IdA = L.IdA
GROUP BY L.idA
HAVING COUNT(L.idA) = (
	SELECT MAX(nbL)
	FROM(
		SELECT COUNT(L.idA) AS nbL	
		FROM Labeliser L
		GROUP BY L.idA) AS tab);

-- entreprise qui a obtenu le plus grand nombre de certification
SELECT A.nomE, COUNT(L.idA) AS certification
FROM Action A, Labeliser L
WHERE A.IdA = L.IdA
GROUP BY A.nomE
HAVING COUNT(L.idA) = (
	SELECT MAX(maxL)
    FROM(
    	SELECT COUNT(L.idA) AS maxL
    	FROM Action A, Labeliser L
    	WHERE A.IdA = L.IdA
	GROUP BY A.nomE) AS tab);


/* R7. Les entreprises qui proposent de l'aide et qui fournissent également des certifications. */
-- Bouziane 
SELECT PS.nomE AS Entreprise, PS.idTA AS TypeAction, PL.label AS Certification
FROM PeutSoutenir PS
INNER JOIN PeutLabeliser PL ON PS.nomE = PL.nomE AND PS.idTA = PL.idTA;

/* R7. Les entreprises dont la situation écologique s'est améliorée entre deux années données : la quantité d'émissions de carbone diminue. */
-- Kevin
SELECT Ev1.nomE, Ev1.quantiteCarbone, Ev2.quantiteCarbone
FROM EvolutionEntreprise Ev1, EvolutionEntreprise Ev2
WHERE Ev1.anneeEE = 2022
AND Ev2.anneeEE = 2023
AND Ev1.nomE = Ev2.nomE
AND Ev1.quantiteCarbone > Ev2.quantiteCarbone;

/* R8. Évolution de l'investissement d'une entreprise donnée par an : nombre de
    recrutements, pourcentage d'investissement vert par rapport au montant du chiffre
    d'affaires. Donnez également une représentation graphique. */
-- Bouziane 

SELECT
    anneeEE AS Annee,
    chiffreAffaire AS ChiffreAffaire,
    montantTotalInvestisement AS MontantInvestissement,
    nbRecrutement AS NombreRecrutements,
    IF(
        chiffreAffaire > 0,
        ( montantTotalInvestisement / chiffreAffaire) * 100,0
    ) AS PourcentageInvestissementVert
    FROM
    EvolutionEntreprise
    WHERE
    nomE = 'EcoTech'
    ORDER BY
    anneeEE;
/*
Lot 3 : Analyse des programmes de financement
*/

/* F2. Formulaire/vue qui affiche pour chaque programme de financement le type d'actions qu'il peut financer. */
-- Bouziane 
SELECT
    PF.nomPF AS ProgrammeFinancement,
    TA.categorie AS TypeAction
FROM
    ProgrammeFinancement PF
JOIN
    Eligible E ON PF.nomPF = E.nomPF
JOIN
    TypeAction TA ON E.idTA = TA.idTA;

/* R9. Montant moyen, maximum et minimum des subventions et nombre de subventions attribuées par chaque programme de financement. */
-- Bouziane 
SELECT
  PF.nomPF AS ProgrammeFinancement,
  AVG(F.montantF) AS MontantMoyen,
  MAX(F.montantF) AS MontantMaximum,
  MIN(F.montantF) AS MontantMinimum,
  COUNT(F.idA) AS NombreSubventionsAttribuees
FROM
  ProgrammeFinancement PF
JOIN
  Financer F ON PF.nomPF = F.nomPF
GROUP BY
  PF.nomPF;

/* R10. Types d'actions sans programme de financement. */
-- Kevin
SELECT categorie
FROM TypeAction
WHERE idTA NOT IN(
    SELECT idTA
    FROM Eligible);

-- nb de TypeAction
SELECT COUNT(*) AS nbTA FROM TypeAction;
-- nombre de TypeAction  sans programme de financement
SELECT (SELECT COUNT(*) 
		FROM TypeAction) - COUNT(DISTINCT idTA) AS TypeAsansF
FROM Eligible;

/* R11. Évolution par année du montant total reçu par les actions subventionnées. Dessinez également un graphique. */
-- Kevin
SELECT F.anneeF, SUM(F.montantF) AS montantTotal
FROM Financer F
GROUP BY F.anneeF;

/* R12. Pourcentage d'actions qui ont été financées. */
-- Kevin
SELECT (SELECT COUNT(DISTINCT idA) 
	FROM Financer) * 100.0 / COUNT(idA) AS prActionsFinancees
FROM Action;

-- toutes les actions
SELECT COUNT(*) AS nbActions FROM Action;
-- actions fincancées
SELECT COUNT(DISTINCT idA) AS nbActionF FROM Financer;


    
    
