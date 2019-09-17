<?php 
	include_once 'includes/bootstrap.php';
    
    if(isset($_GET['search'])) {
        $keyword = $_GET['search'];
    }

    $category = get_data('category');
    $meal_type = get_data('meal_type');
    $ingredient = get_data('ingredients');

    $searchResults = array();

    $searchConst = 'include';
    if(isset($_GET['ing-specifier'])) {
        $searchConst = $_GET['ing-specifier'];
    }
    
    if(!empty($keyword)) {
        // Search Keyword in receipe 
        $db = (new Database)->getConnection();
        

        $post_ids = array();

        //Filter results with Ingredient
        $filter_use = false;
        // First filter will run without empty post_ids check
        if(isset($_GET['ingredient']) && !empty($_GET['ingredient'])) {
            $filter_use = true;
            //ingredient search in the search result
            $query = 'SELECT recipe_id FROM `recipe_ingredient` WHERE `ingredient_id` = ' . $_GET['ingredient'];
            $stmt = $db->prepare($query);
            $stmt->execute();
            $post_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
        }
       
        //Filter Results with Category 
        if(isset($_GET['category']) && !empty($_GET['category'])) {
            $filter_use = true;
            //ingredient search in the search result
            $query = 'SELECT * FROM `recipe_category` WHERE `category_id` = '.$_GET['category'];

            if(!empty($post_ids)) {
                $query .=  ' AND `recipe_id` IN ('. implode(',', $post_ids). ')';
            }
            
            $stmt = $db->prepare($query);
            $stmt->execute();
            $post_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);
        }

        if($filter_use === false || !empty($post_ids)) {
            if($searchConst == 'exclude')
                $query = 'SELECT * FROM recipe WHERE (name NOT LIKE "%'.$keyword.'%" AND description NOT LIKE "%'.$keyword.'%")';
            else
                $query = 'SELECT * FROM recipe WHERE (name LIKE "%'.$keyword.'%" OR description LIKE "%'.$keyword.'%")';

            $meal_type_ids = array_column($meal_type, 'id');
            if(isset($_GET['meal_type']) && in_array($_GET['meal_type'], $meal_type_ids)  ){
                //If meal type is valid then add it to query
                $query .= ' AND meal_type_id = '. $_GET['meal_type'];
            }
            
            // Put constraints to selective posts
            if(!empty($post_ids)) {
                $query .= ' AND id IN ('. implode(',', $post_ids).')';
            }
            $stmt = $db->prepare($query);
            // print_r($query); die;

            $stmt->execute();
            $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $searchResults = array();
        }

    }
    

    include_once 'partials/header.php';
?>
	<main class="container content">
		<div class="row">
        	<div class="col-lg-12">
            	<div class="ibox float-e-margins">
                	<div class="ibox-content">
                    	<h2> <?php count($searchResults); ?> results found for: <span class="text-navy">"<?php echo $keyword; ?>"</span></h2>
        
	                    <div class="search-form">
	                        <form action="search.php" method="get">
                                
                                <div class="row pt-4">
                                    <div class="col-md-12">
                                        <input type="text" value="<?php echo $keyword; ?>" name="search" class="form-control input-lg">
                                        <div class="form-group">
                                            <label for="ing-specifier-with">
                                                <input type="radio" name="ing-specifier" value="include" <?php if($searchConst == 'include') echo 'checked';?> /> With
                                            </label>
                                            <label for="ing-specifier-without">
                                                <input type="radio" name="ing-specifier" value="exclude" <?php if($searchConst == 'exclude') echo 'checked';?> /> Without
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-12 pb-0 mb-0">
                                        <h6>Advanced Filter Options </h6>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="ingredient">Ingredients</label>
                                        <select name="ingredient" class="form-control" id="ingredient">
                                        <option value="" <?php if(!isset($_GET['ingredient'])) echo 'selected'; ?>> -- Select Ingredient -- </option>
                                            <?php
                                            foreach($ingredient as $row) {
                                                echo '<option value="'. $row['id'] .'"';
                                                if(isset($_GET['ingredient']) && $row['id'] == $_GET['ingredient']) echo 'selected';
                                                echo '>'.$row['name'].'</option>';
                                            }
                                            ?>
                                        </select>
                                        
                                    </div>

                                    <div class="form-group col-lg-4">
                                        <label for="category">Category</label>
                                        <select name="category" class="form-control" id="category">
                                        <option value="" <?php if(!isset($_GET['category'])) echo 'selected'; ?>> -- Select Category -- </option>
                                            <?php
                                            foreach($category as $row) {
                                                echo '<option value="'. $row['id'] .'"';
                                                if(isset($_GET['category']) && $row['id'] == $_GET['category']) echo 'selected';
                                                echo '>'.$row['name'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-lg-4">
                                        <label for="meal_type">Meal Type</label>
                                        <select name="meal_type" class="form-control" id="meal_type">
                                            <option value="" <?php if(!isset($_GET['meal_type'])) echo 'selected'; ?>> -- Select Meal Type -- </option>
                                            <?php
                                            foreach($meal_type as $row) {
                                                echo '<option value="'. $row['id'] .'"';
                                                if(isset($_GET['meal_type']) && $row['id'] == $_GET['meal_type']) echo 'selected';
                                                echo '>'.$row['name'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
	                           <button class="btn btn-primary" type="submit">Search</button>
	                        </form>
	                    </div>
                        <?php if(!empty($searchResults)) {
                            foreach($searchResults as $searchItem) { ?>
                                <div class="hr-line-dashed"></div>
                                <div class="search-result">
                                    <h3><a href="single-post.php?id=<?php echo $searchItem['id']; ?>"><?php echo $searchItem['name']; ?></a></h3>

                                    <p><?php echo strip_tags(substr($searchItem['description'],0,get_setting('excerpt_length_search'))).'...';?></p>
                                    <a href="<?php echo get_config('app','url'). '/single-post.php?id='. $searchItem['id']; ?>" class="search-link">View this post</a>
                                    <p>

                                    </p>
                                </div>
                          <?php  }
                        } else {
                            echo 'No Results found.';
                        } ?>
                </div>
            </div>
        </div>
    </div>
	</main>
<?php
include_once 'partials/footer.php'; 