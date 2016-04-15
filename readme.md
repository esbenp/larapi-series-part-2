# A modern REST API in Laravel 5 Part 2: Resource controls

[The article can be read here](http://esbenp.github.io/2016/04/15/modern-rest-api-laravel-part-2/)

## Setup

```bash
composer install && php artisan migrate
```

Remember to create an `.env` file!!

## Example commands

Use these commands in the terminal to test your api. Replace `http://larapi-part-2.dev` with the URL to your own local API.

**Inserts a user into the database**
```bash
curl -X POST -H 'Content-Type: application/json' -d '{"user": {"email": "user@user.com", "name": "A user", "password": "12345678"}}' http://larapi-part-2.dev/users
```

**Inserts some roles into the database**
```bash
curl -X POST -H 'Content-Type: application/json' -d '{"role": {"name": "Role #1"}}' http://larapi-part-2.dev/roles &&
curl -X POST -H 'Content-Type: application/json' -d '{"role": {"name": "Role #2"}}' http://larapi-part-2.dev/roles &&
curl -X POST -H 'Content-Type: application/json' -d '{"role": {"name": "Role #3"}}' http://larapi-part-2.dev/roles
```

**Get roles**
```bash
curl http://larapi-part-2.dev/roles
```

**Get users and eager load their roles**
```bash
curl --globoff http://larapi-part-2.dev/users?includes[]=roles
```

**Attach role ID 1 & 2 to user ID 1**
Note you may have to change the IDs to fit your own data
```bash
curl -X POST -H 'Content-Type: application/json' -d '{"roles": [1,2]}' http://larapi-part-2.dev/users/1/roles
```

**Remove role ID 2 from the user ID 1**
Note you may have to change the IDs to fit your own data
```bash
curl -X DELETE -H 'Content-Type: application/json' -d '{"roles": [2]}' http://larapi-part-2.dev/users/1/roles
```

**Set the roles of user ID 1 to IDs 1,2 & 3**
Note you may have to change the IDs to fit your own data
```bash
curl -X PUT -H 'Content-Type: application/json' -d '{"roles": [1,2,3]}' http://larapi-part-2.dev/users/1/roles
```

**Get users and eager load roles in IDs mode**
```bash
curl --globoff http://larapi-part-2.dev/users?includes[]=roles:ids
```

**Get users and eager load roles in sideload mode**
```bash
curl --globoff http://larapi-part-2.dev/users?includes[]=roles:sideload
```
