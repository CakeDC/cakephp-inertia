## Create Vue App

To create Vue App type in command line:

```
$> ddev ssh
$inertiavitecake-web> bin/cake create_vue_app
```

This command create in the resources directory this structure

- css
  - app.css
- js
  - components
    - Pages
      - Test1.vue
      - Test2.vue
  - app.js
  - bootstrap.js


and in root directory the files

- package.json
- vite.config.js
- tailwind.config.js
- postcss.config.js
- .env

Then in root directory install with NPM

```
$> ddev npm install
```
