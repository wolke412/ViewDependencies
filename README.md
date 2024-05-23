# ViewDependencies
A Php utility class for working with old MVC projects.

## Why: 
Often old frameworks have one big chunk of styles or scripts and just loads them up every time.
Now we load only what will be using.


## Basic usage:

> on View.php: 

```php
<?php
  // Requires lib. 
  require_once(__DIR__."/../utils/ViewDependencies.php");
  
  $import = new ViewDependencies();
  $import
    ->add_stylesheet("example-page.css")
    ->add_script("example-page.js")
    ->add_script("utils/example-utils.js")
    
    // imports with absolute path (useful for external libraries)
    ->add_script("https://any.io/example-of-external-library.min.js", [
        "IS_ABSOLUTE_PATH" => TRUE
    ])

    // options array is useful for changing the behaviour of your template
    // via View file
    ->options([
    
        // Make changes to Layout...
        "NO_PADDING" => TRUE,
        
        // Changing tags for SEO reasons....
        "PAGE_TITLE" => "This is the new Title",
        
        // You can add essentially anything here and handle it accordingly at your template.
    ])
  
    // Exports to context.
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


