
-- Insertion des données dans la table compte_patient
INSERT INTO public.compte_patient (id_compte_patient, id_patient, nom_utilisateur, mot_de_passe) VALUES
(1, 1, 'jdupont', 'password123'),
(2, 2, 'mmartin', 'password456');

-- Insertion des données dans la table Patient
INSERT INTO public.Patient (id_patient, nom, prenom, email, adresse, tel, date_naissance) VALUES
(1, 'Dupont', 'Jean', 'jean.dupont@example.com', '123 Rue de Paris', '0123456789', '1980-01-01'),
(2, 'Martin', 'Marie', 'marie.martin@example.com', '456 Avenue de Lyon', '0987654321', '1990-02-02');
