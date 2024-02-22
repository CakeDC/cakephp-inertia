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
