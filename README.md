Script to manange parallel Zend Framework's split in AWS.

## Config
```bash
cp config/local.php.dist config/local.php
```
Copy configuration's draft and replace this file with your configurations.
The `components` key is the lists of component to be divided

## UserAgent
In this implementation I run one EC2 instance for component and launch a UserAgent to provide and start split script.
See [script.sh](./bin/script.sh) this is the startup script
