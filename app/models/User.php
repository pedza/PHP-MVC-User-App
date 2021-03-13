<?php
class User{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUsers()
    {
        $this->db->query("SELECT * FROM users");
        $result = $this->db->resultSet();
        return $result;
    }

    public function register($data)
    {
        $this->db->query('INSERT INTO users (username, email, password, category_id) VALUES(:username, :email, :password, :category_id)' );

        

        var_dump( $data);
        //Bind Values

        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':category_id', $data['category_id']);

        //Execute function

        if($this->db->execute())
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function login($username, $password)
    {
        $this->db->query('SELECT * FROM users WHERE username = :username');

        //Bind value

        $this->db->bind(':username', $username);

        $row = $this->db->single();

        $hashedPassword = $row->password;

        if(password_verify($password, $hashedPassword))
        {
            return $row;
        }
        else
        {
            return false;
        }
    }

    //Find User By Email. Email is passed in by the controller
    public function findUserByEmail($email)
    {   
        //Prepared statment
        $this->db->query('SELECT * FROM users WHERE email = :email');

        //Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        //Check if the email is already registered 
        if($this->db->rowCount() > 0)
        {
            return true;
        }
        else {
            return false;
        }
    }

    //list all categories
    
    public function CategoryTree(&$output=null, $parent_id=0, $indent=null){
	// conection to the database
	$db = new PDO("mysql:host=localhost;dbname=userappregister", 'root', '');
	// select the categories that have on the parent column the value from $parent
	$r = $db->prepare("SELECT id, name FROM categories WHERE parent_id = :parent_id");
    var_dump($r);
	$r->execute(array(
		'parent_id' => $parent_id
	));
    
	// show the categories one by one
	while($c = $r->fetch(PDO::FETCH_ASSOC)){
		$output .= '<option value=' . $c['id'] . '>' . $indent . $c['name'] . "</option>";
		if($c['id'] != $parent_id){
			// in case the current category's id is different that $parent
			// we call our function again with new parameters
			$this->CategoryTree($output, $c['id'], $indent . "&nbsp;&nbsp;");
		}
	}
	// return the list of categories
    // var_dump($output);
    // echo $output;
	return $output;
}

    public function searchTerm($data){

        $this->db->query('SELECT * FROM users WHERE email = :email');

        //Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        //Check if the email is already registered 
        if($this->db->rowCount() > 0)
        {
            return true;
        }
        else {
            return false;
        }
        

    }
    
}