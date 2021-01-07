## Machine setup

- Install composer in your local machine
- install php 7.3 or greater
- xampp or wampp server
- open xampp and create a database

# Project setup

- clone the project from
- cd into project root and run the command

``` bash
composer install
```

- copy env.example to .env
- set the database credentials i.e. database name, username and password
- create stripe account and put public api to stripe_key and private to stripe_api_key in env file
- for email testing you can create account of mailtrap and set mail_username and mail_password provided by mailtrap so
  it can catch all the outgoing email
- run the following command

```
  php artisan migrate --seed
```

- fake data will be created and inserted into the database
- default id is admin@admin.com for admin and password is password
- you can change other user information based on your requirement after logging as admin
