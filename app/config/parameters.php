<?php
if (isset($_ENV['DATABASE_URL'])) {
    $dbUrl = $_ENV['DATABASE_URL'];
    $parts = parse_url($dbUrl);
    $container->setParameter('database.host', $parts['host']);
    $container->setParameter('database.name', trim($parts['path'], '/'));
    $container->setParameter('database.user', $parts['user']);
    $container->setParameter('database.password', $parts['pass']);
    $container->setParameter('database.port', $parts['port']);
}
