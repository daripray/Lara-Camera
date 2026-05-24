#  2. Add Column is_admin in tabel users

##   2.  Update User name "Admin" set is_admin true
###  With Tinker
```bash
php artisan tinker

> $user = App\Models\User::find(1);
> $user->is_admin = true;
> $user->save();
```

###  With Seeder
```bash
php artisan make:seeder AdminSeeder

   INFO  Seeder [D:\laragon_6.0.0\www\Lara-Camera\database\seeders\AdminSeeder.php] created successfully.

--------------- database/seeders/AdminSeeder.php: ---------------

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::where('name', 'Admin')
            ->update([
                'is_admin' => true,
            ]);
    }
---------------

php artisan db:seed --class=AdminSeeder

   INFO  Seeding database.

```
