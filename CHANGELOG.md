Changelog
=========

Releases for CakePHP 5.0
------------------------
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