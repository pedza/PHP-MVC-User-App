<?php

    class Users extends Controller
    {
        public function __construct()
        {
            $this->userModel = $this->model('User');
        }

        public function register()
        {
            $data = [
                'username' => '',
                'email' => '',
                'password' => '',
                'confirmPassword' => '',
                'category_id'=> '',
                'emailError' => '',
                'usernameError' => '',
                'passwordError' => '',
                'confirmPasswordError' => '',
                'categoryError' => ''
            ];

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                //Sanitaze post data

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    //trim function is removing all the white spase at begining and at the end of the string

                    'username' => trim($_POST['username']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirmPassword' => trim($_POST['confirmPassword']),
                    'category_id'=> $_POST['category'],
                    'emailError' => '',
                    'usernameError' => '',
                    'passwordError' => '',
                    'confirmPasswordError' => '',
                    'categoryError' => ''
                ];

               
                $nameValidation = "/^[a-zA-Z0-9]*$/";
                $passwordValiation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

                //Validate username on letters and numbers
                if(empty($data['username']))
                {
                    echo 'sto ima vo username:' . $data['username'];
                    $data['usernameError'] = 'Please enter username.';
                }
                elseif(!preg_match($nameValidation, $data['username']))
                {
                    $data['usernameError'] = 'Username can only contain letters and numbers.';
                }

                //Validate email 
                if(empty($data['email']))
                {
                    $data['emailError'] = 'Please enter your e-mail address.';
                }
                //removes all illegal caracters from an email address
                elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
                {
                    $data['emailError'] = 'Please enter correct format.';
                }
                //Check if email exists
                else
                {
                    if ($this->userModel->findUserByEmail($data['email']))
                    {
                        $data['emailError'] = 'Email already taken.';

                    }
                }

                //Validate password length and numeric values
                if(empty($data['password']))
                {
                    $data['passwordError'] = 'Please enter password.';
                }
                elseif(strlen($data['password'] < 6))
                {
                    $data['passwordError'] = 'Password must be at least 6 characters.';
                }
                elseif(preg_match($passwordValiation, $data['password']))
                {
                    echo $data['password'];
                    $data['passwordError'] = 'Password must have at least one number';
                }

                //Validate confirm password
                if(empty($data['confirmPassword']))
                {
                    $data['confirmPasswordError'] = 'Please confirm password';
                }
                else {
                    if($data['password'] != $data['confirmPassword'])
                        {
                            $data['confirmPasswordError'] = 'Passwords do not match';
                        }
                }

                //validate category selection
                if(empty($data['category_id']))
                {
                    echo 'sto ima vo category:' . $data['category_id'];
                    $data['categoryError'] = 'Please select a category';
                }

                //Check that errors are empty

                if (empty($data['usernameError']) && empty($data['emailError']) 
                    && empty($data['passwordError']) && empty($data['confirmPasswordError']) && empty($data['categoryError']))
                {
                    //hash password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    //register user from model function
                    if ($this->userModel->register($data)){
                        //redirect to the login page
                        header('location: ' . URLROOT . '/users/login');
                    }
                    else {
                        die('Something went wrong!');
                    }
                }


            }

            $this->view('users/register', $data);
        }

        public function login()
        {
            $data = [
                "title" => "Login Page",
                'username' => '',
                'password' => '',
                "usernameError" => '',
                "passwordError" => ''

            ];

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                //sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'username' => trim($_POST['username']),
                    'password' => trim($_POST['password']),
                    'usernameError' => '',
                    'passwordError' => ''
                ];

                //validate username
                if(empty($data['username']))
                {
                    $data['usernameError'] = 'Please enter your Username.';
                }

                 //validate password
                 if(empty($data['password']))
                 {
                     $data['passwordError'] = 'Please enter your Password.';
                 }

                 //check if all errors are empty
                 if(empty($data['usernameError']) && empty($data['passwordError']))
                 {

                    $loggedInUser = $this->userModel->login($data['username'], $data['password']);

                    if($loggedInUser)
                    {
                        $this->createUserSession($loggedInUser);
                    }
                    else
                    {
                        
                        $data['passwordError'] = 'Password or Username is incorrect. Please try again.';

                        
                    }

                 }


            }
            else {
                $data = [
                    'username' => '',
                    'password' => '',
                    "usernameError" => '',
                    "passwordError" => ''
    
                ];
            }

            $this->view('users/login', $data);
        }

        public function createUserSession($user)
        {
           
            $_SESSION['id'] = $user->id;
            $_SESSION['username'] = $user->username;
            $_SESSION['email'] = $user->email;
            header('location:' . URLROOT . '/pages/index');
        }

        public function logout(){
            unset($_SESSION['id']);
            unset($_SESSION['username']);
            unset($_SESSION['email']);
            header('location:' . URLROOT . '/users/login');
        }

        public function getCategories(){
           echo $this->userModel->categoryTree();
        }

    }