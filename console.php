#!/usr/bin/env php
<?php
use Symfony\Component\Console\Output\OutputInterface;

require __DIR__ . '/vendor/autoload.php';

$app = new \Silly\Application;

/**
 * la commande init, permet d'initialiser le prohet en clonant le Core dans le bon dossier et il installe aussi
 * les dépendance du projet
 *
 * @example php console.php init
 */
$app->command('init', function (OutputInterface $output) {

    chdir(__DIR__ . "/src/");
    shell_exec("git clone https://github.com/TuxBoy/Core.git");
    shell_exec("composer install -o");
    $output->writeln("Le projet a été initialié.");

});

/**
 * Cette commande permet de lancer  un serveur de développement
 * @param $port int Le port sur le quel lancer le serveur (par défaut il se lance sur le port 8000)
 *
 * @example php console.php server 8080
 */
$app->command('server [port]', function ($port, OutputInterface $output) {
    $port = $port ? $port : 8000;
    system("php -S localhost:{$port} -t public -d display_errors=1 -d xdebug.remote_enable=1 -d xdebug.remote_autostart=1");
    $output->writeln("Le server écoute sur le port {$port}");
});

$app->run();