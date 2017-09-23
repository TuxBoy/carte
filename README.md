## Drazozo commerce

### Configurer l'environement de développement

Il faut cloner le dépôt puis se rendre dans le dossier du pojet :

```bash
$ git clone https://github.com/TuxBoy/carte.git && cd carte/
```

(à mettre à jour le dépôt si on le merge)

Vous pouvez utiliser la commande du console.php pour initialiser le projet,
Il suffit de lancer la commande 

```bash
$ php console.php init
```
ça va avoir pour effet de faire toutes les étapes ci dessous automatiquement.

```bash
$ composer install -o
```

Maintenant il faut le Core du Framework qui est dans un dépôt à part afin de mieux gérer l'évolution.
Pour le récupérer, il faut le cloner dans le dossier src/ :

```bash
git clone https://github.com/TuxBoy/Core.git
```

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
