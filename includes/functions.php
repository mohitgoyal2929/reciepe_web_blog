<?php
function get_config($type, $key) {
  global $config;
  return $config[$type][$key];
}

function redirect($pagename) {
  $url = get_config('app', 'url') .'/'. $pagename;
  header('Location: '. $url);
}

/*
 * USER and his Login related funcitons
 */
function is_loggedin() {
  return isset($_SESSION['user_id']);
}

function logout() {
  session_unset();
  session_destroy();
}

function check_user_login() {
  $username = isset($_POST['login_user'])? $_POST['login_user'] : null;
  $password = isset($_POST['login_pass'])? $_POST['login_pass'] : null;
  if(isset($username, $password)) {
    $user = new User();
    if($user->login($username, $password)) {
      if($user->get_role() === 'admin') 
        redirect('dashboard');
      else
        redirect('profile.php');
    } else {
      return 'Invalid Credentials.';
    }
  }
}

function is_admin() {
  if(is_loggedin()){
    $user = new User($_SESSION['user_id']);
    if($user->get_role() === 'admin') {
      return true;
    }
  }
  return false;
}

function create_user() {
  if(!empty($_POST)) {

    //Check if confirm pass equals to pass 
    if($_POST['confirm_pass'] !== $_POST['password']) {
      throw new Exception('Password don\'t match with confirm password.');
    }

    // Check if Username exists 
    if(User::findByUsername($_POST['login_user'])) {
      throw new Exception('Username already exists. Please choose something else...');
    }

    // All Validation clear. Let's create user.
    $user = new User();
    $user->set_data($_POST);
    $response = $user->save();
    return $response;
    
  }
  return false;
}

function create_user_by_admin() {
  if(!empty($_POST)) {
    $user = new User();
    $user->set_data($_POST);
    $response = $user->save();
    return $response;
  } else {
    redirect('404.php');
  }
}

function update_user() {
  if(!empty($_POST)) {
    $query = "UPDATE users SET first_name=?, last_name=?, username=?, password=? WHERE id=?";
    $data = array($_POST['first_name'], $_POST['last_name'], $_POST['login_user'], $_POST['password'], $_POST['id']);
    (new Database)->update($query, $data);
  } else {
    redirect('../404.php');
  }
}

/*
 * Post related functions
 */
function save_post() {
  if(!empty($_POST)) {     //protecting script from open access
    $post = new Recipe_post();
    if($post->set_data($_POST, $_FILES)) {
      $response = $post->save();
    } else {
      echo 'Insufficient Data or Check Type of Image (PNG/JPEG/JPG are allowed only)';
    }
    if($response != 0) {
      $post->upload();
      return $response;
    }
  } else {
    redirect('404.php');
  }
}

function img_upload($recipe_id) {
  if (!empty($_FILES)) {    //protecting script from open access
    $gallery = new Gallery();
    if($gallery->set_data($recipe_id, $_FILES)) {
      $response = $gallery->save();
    } else {
      echo 'Insufficient Data or Check Type of Images (PNG/JPEG/JPG are allowed only)';
    }
    if($response) {
      $gallery->upload();
    }
  } else {
    redirect('../404.php');
  }
}

function updateRecipe() {
  if(!empty($_POST)) {
    // print_r($_POST); die();
    $recipe_id = $_POST['recipe_id'];
    $tableRecipeGallery = 'recipe_gallery';
    $tableRecipeCategory = 'recipe_category';
    $tableRecipeIngredient = 'recipe_ingredient';
    delete_post_relation($tableRecipeCategory, $recipe_id);
    delete_post_relation($tableRecipeIngredient, $recipe_id);
    delete_post_relation($tableRecipeGallery, $recipe_id);
    
    $post = new Recipe_post();
    
    if(!empty($_FILES['file']['name'][0]))
      $setStatus = $post->set_data($_POST, $_FILES);
    else 
      $setStatus = $post->set_data($_POST);

    if($setStatus) {
      $response = $post->update();
    } else {
      $response = false;
      echo 'Insufficient Data or Check Type of Image (PNG/JPEG/JPG are allowed only)';
    }
    // If Response is success 
    if($response != false) {
      sync_category($recipe_id, $_POST['category']);
      sync_ingredient($recipe_id, $_POST['ingredient']);
    }

    if($_FILES['file']['size'] != 0 && $response != false) {
      $post->upload();
    }
    return $response;
  } else {
    redirect('../404.php');
  }
}

function delete_post_relation($tablename, $rid) {
  $db = (new Database)->getConnection();
  $query = 'DELETE from '.$tablename.' WHERE recipe_id = '.$rid;
  $stmt = $db->prepare($query);
  $stmt->execute();
}

/*
 * UPDATE/DELETE CATEGORY, MEALTYPE, INGRDIENT related funcitons
 */
function update_data($tablename) {
  if(!empty($_POST)) {
    $query = 'UPDATE ' .$tablename. ' SET name=?, description=? WHERE id=?';
    $data = array($_POST['name'], $_POST['description'], $_POST['id']);
    (new Database)->update($query, $data);
  } else {
    redirect('../404.php');
  }
}

function delete_by_id($table, $id) {
  if(!empty($_GET)) {
    (new Database)->delete($table, $id);
  } else {
    redirect('../404.php');
  }
}

function get_ingredients($rid) {
  $table_name = 'recipe_ingredient';
  $ingredient = array();
  $db = (new Database)->getConnection();
  $query = 'SELECT ingredient_id FROM '.$table_name.' WHERE recipe_id = ?';
  $stmt = $db->prepare($query);
  $stmt->execute([$rid]);
  $result = $stmt->fetchAll();
  for($i=0; $i<count($result); $i++) {
    array_push($ingredient,$result[$i][0]);
  }
  return $ingredient;
}

