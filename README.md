# Projet Doctol'isen

## Description
Le projet "Doctol'isen" est un site web de prise de rendez-vous avec des médecins. 

## Table des matière
1. [Fonctionnalités](#fonctionnalités)
2. [Strucutre du projet](#structure-du-projet)
3. [Installation](#installation)
4. [Utilisation](#utilisation)
5. [Dépendances](#dépendances)
6. [Licence](#licence)
7. [Crédits](#crédits)

## Fonctionnalités
- Connexion et inscription des utilisateurs (patients et médecins)
- Prise de rendez-vous en ligne

## Structure du projet
Le projet est organisé de la manière suivante :
- Les pages utilisées par l'utilisateur sont stockées dans le dossier php
- Les fichiers php inclues dans les pages sont stockées dans le dossier include-php
- Les models de navbar sont stockés dans le dossier html
- Les fichiers de styles sont stockés dans le dossier css

## Installation
1. Clonez le dépôt :
   ```bash
   git clone https://github.com/Cotraner/projet_php)

2. Configurez la base de données PostgreSQL :
- Créez la base de données doctol'isen.
- Exécutez les fichiers SQL dans l'ordre suivant :
    - psql -U postgres -d doctol'isen -f model.sql
    - psql -U postgres -d doctol'isen -f data.sql

3. Configurez les paramètres de connexion à la base de données dans le fichier constants.php.

## Utilisation
1. Lancez un serveur web local
2. Accédez à l'application via votre navigateur à l'adresse http://localhost/proj_php/projet_php/php

## Dépendances
- PHP
- PostgreSQL
- Bootstrap 5

## Licence
Ce produit est strictement sous licence ISEN Nantes.
Toute utilisation inappropriée de ce projet se verra poursuivie en justice.

## Crédits
Ce projet a été réalisé par :
 - Clément Robin
 - Louis Marvillet
