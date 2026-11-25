# Catalogue de Films - Projet Symfony

Catalogue de films en Symfony. Application web de gestion de films par catégories, avec authentification et deux rôles (utilisateur, administrateur) développée avec le framework PHP Symfony, Doctrine ORM, Twig et MySQL.

## Fonctionnalités

- Affichage de la liste complète des films enregistrés en base de données (ID, titre, catégorie, année de sortie, note de presse, extrait du synopsis et indicateur de favori).
- Consultation de la fiche détaillée d'un film (`/catalogue/{id}`).
- Ajout et modification d'un film via un formulaire complet (`/catalogue/nouveau`, `/catalogue/{id}/modifier`).
- Gestion complète (CRUD) des catégories (`/category`).
- Validation des données côté serveur sur l'entité `Movie` (titre obligatoire entre 2 et 255 caractères, durée strictement positive, date de sortie obligatoire, note comprise entre 0 et 5, URL d'affiche valide si renseignée).
- Retour visuel utilisateur via des messages flash lors de la création ou de la modification d'un élément.
- Authentification complète (inscription `/register`, connexion `/login`, déconnexion `/logout`) et gestion des rôles (`ROLE_USER` et `ROLE_ADMIN`).
- Génération de données de test réalistes via Doctrine Fixtures et Faker (5 catégories, 30 films et 2 comptes utilisateurs).
- Gestion des entités `Movie`, `Category` et `Zerox` (Utilisateur) via Doctrine ORM.
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
   DATABASE_URL="mysql://utilisateur:mot_de_passe@127.0.0.1:3306/cinetech?serverVersion=8.0"
   ```

4. Créer la base de données et exécuter les migrations :
   ```bash
   symfony console doctrine:database:create
   symfony console doctrine:migrations:migrate
   ```

5. Charger les données de test (fixtures) :
   ```bash
   symfony console doctrine:fixtures:load -n
   ```

## Comptes de test

Le chargement des fixtures crée automatiquement deux comptes utilisateurs :

| Rôle | Email | Mot de passe |
| :--- | :--- | :--- |
| **Administrateur** (`ROLE_ADMIN`) | `admin@cinetech.fr` | `admin123` |
| **Utilisateur** (`ROLE_USER`) | `user@cinetech.fr` | `user123` |

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
- Ajouter un film : `http://127.0.0.1:8000/catalogue/nouveau`
- Détail d'un film : `http://127.0.0.1:8000/catalogue/{id}`
- Modifier un film : `http://127.0.0.1:8000/catalogue/{id}/modifier`
- Gestion des catégories : `http://127.0.0.1:8000/category`
- Inscription / Connexion : `http://127.0.0.1:8000/register` et `http://127.0.0.1:8000/login`
- Statut API : `http://127.0.0.1:8000/api/catalogue`

## Structure du projet

- `src/Controller/` : Contrôleurs de l'application (`MovieController.php`, `CategoryController.php`, `SecurityController.php`, `RegistrationController.php`).
- `src/Entity/` : Entités Doctrine (`Movie.php`, `Category.php`, `Zerox.php`) et contraintes de validation (`Assert`).
- `src/Form/` : Définition des formulaires Symfony (`MovieType.php`, `CategoryType.php`, `RegistrationFormType.php`).
- `src/DataFixtures/AppFixtures.php` : Génération des données de test (catégories, films et comptes utilisateurs).
- `src/Repository/` : Classes d'accès aux données Doctrine.
- `templates/` : Vues Twig (`movie/`, `category/`, `security/`, `registration/`, `_navbar.html.twig`).
- `config/packages/` : Configuration de Symfony (`security.yaml`, `twig.yaml`).
- `migrations/` : Fichiers de migration de la base de données.
