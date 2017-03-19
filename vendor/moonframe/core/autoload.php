<?php

class NameAutoloader
{
  protected $nameSpaces = [];

  public function addNamespace($namespace, $rootDir)
  {
      if (is_dir($rootDir))
      {
        $this->nameSpaces[$namespace] = $rootDir;
        return $this->nameSpaces;
      }
      else return false;
  }

public function __construct()
{
  $this->addNamespace('moonframe', ROOT.'/vendor/moonframe/core');
  $this->addNamespace('model', ROOT.'/app/model');
  $this->addNamespace('controllers', ROOT.'/app/controller');
  $this->addNamespace('components', ROOT.'/app/components');
}

  public function register()
    {
        spl_autoload_register(array($this, 'autoload'));
    }

  protected function autoload($class)
  {
    $pathes = explode('\\', $class);
   // print_r($pathes);
      $namespace = array_shift($pathes);
    // echo $this->nameSpaces[$namespace].'<br>';
      if (array_key_exists($namespace, $this->nameSpaces))
      {
        $filepath = $this->nameSpaces[$namespace].'/'.implode('/', $pathes).'.php';
        require_once $filepath;
      }
  }
}
