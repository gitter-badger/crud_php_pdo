<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $deptError = null;
        $rollError = null;
        $sessionError = null;
        $emailError = null;
        $mobileError = null;
		$imageError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $dept = $_POST['dept'];
        $roll = $_POST['roll'];
        $session = $_POST['session'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $image = '$myPhoto';
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
		if (empty($dept)) {
            $deptError = 'Please enter dept';
            $valid = false;
        }
		if (empty($roll)) {
            $rollError = 'Please enter Roll';
            $valid = false;
        }
		if (empty($session)) {
            $sessionError = 'Please enter Session';
            $valid = false;
        }
         
        if (empty($email)) {
            $emailError = 'Please enter Email Address';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }
         
        if (empty($mobile)) {
            $mobileError = 'Please enter Mobile Number';
            $valid = false;
        }
		//Image Upload begins
		if($_FILES['myPhoto']['tmp_name'])
		{
			//If no error while uploading
			if(!$_FILES['myPhoto']['error'])
			{
				$image=basename($_FILES['myPhoto']['name']);
				$image=str_replace(' ','|',$image);
				$path="image/".$image;
				$check = getimagesize($_FILES["myPhoto"]["tmp_name"]);
				if($check !== false) {
					$valid_file = true;
				}
				else {
					$valid_file = false;
					$message = "Uploaded File is not a valid image file";
				}
				
				//if the file has passed the test
				if($valid_file)
				{
					//move the file to the image location
					move_uploaded_file($_FILES['myPhoto']['tmp_name'], $path);
					$imageUploaded = true;
				}
			}
			//if there is an error
			else
			{
				//if upload failed
				$message = 'Ooops!  Image Upload encountered following error:  '.$_FILES['photo']['error'];
				$imageUploaded = false;
			}
		}
		
         // if($imageUploaded){
		  
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO students (name,dept,roll,session,email,mobile,image) values(?, ?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$dept,$roll,$session,$email,$mobile,$image));
            Database::disconnect();
            header("Location: index.php");
         }
		//}else {
			//$success = $message; 
		//}
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
     <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Adding New Student</h3>
                    </div>
					
				<script type="text/javascript">
					function PreviewImage() {
						var oFReader = new FileReader();
						
						oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

						oFReader.onload = function (oFREvent) {
							document.getElementById("uploadPreview").src = oFREvent.target.result;
						};
					};

				</script> 
             
                    <form class="form-horizontal" action="create.php" method="post" enctype="multipart/form-data">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  
					   <div class="control-group <?php echo !empty($deptError)?'error':'';?>">
                        <label class="control-label">Dept</label>
                        <div class="controls">
                            <input name="dept" type="text"  placeholder="dept" value="<?php echo !empty($dept)?$dept:'';?>">
                            <?php if (!empty($deptError)): ?>
                                <span class="help-inline"><?php echo $deptError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  
					   <div class="control-group <?php echo !empty($rollError)?'error':'';?>">
                        <label class="control-label">Roll</label>
                        <div class="controls">
                            <input name="roll" type="number"  placeholder="Roll" value="<?php echo !empty($roll)?$roll:'';?>">
                            <?php if (!empty($rollError)): ?>
                                <span class="help-inline"><?php echo $rollError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  
					  <div class="control-group <?php echo !empty($sessionError)?'error':'';?>">
                        <label class="control-label">Session</label>
                        <div class="controls">
                            <input name="session" type="text"  placeholder="Session" value="<?php echo !empty($session)?$session:'';?>">
                            <?php if (!empty($sessionError)): ?>
                                <span class="help-inline"><?php echo $sessionError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  
                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
                        <label class="control-label">Mobile Number</label>
                        <div class="controls">
                            <input name="mobile" type='tel' pattern='[\+]\d{10}' title='Phone Number (Format: +01722835935)'  placeholder="Mobile Number" value="<?php echo !empty($mobile)?$mobile:'';?>">
                            <?php if (!empty($mobileError)): ?>
                                <span class="help-inline"><?php echo $mobileError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  
					 
					  
					  <div class="control-group <?php echo !empty($imageError)?'error':'';?>">
                        <label class="control-label">Imager</label>
                        <div class="controls">
                            <img id="uploadPreview" style="width: 300px; height: 200px;"  />
                            <input id="uploadImage" type="file" name="myPhoto" onchange="PreviewImage();"  />
					  
                            <?php if (!empty($imageError)): ?>
                                <span class="help-inline"><?php echo $imageError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
           
    </div> <!-- /container -->
  </body>
</html>
 