------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------

-- Suppression des tables si elles existent
DROP TABLE IF EXISTS public.rdv CASCADE;
DROP TABLE IF EXISTS public.compte_medecin CASCADE;
DROP TABLE IF EXISTS public.planning CASCADE;
DROP TABLE IF EXISTS public.specialiser CASCADE;
DROP TABLE IF EXISTS public.Medecin CASCADE;
DROP TABLE IF EXISTS public.specialite CASCADE;
DROP TABLE IF EXISTS public.compte_patient CASCADE;
DROP TABLE IF EXISTS public.Patient CASCADE;

-- Toutes les tables sont supprimées.



------------------------------------------------------------
-- Table: Patient
------------------------------------------------------------
CREATE TABLE public.Patient(
	id_patient       INT  NOT NULL ,
	nom              VARCHAR (20) NOT NULL ,
	prenom           VARCHAR (20) NOT NULL ,
	email            VARCHAR (40) NOT NULL ,
	adresse          VARCHAR (40) NOT NULL ,
	tel              CHAR (10)  NOT NULL ,
	date_naissance   DATE  NOT NULL  ,
	CONSTRAINT Patient_PK PRIMARY KEY (id_patient)
)WITHOUT OIDS;



------------------------------------------------------------
-- Table: compte_patient
------------------------------------------------------------
CREATE TABLE public.compte_patient(
	id_patient   SERIAL NOT NULL ,
	pwd          VARCHAR (20) NOT NULL ,
	email        VARCHAR (40) NOT NULL  ,
	CONSTRAINT compte_patient_PK PRIMARY KEY (id_patient)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: Medecin
------------------------------------------------------------
CREATE TABLE public.Medecin(
	id_medecin                  INT  NOT NULL ,
	id_specialite               INT  NOT NULL ,
	id_user                     INT  NOT NULL ,
	code_postal                 INT  NOT NULL ,
	nom                         VARCHAR (20) NOT NULL ,
	prenom                      VARCHAR (20) NOT NULL ,
	email                       VARCHAR (40) NOT NULL ,
	tel                         CHAR (10)  NOT NULL ,
	id_medecin_compte_medecin   INT NULL ,
	id_medecin_planning         INT NULL  ,
	CONSTRAINT Medecin_PK PRIMARY KEY (id_medecin,id_specialite)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: specialite
------------------------------------------------------------
CREATE TABLE public.specialite(
	id_specialite   INT  NOT NULL ,
	specialite      VARCHAR (20) NOT NULL  ,
	CONSTRAINT specialite_PK PRIMARY KEY (id_specialite)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: rdv
------------------------------------------------------------
CREATE TABLE public.rdv(
	id_rdv                  SERIAL NOT NULL ,
	id_medecin              INT  NOT NULL ,
	id_patient              INT  NOT NULL ,
	date_rdv                DATE  NOT NULL ,
	heure_rdv               TIMETZ  NOT NULL ,
	id_patient_contient     INT  NOT NULL ,
	id_medecin_contient     INT  NOT NULL ,
	id_specialite_Medecin   INT  NOT NULL  ,
	CONSTRAINT rdv_PK PRIMARY KEY (id_rdv)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: compte m�decin
------------------------------------------------------------
CREATE TABLE public.compte_medecin(
	id_medecin              SERIAL NOT NULL ,
	pwd                     VARCHAR (20) NOT NULL ,
	email                   VARCHAR (40) NOT NULL ,
	id_medecin_possede      INT NOT NULL ,
	id_specialite_Medecin   INT NOT NULL  ,
	CONSTRAINT compte_medecin_PK PRIMARY KEY (id_medecin)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: planning
------------------------------------------------------------
CREATE TABLE public.planning(
	id_medecin               INT  NOT NULL ,
	debut                    DATE  NOT NULL ,
	fin                      DATE  NOT NULL ,
	dispo                    BOOL  NOT NULL ,
	id_medecin_est_present   INT  NOT NULL ,
	id_specialite_Medecin    INT  NOT NULL  ,
	CONSTRAINT planning_PK PRIMARY KEY (id_medecin)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: specialiser
------------------------------------------------------------
CREATE TABLE public.specialiser(
	id_specialite           INT  NOT NULL ,
	id_medecin              INT  NOT NULL ,
	id_specialite_Medecin   INT  NOT NULL  ,
	CONSTRAINT specialiser_PK PRIMARY KEY (id_specialite,id_medecin,id_specialite_Medecin)
)WITHOUT OIDS;




ALTER TABLE public.Medecin
	ADD CONSTRAINT Medecin_compte_medecin0_FK
	FOREIGN KEY (id_medecin_compte_medecin)
	REFERENCES public.compte_medecin(id_medecin);

ALTER TABLE public.Medecin
	ADD CONSTRAINT Medecin_planning1_FK
	FOREIGN KEY (id_medecin_planning)
	REFERENCES public.planning(id_medecin);

ALTER TABLE public.Medecin 
	ADD CONSTRAINT Medecin_compte_medecin0_AK 
	UNIQUE (id_medecin_compte_medecin);

ALTER TABLE public.Medecin 
	ADD CONSTRAINT Medecin_planning1_AK 
	UNIQUE (id_medecin_planning);

ALTER TABLE public.rdv
	ADD CONSTRAINT rdv_Patient0_FK
	FOREIGN KEY (id_patient_contient)
	REFERENCES public.Patient(id_patient);

ALTER TABLE public.rdv
	ADD CONSTRAINT rdv_Medecin1_FK
	FOREIGN KEY (id_medecin_contient,id_specialite_Medecin)
	REFERENCES public.Medecin(id_medecin,id_specialite);

ALTER TABLE public.compte_medecin
	ADD CONSTRAINT compte_medecin_Medecin0_FK
	FOREIGN KEY (id_medecin_possede,id_specialite_Medecin)
	REFERENCES public.Medecin(id_medecin,id_specialite);

ALTER TABLE public.compte_medecin 
	ADD CONSTRAINT compte_medecin_Medecin0_AK 
	UNIQUE (id_medecin_possede,id_specialite_Medecin);

ALTER TABLE public.planning
	ADD CONSTRAINT planning_Medecin0_FK
	FOREIGN KEY (id_medecin_est_present,id_specialite_Medecin)
	REFERENCES public.Medecin(id_medecin,id_specialite);

ALTER TABLE public.planning 
	ADD CONSTRAINT planning_Medecin0_AK 
	UNIQUE (id_medecin_est_present,id_specialite_Medecin);

ALTER TABLE public.specialiser
	ADD CONSTRAINT specialiser_specialite0_FK
	FOREIGN KEY (id_specialite)
	REFERENCES public.specialite(id_specialite);

ALTER TABLE public.specialiser
	ADD CONSTRAINT specialiser_Medecin1_FK
	FOREIGN KEY (id_medecin,id_specialite_Medecin)
	REFERENCES public.Medecin(id_medecin,id_specialite);