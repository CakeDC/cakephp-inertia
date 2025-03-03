## Create Environment with DDev

```
composer create-project --prefer-dist cakephp/app:~5.0 inertiavitecake
cd inertiavitecake
ddev config --project-type=cakephp --php-version 8.2 --nodejs-version 22 --docroot=webroot --database=postgres:15
ddev start
```

Note: Because in this example are using postgres you need to update on app.php file the encoding from 'encoding' => 'utf8mb4' to 'encoding' => 'utf8'

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
ddev restart
```

Now you can view project installed at https://inertiavitecake.ddev.site/

Note: remember that to enter the ddev container you must run ddev ssh at the root of your project

```
ddev ssh
```
