# StudUp
## _Hier étudiant.e.s, aujourd'hui entrepreneur.e.s_


## Install

### Cloning the project

Clone de repository and move to the directory
```sh
git clone git@github.com:tomas-ryan-lee/StudUp.git`
cd StudUp
```

### Requirements

##### Install PHP8
For debian :
```sh
sudo apt-get install lsb-release apt-transport-https ca-certificates
sudo wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
echo "deb https://packages.sury.org/php $(lsb_release -sc) main" | sudo tree /etc/apt/sources.list.d/php.list
sudo apt-get update
sudo apt-get install php8.0 php-xml
```
##### Install composer

```sh
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
```
Check the integrity of the installer
```sh
php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
```
If the installer is verified, continue the installation
```sh
php composer-setup.php
php "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer
```
##### Install symfony-cli
```sh
wget https://get.symfony.com/cli/installer -O - | bash
```
Make sure to check the prompt to make the `symfony` command available for your system.

##### Install npm
Download the latest nodejs version in [nodejs.org](https://nodejs.org/en)
Extract the archive and move it to `/opt` (or anywhere else, just make sure to accord it in commands further).
Make sure to change the x's with the version number
```sh
tar xf node-vxx.xx.x-linux-x64.tar.xz
sudo mv node-vxx.xx.x-linux-x64.tar.xz /opt
```
Add these lines in `~/.bashrc`
```
# NodeJS
export NODEJS_HOME=/opt/node-vxx.xx.x-linux-x64/bin
export PATH=$NODEJS_HOME:$PATH
```
Finally, close and reopen your terminal or just
```
source ~/.bashrc
```

## Installation

Run these lines to setup and launch the project
```sh
composer update
npm install
npm run dev
symfony server:start
```

# Your app is now running ! Congratulation !!
 
