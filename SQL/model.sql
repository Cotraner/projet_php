------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------
------------------------------------------------------------
-- Drop tables if they exist
------------------------------------------------------------
DROP TABLE IF EXISTS public.rdv CASCADE;
DROP TABLE IF EXISTS public.planning CASCADE;
DROP TABLE IF EXISTS public.patient CASCADE;
DROP TABLE IF EXISTS public.medecin CASCADE;
DROP TABLE IF EXISTS public.specialite CASCADE;



------------------------------------------------------------
-- Table: specialite
------------------------------------------------------------
CREATE TABLE public.specialite(
	id_specialite   INT  NOT NULL ,
	specialite      VARCHAR (50) NOT NULL  ,
	CONSTRAINT specialite_PK PRIMARY KEY (id_specialite)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: medecin
------------------------------------------------------------
CREATE TABLE public.medecin(
	id_medecin      SERIAL NOT NULL ,
	code_postal     VARCHAR(10) NOT NULL ,
	nom             VARCHAR (20) NOT NULL ,
	prenom          VARCHAR (20) NOT NULL ,
	email           VARCHAR (50) NOT NULL ,
	tel             CHAR (10)  NOT NULL ,
	password        VARCHAR (50) NOT NULL ,
	id_specialite   INT  NOT NULL  ,
	CONSTRAINT medecin_PK PRIMARY KEY (id_medecin)

	,CONSTRAINT medecin_specialite_FK FOREIGN KEY (id_specialite) REFERENCES public.specialite(id_specialite)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: planning
------------------------------------------------------------
CREATE TABLE public.planning(
	id_planning   SERIAL NOT NULL ,
	debut         DATE  NOT NULL ,
	fin           DATE  NOT NULL ,
	dispo         BOOL  NOT NULL ,
	lieu          VARCHAR (50) NOT NULL ,
	id_medecin    INT  NOT NULL  ,
	CONSTRAINT planning_PK PRIMARY KEY (id_planning)

	,CONSTRAINT planning_medecin_FK FOREIGN KEY (id_medecin) REFERENCES public.medecin(id_medecin)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: patient
------------------------------------------------------------
CREATE TABLE public.patient(
	id_patient       SERIAL NOT NULL ,
	nom              VARCHAR (20) NOT NULL ,
	prenom           VARCHAR (20) NOT NULL ,
	email            VARCHAR (50) NOT NULL ,
	adresse          VARCHAR (50) NOT NULL ,
	tel              CHAR (10)  NOT NULL ,
	date_naissance   DATE  NOT NULL ,
	password         VARCHAR (50) NOT NULL  ,
	CONSTRAINT patient_PK PRIMARY KEY (id_patient)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: rdv
------------------------------------------------------------
CREATE TABLE public.rdv(
	id_rdv       SERIAL NOT NULL ,
	date_rdv     DATE  NOT NULL ,
	heure_rdv    TIMETZ  NOT NULL ,
	id_medecin   INT  NOT NULL ,
	id_patient   INT  ,
	CONSTRAINT rdv_PK PRIMARY KEY (id_rdv)

	,CONSTRAINT rdv_medecin_FK FOREIGN KEY (id_medecin) REFERENCES public.medecin(id_medecin)
	,CONSTRAINT rdv_patient0_FK FOREIGN KEY (id_patient) REFERENCES public.patient(id_patient)
)WITHOUT OIDS;



