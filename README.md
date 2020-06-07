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

