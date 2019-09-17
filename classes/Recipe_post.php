<?php
/*
 * Recipe Post Class
 */

class Recipe_post 
{
    private $db = null;
    private $table_name = 'recipe';

    private $name = '';
    private $serving = 0;
    private $cooking_time = 0;
    private $prep_time = 0;
    private $meal_type = 0;
    private $description = '';
    private $nutrition_fact = '';
    private $img_data = array();
    private $img_url = '';
    private $user_id = 0;

    public function __construct($user_id = false) 
    {
        $this->db = (new Database)->getConnection();
        
        if($user_id) 
        {
            $this->get_data();
        }
    }

    private function get_data($user_id) 
    {
        // $query = 'SELECT * FROM '.$this->table_name;
        // $stmt = $this->db->prepare($query);
        // $stmt->execute();
        // return $stmt->fetchAll();
    }

    public function set_data($args, $img = null) 
    {
        print_r($img);
        if($img != null) 
        {
            $this->img_data = $img;
            $temp = explode(".",$img['file']['name'][0]);
            if($this->check_filetype(end($temp))) 
            {
                $this->img_url = 'imgs/featured/'.$img['file']['name'][0];
            } else {
                return false;
            }    
        }
        
        $this->name = $args['name'];
        $this->serving = $args['serving'];
        $this->cooking_time = $args['cooking_time'];
        $this->prep_time = $args['prep_time'];
        $this->meal_type = $args['meal_type'];
        $this->description = $args['description'];
        $this->nutrition_fact = $args['nutrition_fact'];
        $this->user_id = $_SESSION['user_id'];
        return true;
    }

    public function check_filetype($ext) 
    {
        $response = false;
        $allowed = array('png','jpeg','jpg');
        if(in_array($ext, $allowed)) 
        {
            $response = true;
        }
        return $response;
    }

    public function save() 
    {
        $query = 'INSERT INTO '. $this->table_name .' (name, serving, cooking_time, prep_time, meal_type_id, main_picture, description, nutrition_fact,  user_id) VALUES(?,?,?,?,?,?,?,?)';
        $stmt = $this->db->prepare($query);
        $stmt->execute(array($this->name, $this->serving, $this->cooking_time, $this->prep_time, $this->meal_type, $this->img_url, $this->description, $this->nutrition_fact, $this->user_id));
        return $this->db->lastInsertId();
    }

    public function update() {
        $this->recipe_id = $_POST['recipe_id'];
        $query = 'UPDATE '. $this->table_name .' SET name = ?, serving = ?, cooking_time = ?, prep_time = ?, meal_type_id = ?, main_picture = ?, description = ?, nutrition_fact = ?, user_id = ? WHERE id = ?';
        $stmt = $this->db->prepare($query);
        return $stmt->execute(array($this->name, $this->serving, $this->cooking_time, $this->prep_time, $this->meal_type, $this->img_url, $this->description, $this->nutrition_fact, $this->user_id, $this->recipe_id));
        
    }

    public function upload() {
        $destination_path = APP_PATH . 'imgs\\featured\\';
        if ($this->img_data['file']['error'][0] == UPLOAD_ERR_OK) {
            $tmp_name = $this->img_data['file']['tmp_name'][0];
            $destination_path = $destination_path . $this->img_data['file']['name'][0];
            move_uploaded_file($tmp_name, $destination_path);
        }
    }

    public function Calculate_Rating($rid){
		try{
            $query = 'SELECT AVG(rating) FROM ratings WHERE recipe_id = '.$rid;
			$stmt  = $this->db->prepare($query);
			$stmt->execute();
			
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			
			return $result["AVG(rating)"];
			
		}catch(PDOException $e){
			echo "Query Failed : ".$e->getMessage();
		}			
	}
}