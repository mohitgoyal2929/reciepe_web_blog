<?php 
/*
 * Favorite Class
 */

class Favorite {
    private $table_name = 'favorites';
    private $user_id;
	private $recipe_id;
    private $isFavorite;
    private $db = null;

    public function __construct($user_id = false) {
        $this->db = (new Database)->getConnection();
        
        if($user_id) {
            $this->get_data();
        }
    }
	
	public function set_data($uid, $rid){
        $this->user_id = $uid;
		$this->recipe_id = $rid;
        return true;
	}
	
    public function save() {
		try {
            $query = 'INSERT INTO '.$this->table_name.' (user_id, recipe_id) VALUES (?, ?)';
            $stmt = ($this->db)->prepare($query);
            $stmt->bindParam(1,$this->user_id);
            $stmt->bindParam(2,$this->recipe_id);

            $stmt->execute();
		}	
		    catch(PDOException $e){echo "Error: " . $e->getMessage();
		}		
    }
    
    public function is_favorite($uid, $rid) {
        $query = 'SELECT * from '.$this->table_name.' WHERE user_id = ? AND recipe_id = ?';
        $stmt = ($this->db)->prepare($query);
        $stmt->execute([$uid, $rid]);
        if($stmt->rowCount() == 0) return false;
        else return true;
    }

    public function remove_favorite($uid, $rid) {
        $query = 'DELETE FROM '. $this->table_name .' WHERE user_id = ? AND recipe_id = ?';
        $stmt = ($this->db)->prepare($query);
        $stmt->execute([$uid, $rid]);
    }
}
