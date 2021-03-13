<?php
class Pages extends Controller {
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index(){

        $users = $this->userModel->getUsers();

        $data = [
            'title'=>'Home page',
            'users'=>$users
        ];
        $this->view('pages/index', $data);
    }


    public function searchTerm()
    {
        $data = [
            'term'=>'',
            'category_id' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'term'=>trim($_POST['term']),
                'category_id' => $_POST['category']
            ];

            $this->searchTerm($data);

        }   
    }

    

    public function getCategories(){
        for ($i=0; $i < 1 ; $i++) { 
            echo $this->userModel->categoryTree();
        }

        var_dump($this->userModel->categoryTree());
        
     }
}