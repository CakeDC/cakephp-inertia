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