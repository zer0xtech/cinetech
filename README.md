# Catalogue de Films - Projet Symfony

Application web développée avec Symfony permettant de gérer et de consulter un catalogue de films classés par catégories.

## Fonctionnalités

- Affichage de la liste complète des films enregistrés en base de données (ID, titre, catégorie, année de sortie, note de presse, extrait du synopsis et indicateur de favori).
- Consultation de la fiche détaillée d'un film (`/catalogue/{id}`).
- Gestion des entités `Movie` et `Category` via Doctrine ORM (relation `ManyToOne`).
- Point de terminaison API REST basique retournant l'état du service (`/api/catalogue`).

## Prérequis

- PHP 8.2 ou supérieur
- Composer
- Serveur de base de données (MySQL, MariaDB ou PostgreSQL)
- Symfony CLI (recommandé pour le serveur de développement local)

## Installation

1. Cloner le dépôt :
   ```bash
   git clone <url-du-depot>
   cd symfony_course1
   ```

2. Installer les dépendances PHP via Composer :
   ```bash
   composer install
   ```

3. Configurer les variables d'environnement :
   Copier le fichier `.env` vers `.env.local` et renseigner les paramètres de connexion à votre base de données (`DATABASE_URL`) :
   ```env
   DATABASE_URL="mysql://utilisateur:mot_de_passe@127.0.0.1:3306/nom_de_la_base?serverVersion=8.0"
   ```

4. Créer la base de données et exécuter les migrations :
   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

5. Charger les données de test (fixtures), si disponibles :
   ```bash
   php bin/console doctrine:fixtures:load
   ```

## Utilisation

Démarrer le serveur local Symfony :
```bash
symfony server:start
```
Ou avec le serveur interne de PHP :
```bash
php -S 127.0.0.1:8000 -t public
```

L'application est ensuite accessible aux adresses suivantes :
- Catalogue des films : `http://127.0.0.1:8000/catalogue`
- Détail d'un film : `http://127.0.0.1:8000/catalogue/{id}`
- Statut API : `http://127.0.0.1:8000/api/catalogue`

## Structure du projet

- `src/Controller/MovieController.php` : Gestion des routes du catalogue, de l'affichage détaillé et de l'API.
- `src/Entity/Movie.php` : Entité représentant un film (titre, synopsis, date de sortie, note, affiche, slug, catégorie).
- `src/Entity/Category.php` : Entité représentant une catégorie de films.
- `src/Repository/` : Classes d'accès aux données Doctrine.
- `templates/movie/` : Vues Twig (`index.html.twig` et `show.html.twig`).
- `migrations/` : Fichiers de migration de la base de données.