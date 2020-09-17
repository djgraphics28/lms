## Please read the instruction carefully:

- Copy .env.example to .env
- Set Database name, user, password 

- Install npm modules
```bash
$ npm install
```

- Install plugins
```bash
$ composer install
```

- Generate new App key
```bash
$ php artisan key:generate
```

- Migrate all database by running this script in terminal or command prompt or git bash:
```bash
$ php artisan migrate
```

- Run seeder (so that the existing data will be save to new database) by running this script:
```bash
$ php artisan db:seed --class=AllSeeder
```

## Copy project folder into htdocs (XAMPP) or www (WAMPP)
