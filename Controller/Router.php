<?php

    class Router{
        private $_ctrl ;
        private $_view ;

        public function routeReq(){
            try{
                spl_autoload_register(function($class){
                    require_once ("Model/". $class . ".php");
                    $url = " ";
                    if (isset($_GET[$url])){
                        $url = explode('/', filter_var($_GET[$url], FILTER_SANITIZE_URL));
                        $controller = ucfirst(strtolower($url[0]));

                        $controllerClass = "controller".$controller;
                        $conllerFile = "Controller/" . $conllerClass .".php";

                        if(file_exists($controllerFile)){
                            require_once($conllerFile);
                            $this->_ctrl = new $controllerClass($url);
                        }
                        else{
                            throw new Exception("page introuvable");
                        }

                    }
                    else{
                        require_once("Controller/controllerAccueil.php");
                        $controllerClass = "controllersAccueil";
                        $this->_ctrl = new $conllerClass($url);
                    }
                });
            }
            catch(Exception $e){
                    $errorMessage = $e->getMessage();
                    require_once("views/viewError.php");

            }
        }
}

?>