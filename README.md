## Drazozo commerce

### Configurer l'environement de développement

Il faut cloner le dépôt :

```bash
$ git clone https://github.com/TuxBoy/carte.git && cd carte/
```

(à mettre à jour le dépôt si on le merge)

```bash
$ composer install
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
$ php -S localhost:8000 -t public -d display_errors=1 -d xdebug.remote_enable=1 -d xdebug.remote_autostart=1
```

Ensuite il suffit de se rendre à l'adresse http://localhost:8000 dans votre navigateur :) .
