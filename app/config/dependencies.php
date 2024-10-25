<?php
use Psr\Container\ContainerInterface;
use nrv\core\repositoryInterfaces\filmRepositoryInterface;
use nrv\infrastructure\PDO\PdoFilmRepository;
use nrv\core\services\film\ServiceFilmInterface;
use nrv\core\services\film\ServiceFilm;




return [
    'nrv.pdo' => function (ContainerInterface $container) {
        $config = parse_ini_file(__DIR__ . '/nrv.db.ini');
        $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['database']}";
        $user = $config['username'];
        $password = $config['password'];
        return new \PDO($dsn, $user, $password, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    },

    filmRepositoryInterface::class => function (ContainerInterface $container) {
        $pdo = $container->get('nrv.pdo');
        return new PdoFilmRepository($pdo);
    },

    ServiceFilmInterface::class => function (ContainerInterface $container) {
        $filmRepository = $container->get(filmRepositoryInterface::class);
        return new ServiceFilm($filmRepository);
    }

];