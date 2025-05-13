# Projet Forum - Formation Développeuse Web

## 📚 Présentation

Ce projet est un **forum web** réalisé dans le cadre de ma formation de développeuse web. Il a pour objectif de mettre en pratique les notions essentielles du développement web, en particulier l’architecture MVC, la gestion d’utilisateurs, l’interaction avec une base de données, et l’utilisation de la **programmation orientée objet (POO)**.

## 🧱 Objectifs pédagogiques

- Comprendre et implémenter l’architecture **MVC**.
- Comprendre et utiliser les classes, notamment les **classes abstraites** en PHP
- Gérer un système d’**inscription/connexion** avec sessions.
- Créer une interface administrateur avec une gestion des contenus, et une visibilité contrôlée des elements.
- Permettre la création, l’affichage et la gestion de **sujets** et **commentaires** dans un forum.
- Appliquer des bonnes pratiques de développement web et respectant les codes.

## ⚙️ Technologies utilisées

- **Langages** : PHP, HTML, CSS, SQL
- **Base de données** : MySQL
- **Organisation du code** : Architecture MVC (Modèle-Vue-Contrôleur)
- **Outils** : VS Code, HeidiSQL, Laragon

## 📁 Structure du projet

/forum
├── /app  # Classe abstraite, outils, sessions...
├── /controller # Gère la logique (héritent d'AbstractController)
├── /model # Gère les reqêtes SQL 
│ ├── /entites
│ ├── /managers
├── /public # Gère ce qui est vu par l'utilisateur
│ ├── /css
│ ├── /img 
│ └── /js 
├── /View # Gère les vues 
│ ├── /admin
│ ├── /forum
│ ├── /security
├── index.php # Point d'entrée du site
└── README.md


## 🔐 Fonctionnalités

- Inscription et connexion des utilisateurs
- Réstriction des vues et des actions selon statut de l'user (visiteur, user, admin)
- Création de nouveaux sujets de discussion et possibilité de le commenter
- Affichage des sujets et messages dans l’ordre anthéchronologique
- Système de modération (suppression, modification ...)
- Affichage des sujets par catégorie

## 🗃 Base de données

> Le mot de passe des utilisateurs est stocké de manière sécurisée (via `password_hash` en PHP).

## 🚧 Statut du projet

TERMINER
