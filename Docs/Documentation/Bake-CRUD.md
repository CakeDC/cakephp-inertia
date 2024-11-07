
### bake CRUD system

For this example we use sql file on *config/sql/example/postgresql.pgsql*

Once the database has been created, bake models and controllers as normal using

Important: if you are using the docker example configuration with Postgres you need to change in your app.php,
the 'encoding' option inside Datasources to 'utf8' instead of 'utf8mb4',

```
$> ddev ssh
$inertiavitecake-web> bin/cake bake model Pages --theme CakeDC/Inertia
$inertiavitecake-web> bin/cake bake controller Pages --theme CakeDC/Inertia
$inertiavitecake-web> bin/cake bake model Tags --theme CakeDC/Inertia
$inertiavitecake-web> bin/cake bake controller Tags --theme CakeDC/Inertia
$inertiavitecake-web> bin/cake bake model Categories --theme CakeDC/Inertia
$inertiavitecake-web> bin/cake bake controller Categories --theme CakeDC/Inertia
```

bake templates using **vue_template** instead of **template** as

```
$inertiavitecake-web> bin/cake bake vue_template Pages --theme CakeDC/Inertia
$inertiavitecake-web> bin/cake bake vue_template Tags --theme CakeDC/Inertia
$inertiavitecake-web> bin/cake bake vue_template Categories --theme CakeDC/Inertia
```

Again run (outside container)

```
$> ddev npm run dev
```

You see results for example going to https://inertiavitecake.ddev.site/pages/index

### bake CRUD system with prefix

Add route to prefix Admin on *config/routes.php*

```
$builder->prefix('admin', function (RouteBuilder $builder) {
    $builder->fallbacks(DashedRoute::class);
});
```

To generate controllers and template with a prefix use **--prefix** option of bake command as

```
$> ddev ssh
$inertiavitecake-web> bin/cake bake controller Pages --prefix Admin --theme CakeDC/Inertia
$inertiavitecake-web> bin/cake bake controller Tags --prefix Admin --theme CakeDC/Inertia
$inertiavitecake-web> bin/cake bake controller Categories --prefix Admin --theme CakeDC/Inertia
$inertiavitecake-web> bin/cake bake vue_template Pages --prefix Admin --theme CakeDC/Inertia
$inertiavitecake-web> bin/cake bake vue_template Tags --prefix Admin --theme CakeDC/Inertia
$inertiavitecake-web> bin/cake bake vue_template Categories --prefix Admin --theme CakeDC/Inertia
```

Again run (outside container)

```
$> ddev npm run dev
```

You can go to https://inertiavitecake.ddev.site/admin/pages/index

### Add Menu

You can add and horizontal menu to navigate through controllers

Edit *resources/components/Layout.vue* and put inside header tag links as

```
<header>
    <Link as="button" href="/pages/index" class="btn btn-outline-primary mb-3">Pages</Link>
    <Link as="button" href="/tags/index" class="btn btn-outline-primary mb-3 ms-1">Tags</Link>
    <Link as="button" href="/categories/index" class="btn btn-outline-primary mb-3 ms-1">Categories</Link>
</header>
```
