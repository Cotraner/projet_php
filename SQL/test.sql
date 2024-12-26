/*INSERT INTO rdv (id_rdv, date_rdv, heure_rdv, id_medecin, id_patient)
VALUES 
(1, '2023-11-01', '10:00:00', 1, 2),
(2, '2023-11-02', '11:00:00', 2, 2),
(3, '2023-11-03', '12:00:00', 3, 2),
(4, '2023-11-04', '13:00:00', 4, 2),
(5, '2023-11-05', '14:00:00', 1, 2);*/

SELECT heure_rdv, date_rdv ,med.nom FROM rdv rdv INNER JOIN medecin med ON med.id_medecin = rdv.id_medecin WHERE med.id_medecin = 1;