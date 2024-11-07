## Create Environment with DDev

```
$> composer create-project --prefer-dist cakephp/app:~5.0 inertiavitecake
$> cd inertiavitecake
$> ddev config --project-type=cakephp --php-version 8.1 --nodejs-version 18 --docroot=webroot --database=postgres:13
$> ddev start
```

Verify in .env file generate on config directory that access to db is configured as

```
export DATABASE_URL="postgres://db:db@db:5432/db"
```

Because using postgres you need to update on app.php file the encoding from 'encoding' => 'utf8mb4' to 'encoding' => 'utf8'

Edit your config.yaml and add this configuration to expose vite ports

```
web_extra_exposed_ports:
    - name: vite
      container_port: 5173
      http_port: 5172
      https_port: 5173
```

Restart DDev

```
$> ddev restart
```


Now you can view project installed at https://inertiavitecake.ddev.site/


