<?php
/*
 * User Profile Class
 */

class User {
   private $table_name = 'users';
   private $db = null;
   private $user_data = array();

   public function __construct($user_id = false) {
     $this->db = (new Database)->getConnection();

     if($user_id) {
       $this->get_data($user_id);
     }
   }

   public function is_login() {
     session_start();
     return isset($_SESSION['user_id']);
   }

   public function set_data($args) {
     // We are predicting that the data will be correct order
     $this->user_data = $args;
   }

   public function login($username, $password) {
     $stmt = $this->db->prepare('SELECT * FROM '. $this->table_name.' WHERE username = ?');
     $stmt->execute([$username]);
     $results = $stmt->fetch();
    
     // We set invalid logins by default
     $response = false; 

     if(!empty($results)) {
       $session_name = get_config('session','name'); // Set a custom session name
       $secure = false; // Set to true if using https.
       $httponly = true; // This stops javascript being able to access the session id.
       $remember = true;
       //ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies.
       $cookieParams = session_get_cookie_params(); // Gets current cookies params.
       if($remember) {
         $lifespan = get_config('session','life'); // cookie will expire after 7 days
       } else {
         $lifespan = 0;  // othewise immediate expire after session destroy
       }
       session_set_cookie_params($lifespan, $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
      	if(session_status() === PHP_SESSION_ACTIVE) {
      		session_unset();
      		session_destroy();
      	}
      	session_name($session_name); // Sets the session name to the one set above.
      	session_start(); // Start the php session
        session_regenerate_id(true); // regenerated the session, delete the old one.
        $_SESSION['user_id'] = $results['id'];
        $this->user_data = $results;
        $response = true;
     } 
     return $response;
   }

   private function get_data($user_id) {
      $query = 'SELECT * FROM '. $this->table_name .' WHERE id = '. $user_id;
      $stmt = $this->db->prepare($query);
      $stmt->execute();
      $result = $stmt->fetch();
      $this->user_data = $result;
   }

   public function get_role() {
    return $this->user_data['role'];
   }

   public function get_name() {
    return $this->user_data['first_name'] .' '. $this->user_data['last_name'];
   }

   public static function findByUsername($username) {
      $db = (new Database)->getConnection();

      $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
      $stmt->execute([ $username ]);
      $result = $stmt->fetch();

      return $result['id'];
   }

   public function save() {
     if(empty($this->user_data)) {
       // Our user data is not set. We will raise exception here
       return false;
     }
     $default = array();
     // No merge since default is empty.
     $args = array_merge($default, $this->user_data);
     unset($args['confirm_pass']);
    //  $query = sprintf('INSERT into %s(first_name, last_name, username, password) VALUE (?, ?, ?, ?)',$this->table_name); //now working
     $query = sprintf('INSERT into %s (first_name, last_name, username, password) VALUE ("%s", "%s", "%s", "%s")',$this->table_name, $args['first_name'], $args['last_name'], $args['login_user'], $args['password']);
     $stmt = $this->db->prepare($query);

      //$status = $stmt->execute($args);
      $status = $stmt->execute();

      return $status;
   }
}
