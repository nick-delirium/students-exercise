<?php

class Loader
{

  function register()
  {
    spl_autoload_register(array($this, 'load'));
  }


  function load($class_name)
  {
    $classPaths = [
    '/components/',
    '/model/',
    ];

    foreach ($classPaths as $path)
	{
        $path = ROOT . $path . $class_name . '.php';
        if (is_file($path)) include_once $path;
    }
  }


}
