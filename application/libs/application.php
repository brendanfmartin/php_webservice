<?php

class Application
{
    /** @var null The controller */
    private $url_controller = null;

    /** @var null The method (of the above controller), often also named "action" */
    private $url_action = null;

    /** @var null Parameter one */
    private $url_parameter_1 = null;

    /** @var null Parameter two */
    private $url_parameter_2 = null;

    /** @var null Parameter three */
    private $url_parameter_3 = null;

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct()
    {
        
        // create array with URL parts in $url
        $this->splitUrl();
        
        // $inipath = php_ini_loaded_file();
        //     if ($inipath) {
        //         echo 'Loaded php.ini: ' . $inipath;
        //     } else {
        //         echo 'A php.ini file is not loaded';
        //     }

        // echo phpinfo();


        // exit();

        // check for controller: does such a controller exist ?
        if (file_exists('./application/controller/' . $this->url_controller . '.php')) {

            // if so, then load this file and create this controller
            // example: if controller would be "car", then this line would translate into: $this->car = new car();
            require './application/controller/' . $this->url_controller . '.php';
            $this->url_controller = new $this->url_controller();

            // check for method: does such a method exist in the controller ?
            if (method_exists($this->url_controller, $this->url_action)) {

                // call the method and pass the arguments to it
                if (isset($this->url_parameter_3)) {
                    // will translate to something like $this->home->method($param_1, $param_2, $param_3);
                    $this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2, $this->url_parameter_3);
                } elseif (isset($this->url_parameter_2)) {
                    // will translate to something like $this->home->method($param_1, $param_2);
                    $this->url_controller->{$this->url_action}($this->url_parameter_1, $this->url_parameter_2);
                } elseif (isset($this->url_parameter_1)) {
                    // will translate to something like $this->home->method($param_1);
                    $this->url_controller->{$this->url_action}($this->url_parameter_1);
                } else {
                    // if no parameters given, just call the method without parameters, like $this->home->method();
                    $this->url_controller->{$this->url_action}();
                }
            } else {
                // default/fallback: call the index() method of a selected controller
                $this->url_controller->index();
                // shouldnt this route to an error?
            }
        } else {
            // invalid URL, so simply show home/index
            require './application/controller/errors.php';
            $error = new Errors();
            $error->notFound();
            // invalid URLs should route to a 404
        }
    }

    /**
     * Get and split the URL
     */
    private function splitUrl()
    {

        if (isset($_SERVER['REQUEST_URI'])) {

            // split URL
            $url = rtrim($_SERVER['REQUEST_URI'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);



            $this->url_controller = (isset($url[1]) ? $url[1] : null);
            $this->url_action = (isset($url[2]) ? $url[2] : null);
            $this->url_parameter_1 = (isset($url[3]) ? $url[3] : null);
            $this->url_parameter_2 = (isset($url[4]) ? $url[4] : null);
            $this->url_parameter_3 = (isset($url[5]) ? $url[5] : null);

            
            // echo 'Controller: ' . $this->url_controller . '<br />';
            // echo 'Action: ' . $this->url_action . '<br />';
            // echo 'Parameter 1: ' . $this->url_parameter_1 . '<br />';
            // echo 'Parameter 2: ' . $this->url_parameter_2 . '<br />';
            // echo 'Parameter 3: ' . $this->url_parameter_3 . '<br />';
        }
    }
}
