makesure to config filemode before you start development
```git config --add --global core.filemode false```

<!-- requirement:
```
* PHP version 7.2.10
* MYSQL version 5.7.24
* Redis server v=5.0.3
* node v8.10.0
``` -->
requirement:
```
** Docker 17 >=
```

run this command in directory sipmen-docker:
```
docker-compose up -d
docker-compose exec workspace bash
php artisan migrate
php artisan passport:install
```

2. copy Client ID and Client secret (under section Password grant client created successfully)
change this value in .env file:
untuk keluar dari workspace jalankan command `exit`
```
VENDOR_CLIENT_SECRET_KEY=""
VENDOR_CLIENT_SECRET_ID=""
CUSTOMER_CLIENT_SECRET_KEY=""
CUSTOMER_CLIENT_SECRET_ID=""
```


3. DB Seeding

to seeding database, you should in to workspace bash.
go to directory sipmen-docker and run this command:
```
docker-compose exec workspace bash
php artisan db:seed
exit
```
