# en-ligne.ma

![Version](https://img.shields.io/badge/version-2.0.0-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.2+-4F5B93.svg)
![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20.svg)

## À propos du projet

en-ligne.ma est une plateforme web moderne construite avec le framework Laravel. Cette application permet la publication d'articles et propose divers calculateurs en ligne pour aider les utilisateurs dans leurs prises de décision.

## Fonctionnalités principales

- **Système de gestion d'articles** : Publication, catégorisation et recherche d'articles
- **Calculateurs interactifs** : Outils de calcul pratiques pour les utilisateurs
- **Interface Livewire** : Composants dynamiques et interactifs sans rechargement de page
- **SEO optimisé** : Configuration pour le référencement avec Schema.org et méta-données

## Prérequis

- PHP 8.2 ou supérieur
- Composer
- Node.js et NPM
- Une base de données (SQLite par défaut, mais compatible avec MySQL, PostgreSQL, etc.)

## Installation

1. **Cloner le dépôt**
```
git clone https://github.com/mouadaarab/en-ligne.ma.git
cd en-ligne.ma
```

2. **Installer les dépendances**
```
composer install
npm install
```

3. **Configurer l'environnement**
```
cp .env.example .env
php artisan key:generate
```

4. **Configurer la base de données**
Modifiez le fichier `.env` avec vos informations de connexion à la base de données

5. **Exécuter les migrations et les seeders**
```
php artisan migrate
php artisan db:seed
```

6. **Compiler les assets**
```
npm run dev
```

7. **Démarrer le serveur de développement**
```
php artisan serve
```

Votre application est maintenant accessible à l'adresse `http://localhost:8000`

## Structure du projet

- **app/** - Contient le code principal de l'application
  - **Http/Controllers/** - Contrôleurs de l'application
  - **Livewire/** - Composants Livewire (dont les calculateurs)
  - **Models/** - Modèles de données (Article, User, etc.)
- **database/** - Migrations et seeders pour la base de données
- **resources/** - Vues Blade, fichiers JS et CSS
- **routes/** - Définition des routes de l'application

## Tests

Pour exécuter la suite de tests:

```
php artisan test
```

## Développement

### Commandes utiles

- `php artisan make:controller NomDuController` - Créer un nouveau contrôleur
- `php artisan make:model NomDuModel -m` - Créer un nouveau modèle avec sa migration
- `php artisan make:livewire NomDuComposant` - Créer un nouveau composant Livewire

## Déploiement

Instructions spécifiques pour déployer l'application dans un environnement de production.

## Contribuer

Les contributions sont les bienvenues ! N'hésitez pas à ouvrir une issue ou soumettre une pull request.

## Licence

Ce projet est sous licence [MIT](https://opensource.org/licenses/MIT).

## Auteur

mouad - [Votre Email](mailto:mouad@en-ligne.ma)

---

Fait avec ❤️ et Laravel
