# ViewDependencies
A Php utility class for working with MVC when projects.

## Basic usage:

> on View.php: 

```php
<?php
  require_once(__DIR__."/../utils/ViewDependencies.php");
  $import = new ViewDependencies();
  $import
    ->add_stylesheet("exmaple-page.css")
    ->add_script("example-page.js")
    ->add_script("utils/exmple-utils.js")
    
    // imports with absolute path (useful fopr external libraries)
    ->add_script("https://any.io/example-of-external-library.min.js", [
        "IS_ABSOLUTE_PATH" => TRUE
    ])

    // options array is useful for changing the behaviour of your template
    // via View file
    ->options([
        "NO_PADDING" => TRUE
    ])

    ->export($this);
?>

```

> on Template.php: 

```php
  <head>
    //... <link ...
    //... <link ...

    <?php ViewDependencies::output($this->view_dependencies ?? []); ?>

    //... <script ...
    //... <script ...
    //... <script ...
  </head>
```

> Result:
![Image demonstrating output](https://raw.githubusercontent.com/wolke412/ViewDependencies/main/output-example.png)


