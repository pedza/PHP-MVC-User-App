<?php

//Core App Class

class Core {
    //if there are no other contollers in a controller file this page will automatically loaded
    protected $currentControler = 'Pages';
    //inside the page controller will load the index method
    protected $currentMethod ="index";

    protected $params =[];

    public function __construct()
    {
       $url = $this->getUrl();

       //Look in controllers for first value and ucwords will capitalize first letter
    if(isset($url[0])){

        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) 
       {

            //will set a new controller
            $this->currentControler = ucwords($url[0]);
            unset($url[0]);
       }


    }
       

       //require the controller

       require_once '../app/controllers/' . $this->currentControler . '.php';

       $this->currentControler = new $this->currentControler;

       //Check for the second part of the url
       if (isset($url[1]))
       {
           if(method_exists($this->currentControler, $url[1]))
           {
               $this->currentMethod=$url[1];
               unset($url[1]);
           }
       }

       //get parameters
       $this->params = $url ? array_values($url) : [];

       //call a callback with array of params

       call_user_func_array([$this->currentControler, $this->currentMethod], $this->params);

    }



    public function getUrl()
    {
        if(isset($_GET['url'])){
            //what we want to strip from the url
            $url = rtrim($_GET['url'], '/');

            //Allows to filter variables as string/number
            $url = filter_var($url, FILTER_SANITIZE_URL);

            //braking the url into array
            $url = explode('/', $url);

            return $url;
        }
    }
}