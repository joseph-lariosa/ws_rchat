<?php include('../config.php');?>

<?php 

session_start();

// $un = $_SESSION['userName'];
// $ur = $_SESSION['userRole'];

// class User {
 
//  private $username;
//  private $role;
 
//  function __construct( $username, $role ) {
//      $this->username = $username;
//      $this->role = $role;
//  }

//  function getName() {
//      return $this->username;
//  }

//  function getRole() {
//      return $this->role;
//  }

// }




  class User{

    private $username;
    private $data;

    public function __construct($username){
      $this->username = $username;
      if($this->valid_username()){
        $this->load();
      }
    }

    private function load(){
      // Let's pretend you have a global $db object.
      global $conn;
      $this->data = $conn->query('SELECT * FROM users WHERE username=:username', array(':username'=>$this->username))->execute()->fetchAll();
    }

    public function save(){
      // Save $this->data here.
    }


    /**
     * PHP Magic Getter
     */
    public function __get($var){
      return $this->data[$var];
    }

    /**
     * PHP Magic Setter
     */
    public function __set($var, $val){
      $this->data[$var] = $val;
    }


    private function valid_username(){
      //check $this->username for validness.
    }  

    // This lets you use the object as a string.
    public function __toString(){
      return $this->data['username'];
    }

  }