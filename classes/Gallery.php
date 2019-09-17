<?php
/*
 * Gallery Class
 */

class Gallery {
    private $table_name = 'recipe_gallery';
    private $db = null;

    private $countfiles = 0;
    private $data = array();
    private $file_name = array();
    private $file_url = array();
    private $files_size = 0;
    private $recipe_id = 0;

    public function __construct($user_id = false) {
        $this->db = (new Database)->getConnection();

        if($user_id) {
            $this->get_data($user_id);
        }
    }

    private function get_data($user_id) {
        // $query = 'SELECT * FROM '.$this->table_name;
        // $stmt = $this->db->prepare($query);
        // $stmt->execute();
        // return $stmt->fetchAll();
    }

    public function set_data($rid, $args) {
        $this->recipe_id = $rid;
        $this->data = $args;
        $this->countfiles = count($this->data['imgs']['name']);
        for($i=0; $i<$this->countfiles; $i++) {
            $temp = explode(".",$this->data['imgs']['name'][$i]);
            if($this->check_filetype(end($temp))) {
                array_push($this->file_name, $this->data['imgs']['name'][$i]);
                array_push($this->file_url, 'imgs/'.$this->data['imgs']['name'][$i]);
            } else {
                return false;
            }
        }
        $this->files_size = array_sum($this->data['imgs']['size']);
        return true;
    }

    public function check_filetype($ext) {
        $response = false;
        $allowed = array('png','jpeg','jpg');
        if(in_array($ext, $allowed)) {
            $response = true;
        }
        return $response;
    }

    public function save() {
        $query = 'INSERT INTO '. $this->table_name .' (recipe_id, name, url, size) VALUES(?,?,?,?)';
        $stmt = $this->db->prepare($query);
        $stmt->execute(array($this->recipe_id, implode(", ", $this->file_name), implode(", ",$this->file_url), $this->files_size));
        return true;
    }

    public function upload() {
        $destination_path = APP_PATH . 'imgs\\';
        foreach ($this->data['imgs']['error'] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $this->data['imgs']['tmp_name'][$key];
                $destination_path = $destination_path . $this->data['imgs']['name'][$key];
                move_uploaded_file($tmp_name, $destination_path);
            }
        }
    }
}