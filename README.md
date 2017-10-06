## Drazozo commerce

### Configurer l'environement de développement

Il faut cloner le dépôt puis se rendre dans le dossier du pojet :

```bash
$ git clone https://github.com/TuxBoy/carte.git && cd carte/
```
(à mettre à jour le dépôt si on le merge)

```bash
$ composer install -o
```

Vous pouvez utiliser la commande du console.php pour initialiser le projet,
Il suffit de lancer la commande 

```bash
$ php console.php init
```
ça va avoir pour effet de cloner le projet Core dans le bon dossier

Se rendre de nouveau à la racine du projet et démarrer un serveur PHP interne :
Soit avec la commande "make" si vous êtes sous Linux ou que vous l'avez installé sous windows

```bash
$ make server
```
ou

```bash
$ php console.php server
```

Ensuite il suffit de se rendre à l'adresse http://localhost:8000 dans votre navigateur :) .

- Pour faciliter la mise à jour du projet et du Framework, vous pouvez taper la commande : 

```bash
$ php console.php update
```

## Remarques

- Il y a un système de "migration" "implicite" cela veut dire que lorsque vous navigez sur le site, il y a un "Aspect" qui tourne et déclanche le maintainer, c'est le maintainer va mettre à jour les tables en se basant sur les entités définie dans le projet.
Le fait de rajouter des propriétés à vos entité et que vous réactualiez la page, ça va mettre à jour le schema de vos table.

## TODO

[ ] Configuration de webpack 
