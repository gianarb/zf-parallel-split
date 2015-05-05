<?php

use Aws\Ec2\Ec2Client;
require __DIR__."/../vendor/autoload.php";

$config = require __DIR__."/../config/local.php";

$client = Ec2Client::factory($config['aws']);

foreach($config['components'] as $component) {
    $result = $client->runInstances(array(
        "ImageId" => "ami-d05e75b8",
        "MinCount" => 1,
        "MaxCount" => 1,
        "InstanceType" => "t2.medium",
        "InstanceInitiatedShutdownBehavior" => "terminate",
        "KeyName" => $config['keyName'],
        "UserData" => base64_encode(render($config, $component)),
        'IamInstanceProfile' => array(
            'Name' => $config['iam']['name'],
        ),
    ));

}

function render($config, $component) {
    $string = str_replace(
        "%componentName%",
        $component,
        file_get_contents(__DIR__."/script.sh")
    );
    $string = str_replace(
        "%bucketBackup%",
        $config['bucketBackup'],
        $string
    );

    $string = str_replace(
        "%sshPath%",
        $config['sshPath'],
        $string
    );

    return $string;
}
