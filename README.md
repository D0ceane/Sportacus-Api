# Sf6-Mysql
## Version:
#### - Symfony 6 - cli
#### - Git 2.30.2
#### - Npm 7.5.2
#### - Node 12.22.5
#### - Composer 2.3.7
#### - PHP 8.1
#### - Mysql 8.0

# Run localhost
## Step Zero
```bash
  git clone https://github.com/D0ceane/Sportacus-Api
```
## First step : Docker
If you don't have docker, install https://docs.docker.com/desktop/windows/wsl/ before run :
```bash
  docker-compose build
  docker-compose up
```
## Second Step: Connect to the php container
```bash
  docker exec -it php8 bash
```
## Third step : Run your symfony app
```bash
  cd Sportacus-Api
  composer install
  symfony serve -d
```
## Four step: add user for write rules
```bash
  adduser username
  chown username:username -R Sportacus-Api/
```

The app is available on localhost:9000 or http://127.0.0.1:9000

To visite the api : localhost:9000/api

## Use Fixture

1) First install Alice
 ``` bash
docker-compose exec php8 bash
composer require --dev alice
 ```

2) Load data fixtures
```bash
bin/console hautelook:fixtures:load
```

## Use Test
1. Check that Symfony HttpClient and Symfony test pack are installed. If they are not, run :
```bash
composer require --dev symfony/test-pack symfony/http-client
```

2. Run test in your php docker container with :
```bash
bin/phpunit
```


