<?php



class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath=ROOT.'/app/configuration/routes.php';
        $this->routes = include($routesPath);
    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI']))
		      {
            return trim($_SERVER['REQUEST_URI'], '/');
          }
    }

    public function run()
    {
        $uri = $this->getURI();
       // echo($_SERVER['REQUEST_URI']);
        foreach ($this->routes as $uriPattern => $path) {

            if (preg_match("~^$uriPattern$~", $uri))
			{
                $internalRoute = preg_replace("~^$uriPattern$~", $path, $uri);

                $parts = explode('/', $internalRoute);
                // print_r($parts);
                $controllerName = ucfirst(array_shift($parts).'Controller');
                // echo $controllerName.'+';
                $actionName = 'action'.ucfirst(array_shift($parts));
                $controllerFile = ROOT.'/controller/'.$controllerName.'.php';

                if (file_exists($controllerFile)) include_once($controllerFile);
                $controller = new $controllerName;
                $result = call_user_func_array(array($controller, $actionName), $parts);
                if ($result !=null) break;
            }
        }
    }

}
