-- Insertion de données exemple pour la table Patient
INSERT INTO public.Patient (id_patient, nom, prenom, email, adresse, tel, date_naissance) VALUES
(1, 'Dupont', 'Jean', 'jean.dupont@example.com', '10 rue des Lilas', '0601020304', '1980-05-15'),
(2, 'Martin', 'Claire', 'claire.martin@example.com', '12 avenue Victor Hugo', '0612345678', '1992-08-20'),
(3, 'Bernard', 'Louis', 'louis.bernard@example.com', '5 impasse des Roses', '0623456789', '1975-03-10'),
(4, 'Petit', 'Marie', 'marie.petit@example.com', '20 boulevard Haussmann', '0634567890', '1985-11-30'),
(5, 'Roux', 'Paul', 'paul.roux@example.com', '8 chemin des Vignes', '0645678901', '1990-01-25'),
(6, 'Morel', 'Sophie', 'sophie.morel@example.com', '25 place de la République', '0656789012', '1987-07-14'),
(7, 'Fournier', 'Julien', 'julien.fournier@example.com', '18 rue du Général Leclerc', '0667890123', '1978-12-05'),
(8, 'Girard', 'Camille', 'camille.girard@example.com', '3 allée des Sapins', '0678901234', '1995-06-18'),
(9, 'Lemoine', 'Nicolas', 'nicolas.lemoine@example.com', '7 rue Pasteur', '0689012345', '1982-09-22'),
(10, 'Blanc', 'Isabelle', 'isabelle.blanc@example.com', '15 avenue des Champs', '0690123456', '1993-04-09');

-- Insertion de données exemple pour la table Medecin
INSERT INTO public.Medecin (id_medecin, id_specialite, nom, prenom, email, tel, id_medecin_compte_medecin, id_medecin_planning) VALUES
(1, 1, 'Durand', 'Michel', 'michel.durand@example.com', '0701234567', 1, 1),
(2, 2, 'Lefevre', 'Anne', 'anne.lefevre@example.com', '0712345678', 2, 2),
(3, 3, 'Moreau', 'Pierre', 'pierre.moreau@example.com', '0723456789', 3, 3),
(4, 1, 'Laurent', 'Julie', 'julie.laurent@example.com', '0734567890', 4, 4),
(5, 4, 'Simon', 'Hugo', 'hugo.simon@example.com', '0745678901', 5, 5),
(6, 5, 'Bertrand', 'Alice', 'alice.bertrand@example.com', '0756789012', 6, 6),
(7, 3, 'Martinez', 'Luc', 'luc.martinez@example.com', '0767890123', 7, 7),
(8, 2, 'Thomas', 'Laura', 'laura.thomas@example.com', '0778901234', 8, 8),
(9, 4, 'Robin', 'Alexandre', 'alexandre.robin@example.com', '0789012345', 9, 9),
(10, 5, 'Gauthier', 'Emma', 'emma.gauthier@example.com', '0790123456', 10, 10);

INSERT INTO public.specialite (id_specialite,specialite) VALUES
(1,'generaliste'),
(2,'ophtalmologue'),
(3,'podologue'),
(4,'dentiste'),
(5,'cardiologue');
