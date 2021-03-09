<?php

    //Load the model and the view

    class Controller {
        public function model($model)
        {
            //Require model file
            require_once '../app/models/' . $model . '.php';

            //instantiate model
            return new $model();

        }

        // Loads the view (checks for the file)
        public function view($view, $data=[])
        {
                if (file_exists('../app/views/' . $view . '.php'))
                {
                    require_once '../app/views/' . $view . '.php';
                } 
                else 
                {
                    die("view does not exists");
                }
        }
    }