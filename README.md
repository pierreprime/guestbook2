## Symfony 5 demo project

To create an admin user :
```
symfony console security:encode-password
```
then
```
symfony run psql -c "INSERT INTO admin (id, username, roles, password) \
VALUES (nextval('admin_id_seq'), 'admin', '[\"ROLE_ADMIN\"]', \
'\$argon2id\$v=19\$m=65536,t=4,p=1\$BQG+jovPcunctc30xG5PxQ\$TiGbx451NKdo+g9vLtfkMy4KjASKSOcn
```
Remember to escape the $ signs

##SSH keys troubleshooting with Symfony Cloud

https://symfony.com/doc/master/cloud/troubleshooting.html

## Profiler/PHPStorm connection

https://github.com/aik099/PhpStormProtocol

## Symfony cloud troubleshooting

https://symfony.com/doc/master/cloud/troubleshooting.html

## Change chromedriver binary used by Panther

https://www.christophe-meneses.fr/article/erreur-lors-de-la-mise-a-jour-de-panther-facebook-webdriver-exception-sessionnotcreatedexception-session-not-created-this-version-of-chromedriver-only-supports-chrome-version-x

Add following lines to .bashrc file :
```
export PANTHER_CHROME_DRIVER_BINARY=/usr/bin/chromedriver
export PANTHER_CHROME_BINARY=/usr/bin/google-chrome
```
Then reload with
```
source ~/.bashrc
```