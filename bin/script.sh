#!/bin/bash
apt-get update
apt-get install -y python2.7 curl git php5 php5-curl php5-cli
curl "https://bootstrap.pypa.io/get-pip.py" -o "get-pip.py"
python get-pip.py
pip install awscli
aws s3 cp s3://%sshPath%/id_rsa ~/.ssh/id_rsa
chmod 400 ~/.ssh/id_rsa
aws s3 cp s3://%sshPath%/id_rsa.pub ~/.ssh/id_rsa.pub
git clone https://github.com/zendframework/component-split.git
cd component-split
./bin/split-component.sh -c %componentName% -t assets/test-files/TestConfiguration.php.dist -i assets/test-files/TestConfiguration.php.travis
cd zf2-migrate
git remote add origin git@github.com:gianarb/zend-%componentName%
git push origin master
git push --tags origin
aws s3 cp /var/log/cloud-init-output.log  s3://%bucketBackup%/zend-%componentName%.log
shutdown now
