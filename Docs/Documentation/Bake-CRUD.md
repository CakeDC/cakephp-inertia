
### bake CRUD system

For this example we use sql file on *config/sql/example/postgresql.pgsql*

Once the database has been created, bake models and controllers as normal using

```
$> bin/cake bake model Pages --theme CakeDC/Inertia
$> bin/cake bake controller Pages --theme CakeDC/Inertia
$> bin/cake bake model Tags --theme CakeDC/Inertia
$> bin/cake bake controller Tags --theme CakeDC/Inertia
$> bin/cake bake model Categories --theme CakeDC/Inertia
$> bin/cake bake controller Categories --theme CakeDC/Inertia
```

bake templates using **vue_template** instead of **template** as

```
$> bin/cake bake vue_template Pages --theme CakeDC/Inertia
$> bin/cake bake vue_template Tags --theme CakeDC/Inertia
$> bin/cake bake vue_template Categories --theme CakeDC/Inertia
```

Again run

```
$> npm run dev
```

You see results for example going to http://localhost:9099/pages/index

### bake CRUD system with prefix

Add route to prefix Admin on *config/routes.php*

```
$builder->prefix('admin', function (RouteBuilder $builder) {
    $builder->fallbacks(DashedRoute::class);
});
```

To generate controllers and template with a prefix use **--prefix** option of bake command as

```
$> bin/cake bake controller Pages --prefix Admin --theme CakeDC/Inertia
$> bin/cake bake controller Tags --prefix Admin --theme CakeDC/Inertia
$> bin/cake bake controller Categories --prefix Admin --theme CakeDC/Inertia
$> bin/cake bake vue_template Pages --prefix Admin --theme CakeDC/Inertia
$> bin/cake bake vue_template Tags --prefix Admin --theme CakeDC/Inertia
$> bin/cake bake vue_template Categories --prefix Admin --theme CakeDC/Inertia
```

Again run

```
$> npm run dev
```

You can go to http://localhost:9099/admin/pages/index

### Add Menu

You can add and horizontal menu to navigate through controllers

Edit *resources/Components/Layout.vue* and put inside header tag links as

```
<header>
    <Link as="button" href="/pages/index" class="button shadow radius right small">Pages</Link>
    <Link as="button" href="/tags/index" class="button shadow radius right small">Tags</Link>
    <Link as="button" href="/categories/index" class="button shadow radius right small">Categories</Link>
</header>
```
