-- Insertion d'exemples de données dans les tables du modèle

-- Table Patient
INSERT INTO public.Patient (id_patient, nom, prenom, email, adresse, tel, date_naissance) VALUES
(1, 'Dupont', 'Jean', 'jean.dupont@example.com', '10 rue des Lilas', '0601020304', '1980-05-15'),
(2, 'Martin', 'Claire', 'claire.martin@example.com', '12 avenue Victor Hugo', '0612345678', '1992-08-20'),
(3, 'Bernard', 'Louis', 'louis.bernard@example.com', '5 impasse des Roses', '0623456789', '1975-03-10');

-- Table compte_patient
INSERT INTO public.compte_patient (id_patient, pwd, email) VALUES
(1, 'password123', 'jean.dupont@example.com'),
(2, 'securepass', 'claire.martin@example.com'),
(3, 'mypassword', 'louis.bernard@example.com');

-- Table specialite
INSERT INTO public.specialite (id_specialite, specialite) VALUES
(1, 'Cardiologie'),
(2, 'Dermatologie'),
(3, 'Pédiatrie');

-- Insertion partielle dans la table Medecin
INSERT INTO public.Medecin (id_medecin, id_specialite, id_user, nom, prenom, email, tel, code_postal, id_medecin_planning) VALUES
(1, 1, 101, 'Durand', 'Michel', 'michel.durand@example.com', '0701234567', '75001', 1),
(2, 2, 102, 'Lefevre', 'Anne', 'anne.lefevre@example.com', '0712345678', '75002', 2),
(3, 3, 103, 'Moreau', 'Pierre', 'pierre.moreau@example.com', '0723456789', '75003', 3);

-- Table compte_medecin
INSERT INTO public.compte_medecin (id_medecin, pwd, email, id_medecin_possede, id_specialite_Medecin) VALUES
(1, 'medpassword1', 'michel.durand@example.com', 1, 1),
(2, 'medpassword2', 'anne.lefevre@example.com', 2, 2),
(3, 'medpassword3', 'pierre.moreau@example.com', 3, 3);

-- Mise à jour de la table Medecin pour compléter id_medecin_compte_medecin
UPDATE public.Medecin SET id_medecin_compte_medecin = 1 WHERE id_medecin = 1;
UPDATE public.Medecin SET id_medecin_compte_medecin = 2 WHERE id_medecin = 2;
UPDATE public.Medecin SET id_medecin_compte_medecin = 3 WHERE id_medecin = 3;

-- Table planning
INSERT INTO public.planning (id_medecin, debut, fin, dispo, id_medecin_est_present, id_specialite_Medecin) VALUES
(1, '2024-01-01', '2024-01-31', TRUE, 1, 1),
(2, '2024-02-01', '2024-02-28', FALSE, 2, 2),
(3, '2024-03-01', '2024-03-31', TRUE, 3, 3);

-- Table rdv
INSERT INTO public.rdv (id_rdv, id_medecin, id_patient, date_rdv, heure_rdv, id_patient_contient, id_medecin_contient, id_specialite_Medecin) VALUES
(1, 1, 1, '2024-01-10', '10:00:00', 1, 1, 1),
(2, 2, 2, '2024-02-15', '14:00:00', 2, 2, 2),
(3, 3, 3, '2024-03-20', '09:30:00', 3, 3, 3);
