## Installation

Install plugin via command line:

```
$> ddev ssh
$inertiavitecake-web> composer require cakedc/cakephp-inertia
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
