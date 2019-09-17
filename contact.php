<?php 
  include_once 'includes/bootstrap.php';
  
  if (isset($_POST['submit'])) {
    if (isset($_POST['email'])) {
        $to_email = $_POST['email'];
        $from_email = get_config('email', 'from');
        $name = $_POST['fname'].' '.$_POST['lname'];
        $message = $_POST['message'];
        $headers = "From: ". $from_email;
     
        if (mail($to_email, $name, $message, $headers)) {
          echo('Email successfully sent to $to_email...');
        } else {
          echo('Email sending failed...');
        }
      }
  }

  include_once 'partials/header.php'; 
?>
<div class="container contact">
	<div class="row">
		<div class="col-md-3">
			<div class="contact-info text-center">
				<img src="imgs/contact-image.png" alt="image"/>
				<h2>Contact Us</h2>
				<h4>We would love to hear from you !</h4>
			</div>
		</div>
		<div class="col-md-9">
			<form class="contact-form" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
				<div class="form-group">
				  <label class="control-label col-sm-2" for="fname">First Name:</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="lname">Last Name:</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="email">Email:</label>
				  <div class="col-sm-10">
					<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
				  </div>
				</div>
				<div class="form-group">
				  <label class="control-label col-sm-2" for="comment" name="message">Comment:</label>
				  <div class="col-sm-10">
					<textarea class="form-control" rows="5" id="comment"></textarea>
				  </div>
				</div>
				<div class="form-group">
				  <div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default" name="submit">Submit</button>
				  </div>
				</div>
            </form>
		</div>
	</div>
</div>
<?php 
    include_once 'partials/footer.php';