function get_categories($rid) {
  $table_name = 'recipe_category';
  $category = array();
  $db = (new Database)->getConnection();
  $query = 'SELECT category_id FROM '.$table_name.' WHERE recipe_id = ?';
  $stmt = $db->prepare($query);
  $stmt->execute([$rid]);
  $result = $stmt->fetchAll();
  for($i=0; $i<count($result); $i++) {
    array_push($category,$result[$i][0]);
  }
  return $category;
}

function get_mealType($id) {
  $db = (new Database)->getConnection();
  $query = 'SELECT name FROM meal_type WHERE id = '. $id;
  $stmt = $db->prepare($query);
  $stmt->execute();
  $result = $stmt->fetch();
  return $result['name'];
}

function sync_category($recipe_id, $data) {
  $table_name = 'recipe_category';
  $db = (new Database)->getConnection();
  foreach($data as $row) {
    $query = 'INSERT into '.$table_name.' (recipe_id, category_id) VALUE(?,?)';
    $stmt = $db->prepare($query);
    $stmt->execute([$recipe_id, $row]);
  }
}

function sync_ingredient($recipe_id, $data) {
  $table_name = 'recipe_ingredient';
  $db = (new Database)->getConnection();
  foreach($data as $row) {
    $query = 'INSERT into '.$table_name.' (recipe_id, ingredient_id) VALUE(?,?)';
    $stmt = $db->prepare($query);
    $stmt->execute([$recipe_id, $row]);
  }
}

/*
 * RATING RELATED FUNCTIONS
 */
function rate_recipe() {
  if(!empty($_POST)) {     //protecting script from open access
    $rating = new Rating();
    if($rating->set_data($_SESSION['user_id'], $_POST['recipe_id'], $_POST['rating'])) {
      $rating->save();
      return true;
    } else {
      echo 'Insufficient Data';
    }
  } else {
    redirect('../404.php');
  }
}

function get_rating_value($uid, $rid) {
  $value = new Rating();
  return $value->get_rating($uid, $rid);
}

function get_avg_rating($rid) {
  $r = new Recipe_post();
  return $r->Calculate_rating($rid);
}

/*
 * FAVORITE RELATED FUNCTIONS
 */
function favorite_the_recipe() {
  if(!(empty($_GET) && empty($_SESSION))) {     //protecting script from open access
    $fav = new Favorite();
    if($fav->set_data($_SESSION['user_id'], $_GET['recipe_id'])) {
      $fav->save();
      return true;
    } else {
      echo 'Insufficient Data';
    }
  } else {
    redirect('../404.php');
  }
}

function check_favorite($uid, $rid) {
  $fav = new Favorite();
  return $fav->is_favorite($uid, $rid);
}

function remove_from_favorite() {
  if(!(empty($_GET) && empty($_SESSION))) {     //protecting script from open access
    $fav = new Favorite();
    $fav->remove_favorite($_SESSION['user_id'], $_GET['recipe_id']);
    return true;
  } else {
    redirect('../404.php');
  }
}

/*
 * Settings related function
 */
function update_setting($name, $value) {
    $table_name = 'settings';

  $db = new Database();
  $db  = $db->getConnection();

  $query = 'INSERT INTO '. $table_name .'(name, value) VALUE(?,?) ON DUPLICATE KEY UPDATE value =?';
  $stmt = $db->prepare($query);
  return $stmt->execute([ $name, $value, $value ]);
}

function get_setting($name) {
  $table_name = 'settings';

  $db = (new Database())->getConnection();
  $stmt = $db->prepare('SELECT value FROM '. $table_name .' WHERE name = "'.$name.'" LIMIT 1');
  $stmt->execute();
  if($stmt->rowCount() > 0) {
    return $stmt->fetch()[0];
  } else {
    return null;
  }
  
}

/*
 * Slider related function
 */
function get_slides() {
  $table_name = 'slides';
  $db = (new Database)->getConnection();
  $stmt = $db->prepare('SELECT * FROM '. $table_name .' WHERE 1 LIMIT 10');
  $stmt->execute();
  if($stmt->rowCount() > 0) {
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  } else {
    return null;
  }
}

function add_slide($title, $description, $image_url) {
    $table_name = 'slides';
    $db = (new Database)->getConnection();
    $stmt = $db->prepare('INSERT '.$table_name.'(title, description, image_url) VALUE(?,?,?)');
    return $stmt->execute([ $title, $description, $image_url ]);
}

function delete_slide($slide_id) {
    $table_name = 'slides';
    $db = (new Database)->getConnection();
    $stmt = $db->prepare('DELETE FROM '.$table_name.' WHERE id = ?');
    return $stmt->execute([ $slide_id ]);
}

/*
 * General functions to deal with
 */
function get_data($tablename, $orderBy = '') {
  $db = (new Database)->getConnection();
  $query = 'SELECT * FROM '.$tablename . $orderBy;
  $stmt = $db->prepare($query);
  $stmt->execute();
  return $stmt->fetchAll();
}

function get_data_by_id($tablename, $id) {
  $db = (new Database)->getConnection();
  $query = 'SELECT * FROM '. $tablename . ' WHERE id = '. $id;
  $stmt = $db->prepare($query);
  $stmt->execute();
  return $stmt->fetch();
}

function insert_data($tablename) {
  if(!empty($_POST)) {
    $data = array($_POST['name'], $_POST['description']);
    $db = (new Database)->getConnection();
    $query = 'INSERT INTO '. $tablename .' (name, description) VALUES(?, ?)';
    $stmt = $db->prepare($query);
    return $stmt->execute($data);
    
  } else {
    redirect('../404.php');
  }
}

function generate_string($strength = 16) {
    $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}