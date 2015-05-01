#!/bin/bash
#apt-get update
#apt-get install -y python2.7 curl git php5 php5-curl php5-cli
#curl "https://bootstrap.pypa.io/get-pip.py" -o "get-pip.py"
#python get-pip.py
#sudo pip install awscli
git clone https://github.com/zendframework/component-split.git
cd component-split
./bin/split-component.sh -c %componentName% -t assets/test-files/TestConfiguration.php.dist -i assets/test-files/TestConfiguration.php.travis 2>&1 | tee -a split.log
cd zf2-migrate
