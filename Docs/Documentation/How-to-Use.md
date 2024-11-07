## How to Use

### Simple Navigation on Two Pages

We need to add first *InertiaResponseTrait* to the controller

```
use CakeDC\Inertia\Traits\InertiaResponseTrait;

class PagesController extends AppController
{

  use InertiaResponseTrait;

  ...
  ...

}
```

Create a two function that would look like this

```
public function test1()
    {
        $this->viewBuilder()->setTheme('CakeDC/Inertia');

        $page = [
            'text' => 'hello world 1',
            'other' => 'hello world 2',
        ];
        $this->set(compact('page'));
    }

    public function test2()
    {
        $this->viewBuilder()->setTheme('CakeDC/Inertia');

        $page = [
            'text' => 'hello world 3',
            'other' => 'hello world 4',
        ];
        $this->set(compact('page'));
    }
```

in *config/routes.php* uncomment lines to catch all routes

```
$builder->connect('/{controller}', ['action' => 'index']);
$builder->connect('/{controller}/{action}/*', []);
```

and comment the line

```
$builder->connect('/pages/*', 'Pages::display');
```

to load dashboard directly replace line

```
$builder->connect('/', ['controller' => 'Pages', 'action' => 'index', 'home']);
```

with

```
$builder->connect('/', ['controller' => 'Pages', 'action' => 'test1']);
```

If you excuted previously create_vue_app the vue pages Test1.vue and Test.vue ae in the resources/components/pages drirectory, check it 

For development exec Vite server on the container

```
$> ddev npm run dev
```

For production exec `vite vuild` on the container

```
$> ddev npm run build
```

This generates this assets directory inside webroot dir, the helper automatically load the files parsing the manifest.json

Go to https://inertiavitecake.ddev.site see Test1 Vue Component page that prints values assigneds on Test1 CakePHP function,
in the top you can see a link to "Test2", you can navigate to /pages/test2 and in this you can see a link to "Test1"
and can navigate to /pages/test2 without page reload.

