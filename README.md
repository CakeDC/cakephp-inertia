# CakePHP Inertia
Plugin to integrate [InertiaJS](https://inertiajs.com/) to communicate front (Vue) and back (CakePHP) without API using json

<a href="docs/initial.md">Sample CakePHP App with Docker and Postgres</a>

## Installation

You can install this plugin into your CakePHP application using [composer](https://getcomposer.org).

Edit composer.json and add repository

```
    "repositories": [
        {
            "type": "git",
            "url": "git@git.cakedc.com:plugins/cakephp-inertia.git"
        }
    ]
```

Install plugin via command line:

```
$> composer require cakedc/cakephp-inertia:dev-initial-inertia-plugin
```

## Configuration

Once installed enable it in *src/Application.php*, adding at the bottom of bootstrap function:

```
$this->addPlugin('CakeDC/Inertia');
```

or type in command line

```
$> bin/cake plugin load CakeDC/Inertia
```

## Create Vue App

To create Vue App type in command line:

```
$> bin/cake create_vue_app
```

This command create in the resources directory the files that use our App, also create in root directory the files
- webpack.mix.js
- package.json

Then in root directory install with NPM

```
$> npm install
```

## How to Use

### Simple Page

Create a single page called **dashboard** that show values sets in a controller action

We need to add first *InertiaResponseTrait*

```
use CakeDC\Inertia\Traits\InertiaResponseTrait;

class PagesController extends AppController
{

  use InertiaResponseTrait;

  ...
  ...

}
```

Create a new function that would look like this

```
public function dashboard()
{
   //set default php layout of plugin that use vue
   $this->viewBuilder()->setTheme('CakeDC/Inertia');

   $page = [
       'text' => 'hello world 1',
       'other' => 'hello world 2',
   ];
   $this->set(compact('page'));
}
```

in *config/routes.php* uncomment lines to catch all routes

```
$builder->connect('/{controller}', ['action' => 'index']);
$builder->connect('/{controller}/{action}/*', []);
```

and comment line

```
$builder->connect('/pages/*', 'Pages::display');
```

Create file *resources/js/Components/Pages/Dashboard.vue* that would look like this

```
<script setup>
import Layout from '../Layout'
import { Head } from '@inertiajs/vue3'
import {onMounted} from "vue";

defineProps({
    csrfToken: String,
    flash: Array,
    page: Array,
})


onMounted(() => {
    console.log('Component Dashboard onMounted hook called')
})
</script>

<template>
    <Layout>
        <Head title="Welcome" />
        <h1>Welcome</h1>
        <p>{{page.text}}</p>
        <p>{{page.other}}</p>
    </Layout>
</template>
```

On root directory execute

```
$> npm run dev
```

**IMPORTANT: Whenever you modify the .vue templates you must run this script.**

Go to http://localhost:9099/pages/dashboard to see that Dashboard Vue Component prints values assigneds on Dashboard CakePHP function

### bake CRUD system

For this example we use sql file on *config/sql/example/postgresql).pgsql*

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
    <InertiaLink as="button" href="/pages/index" class="button shadow radius right small">Pages</InertiaLink>
    <InertiaLink as="button" href="/tags/index" class="button shadow radius right small">Tags</InertiaLink>
    <InertiaLink as="button" href="/categories/index" class="button shadow radius right small">Categories</InertiaLink>
</header>
```
