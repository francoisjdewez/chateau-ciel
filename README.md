# Château Ciel

Une boutique en ligne pour une entreprise fictive de châteaux gonflables, réalisée pendant ma formation.
Le site est écrit en PHP et MySQL, sans framework, pour apprendre les bases d'une application web.

**[Voir le site en ligne](https://chateau-ciel.alwaysdata.net/workshop/index.php)**

## Ce que fait le site

- **Catalogue** : les produits et leurs fiches sont lus dans la base de données.
- **Panier** : ajout, quantités, suppression et total. Le prix est relu en base à chaque affichage.
- **Comptes** : inscription et connexion, avec des mots de passe hachés.
- **Administration** : pages réservées au rôle administrateur.

**Reste à faire** : la commande, le paiement, et l'ajout ou la modification des produits depuis l'administration.

## Technique

- **PHP** sans framework, avec des `include` pour les parties communes des pages
- **MySQL** avec `mysqli`
- **Sessions PHP** pour la connexion et le panier
- **HTML, CSS et JavaScript** écrits à la main

## Organisation du code

```text
*.php             les pages du site
includes/         connexion à la base, session, panier, parties communes des pages
assets/           styles, script et images
sql/              création de la base et données d'exemple
```

## Lancer le projet

Il faut un serveur PHP et MySQL, par exemple [Laragon](https://laragon.org).

1. Placer le dossier dans `C:\laragon\www\`, puis démarrer Laragon.
2. Importer dans MySQL, dans cet ordre : `sql/database.sql`, `sql/insert_gamme.sql`, `sql/insert_products.sql`, `sql/insert_user.sql`.
3. Ouvrir <http://localhost/chateau-ciel> dans le navigateur (adapter selon le nom du dossier).

Les réglages par défaut conviennent à Laragon. Sur un serveur en ligne, copier `includes/config.php.exemple` en `includes/config.php` et y mettre ses identifiants. Ce fichier ne doit jamais être envoyé sur GitHub : `.gitignore` l'exclut.

Les utilisateurs de `sql/insert_user.sql` sont fictifs et leurs mots de passe ne fonctionnent pas : pour se connecter, il faut créer un compte sur le site.

## Droits

Code publié pour être consulté. Tous droits réservés.
