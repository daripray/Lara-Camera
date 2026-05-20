#  Initiate Project

##   1.  Install Laravel Project

### Install Laravel "Lara-Camera"

```bash
laravel new Lara-Camera
...
Would you like to install a starter kit? [No starter kit]:
  [none     ] No starter kit
  [breeze   ] Laravel Breeze
  [jetstream] Laravel Jetstream
 > breeze
...

...
 Which Breeze stack would you like to install? [Blade with Alpine]:
  [blade              ] Blade with Alpine
  [livewire           ] Livewire (Volt Class API) with Alpine
  [livewire-functional] Livewire (Volt Functional API) with Alpine
  [react              ] React with Inertia
  [vue                ] Vue with Inertia
  [api                ] API only
 > livewire
...

...
 Would you like dark mode support? (yes/no) [no]:
 > no
...

...
Which testing framework do you prefer? [PHPUnit]:
  [0] PHPUnit
  [1] Pest
 > 0
 ...
 
 ...
 Would you like to initialize a Git repository? (yes/no) [no]:
 > no
 ...
 
 ...
 Which database will your application use? [MySQL]:
  [mysql  ] MySQL
  [mariadb] MariaDB
  [pgsql  ] PostgreSQL
  [sqlite ] SQLite
  [sqlsrv ] SQL Server
 > mysql
...
```

##  2.  Setup Project "lara-Camera"

### Open Project "Lara-Camera" in Software Editor
or
```bash
cd Lara_Camera
```

#### then

```bash
php artisan migrate
```

##  3.  Setup Filament

### Install Filament
```bash
composer require filament/filament 
```

### install Filament Panel
```bash
php artisan filament:install --panels

What is the panel's ID? [admin]
> admin
```

### Install Filament User

```bash
php artisan make:filament-user

  Name:
 > Admin

  Email address:
 > admin@admin.com

  Password:
 > (Password)
```
### Publish filament config
```bash
php artisan vendor:publish --tag=filament-config
```
