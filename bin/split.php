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
        "InstanceType" => "t2.micro",
        "KeyName" => "gianarb-def",
        "UserData" => base64_encode(
            str_replace(
                "%componentName%",
                $component,
                file_get_contents(__DIR__."/script.sh")
            )
        ),
        "SubnetId" => "subnet-5eeb6f75",
    ));

}
