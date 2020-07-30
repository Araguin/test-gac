
# Import fees file project
This MS allows to load fees files and siplay them in a symfony, mysql, angular environnement

## Docker containers:

		DataBase:
		 1. database
		
		Server Code:
		 1. application
		 2. nginx-back
	 
		 Front End Code:
		 1. client
		 2. nginx-front


Usage
-----
Run development environment
```bash
$ docker-compose up -d
```
To update composer and create database
```bash
$ docker exec -it acm-back-end /bin/bash
$ composer update
$ php bin/console doctrine:schema:update --force
```
To execute import, use front office to uload your file then run on acm-back-end
```bash
$ php bin/console app:import-charged-fees-file
```


To down environment
```bash
$ docker-compose down
```
Useful
------
Show all container
```bash
$ docker-compose ps
```
Connect to container
```bash
$ docker exec -it {container_name} bash
```
Fix minor problem with docker images
```bash
$ docker-compose up --force-recreate
```

Access to projects
------------------
Symfony: http://localhost:8000

Angular: http://localhost:8080
