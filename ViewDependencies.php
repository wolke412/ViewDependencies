<?php 

  class ViewDependencies {
    public const CALLABLE = "view_dependencies";

    private $base_url = '';
    private $dependencies = null;		


    private const ASSETS_PATH = "assets/";
    private const SCRIPTS_FOLDER = "js/";
    private const STYLESHEETS_FOLDER = "css/";


    function __construct($base_url = null) {

      // if has custom url
      $this->base_url = $base_url ?? base_url(); // Framework dependant

      $this->dependencies = [
        "stylesheet" => [],
        "script" => [],
        "options" => []
      ];
    }
    
    function get () {
      return $this->dependencies;
    }

    private function get_assets_path () {
      return $this->base_url . $this::ASSETS_PATH;
    }

    private function get_absolute_path( $path = "", $folder_path = "" ) {
      /* 
        returns 
          {base_url}/assets/js/{path}  || 
          {base_url}/assets/css/{path}
      */

      $folder_path = $this->get_assets_path() . $folder_path;
      return $folder_path . $path;
    }

    function add_stylesheet ( $path = null, $options = null )  {
      
      if ( is_null($path) ) return;

      if ( !$options["IS_ABSOLUTE_PATH"] ) {
        $path = $this->get_absolute_path( $path, $this::STYLESHEETS_FOLDER );
      }

      $html = "<link rel='stylesheet' href='$path' />";

      array_push($this->dependencies["stylesheet"], $html); 

      return $this;
    }
    
    function add_script ( $path = null, $options = null ) {
      if ( is_null($path) ) return;
      
      if ( !$options["IS_ABSOLUTE_PATH"] ) {
        $path = $this->get_absolute_path( $path, $this::SCRIPTS_FOLDER );
      }

      $html = "<script src='$path' type='text/javascript'></script>";
      
      array_push($this->dependencies["script"], $html); 
      return $this;
    }

    function options ( $opts = []) {
      $this->dependencies["options"] = $opts;
      return $this;
    }

    function export ( &$context ) {
      // Sets view dependencies object do context pointer
      // thus making method "output" callable anywhere you want.

      $context->view_dependencies = $this->get();
    }

    public static function output($dependencies = []) {
      // echoes html elements wherever you want them (<head> is prefferable).

      foreach ( $dependencies["stylesheet"] as $stylesheet ) {
        echo $stylesheet;
      }

      foreach ( $dependencies["script"] as $script ) {
        echo $script;
      }
    }
  }