<?php 
/*
 * Rating Class
 */

class Rating {
    private $user_id;
	private $recipe_id;
    private $rating;
    private $db = null;

    public function __construct($user_id = false) {
        $this->db = (new Database)->getConnection();
        
        if($user_id) {
            $this->get_data();
        }
    }
	
	public function set_data($uid, $rid, $rate){
        $this->user_id = $uid;
		$this->recipe_id = $rid;
        $this->rating = $rate;
        return true;
	}
	
    public function save() {
		try {
            $query = 'INSERT INTO ratings (user_id, recipe_id, rating) VALUES (?, ?, ?)';
            $stmt = ($this->db)->prepare($query);
            $stmt->bindParam(1,$this->user_id);
            $stmt->bindParam(2,$this->recipe_id);
            $stmt->bindParam(3,$this->rating);
                    
            $stmt->execute();
		}	
		    catch(PDOException $e){echo "Error: " . $e->getMessage();
		}		
    }
    
    public function get_rating($uid, $rid) {
        try {
            $query = 'SELECT rating from ratings WHERE user_id = '. $uid .' AND recipe_id = '. $rid .'';
            $stmt = ($this->db)->prepare($query);    
            $stmt->execute();
            $result = $stmt->fetch();
            return $result['rating'];
		}	
		    catch(PDOException $e){echo "Error: " . $e->getMessage();
		}
    }
}
