<?php
require __DIR__."/../vendor/autoload.php";

$config = require __DIR__."/../config/local.php";
$client = new \Github\Client();
$client->authenticate($config['githubToken'], null, \Github\Client::AUTH_HTTP_TOKEN);
foreach($config['components'] as $component) {
    $name = strtolower($component);
    try {
    $repo = $client
        ->api('repo')
        ->create(
            "zend-{$name}",
            "{$component} component from Zend Framework",
            'https://github.com/zendframework/zf2',
            true,
            "zendframework",
            true
            );
    } catch (\Github\Exception\ValidationFailedException $e) {
        echo "[{$e->getCode()}] {$e->getMessage()} \n\r";
        continue;
    }
    echo "[200] Created zend-{$name} \n\r";
}
