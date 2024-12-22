------------------------------------------------------------
-- Insertions into the specialite table
------------------------------------------------------------
INSERT INTO public.specialite (id_specialite, specialite) VALUES
(1, 'Cardiologie'),
(2, 'Dermatologie'),
(3, 'Pédiatrie'),
(4, 'Ophtalmologie');

------------------------------------------------------------
-- Insertions into the medecin table
------------------------------------------------------------
INSERT INTO public.medecin (code_postal, nom, prenom, email, tel, password, id_specialite) VALUES
(75001, 'Dupont', 'Jean', 'jean.dupont@gmail.com', '0601020304', 'password123', 1),
(69002, 'Martin', 'Claire', 'claire.martin@yahoo.fr', '0602030405', 'password456', 2),
(34000, 'Bernard', 'Paul', 'paul.bernard@hotmail.com', '0603040506', 'password789', 3),
(13001, 'Durand', 'Sophie', 'sophie.durand@outlook.com', '0604050607', 'password321', 4);

------------------------------------------------------------
-- Insertions into the planning table
------------------------------------------------------------
INSERT INTO public.planning (debut, fin, dispo, lieu, id_medecin) VALUES
('2024-01-01', '2024-01-07', TRUE, 'Clinique Paris', 1),
('2024-01-08', '2024-01-14', TRUE, 'Hôpital Lyon', 2),
('2024-01-15', '2024-01-21', FALSE, 'Centre Montpellier', 3),
('2024-01-22', '2024-01-28', TRUE, 'Clinique Marseille', 4);

------------------------------------------------------------
-- Insertions into the patient table
------------------------------------------------------------
INSERT INTO public.patient (nom, prenom, email, adresse, tel, date_naissance, password) VALUES
('Leclerc', 'Alice', 'alice.leclerc@gmail.com', '10 Rue de Paris', '0612345678', '1990-05-15', 'alicepass'),
('Petit', 'Louis', 'louis.petit@yahoo.fr', '25 Avenue de Lyon', '0623456789', '1985-10-20', 'louispass'),
('Moreau', 'Julie', 'julie.moreau@hotmail.com', '15 Boulevard Nice', '0634567890', '1995-03-30', 'juliepass'),
('Girard', 'Thomas', 'thomas.girard@outlook.com', '20 Rue de Lille', '0645678901', '2000-07-10', 'thomaspass');

------------------------------------------------------------
-- Insertions into the rdv table
------------------------------------------------------------
INSERT INTO public.rdv (date_rdv, heure_rdv, id_medecin, id_patient) VALUES
('2024-02-01', '10:00:00+01', 1, 1),
('2024-02-02', '11:30:00+01', 2, 2),
('2024-02-03', '14:00:00+01', 3, 3),
('2024-02-04', '16:00:00+01', 4, 4);
