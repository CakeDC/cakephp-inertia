Changelog
=========

Releases for CakePHP 5.0
------------------------
* 4.1.0

  * Add Dashboard vue template
  * Add cors origin * on vite.config
  * Load form validation on layout removed on form.twig and imported globaly on app.js
  * Create responsive theme with header and nav menus based bootstrap5 (no jQuery) and add sidebar menu and header vue Templates
  * Add feather icons, restyle index view and aapply icons on sorting
  * Remove inline load css on templates and load on theme.css
  * Remove deprecation calling finder with options array is deprecated
  * Fix displayFiled for belongsTo relation on model with Multiselect
  * Fix link to controller on related content for index view
  * Fix relative path css files
  * Update documentation

* 4.0.0
  * Replace webpack with vite
  * Update path to components, upgrade Link on inertiajs to inertia-vue3
  * Import createInertiaApp from inertiajs/vue3 instead of inertiajs/inertia-vue3 and remove onfinish after post
  * Update example test pages and layout
  * Add navbar and responsive layout container
  * Remove id flash
  * Update documentation

* 3.1.0
  * fix pass options to get using contains deprecated as array
  * fix if column exist to avoid error key not exist on model finder withRelated
  * add render input as checkbox instead of input with type text
  * add on method delete link function confirm and csrf token on headers
  * add "active" field as boolean on pages table sample to bake templates forms with checkbox
  * add searchable functionality and placeholder to vue Multiselect in baked templates when field is related to relation belongsTo and belongsToMany

* 3.0.0
  * Added by default bootstrap5 styles and HTML on generated templates using twig.
  * Add configuration FlashPrefixElement on InertiaTrait to use "alert" css class instead of "flash" css class in CakePHP Flash messages, configured by default.
  * Replace vue3-editor with vue-quilly and quill HTML editor

* 2.0.1 
  * update Docs
  * update app.js to use import (ES6) instead of require
  * update bake files for controller to use NumericPaginator
  * update bake files for Model to add functions: withRelated and BeforeMarshall
  * add buildPaginationLinks on InertiaResponseTrait

* 2.0.0
  * Initial release
  
Releases for CakePHP 4.5
------------------------
* 1.0.0
    * Initial release