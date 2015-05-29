MAG - Magento And Girls
=========================== 
## System configuration
- Database name: *magento*
- Database user: *magento*
- Database pass: *magento*

### Create database credentials
```
CREATE DATABASE magento;
GRANT ALL ON magento.* TO 'magento'@'localhost' IDENTIFIED BY 'magento';
FLUSH PRIVILEGES;
```

## System Requirements
### PHP
- Version PHP 5.5+
### Webserver 
- Apache with mod_rewrite
- (Or) Nginx
### MySQL 
- Version >= 5.5

