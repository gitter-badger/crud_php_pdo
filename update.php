<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
       $nameError = null;
        $deptError = null;
        $rollError = null;
        $sessionError = null;
        $emailError = null;
        $mobileError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $dept = $_POST['dept'];
        $roll = $_POST['roll'];
        $session = $_POST['session'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
         
        // validate input
            $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
		if (empty($dept)) {
            $nameError = 'Please enter dept';
            $valid = false;
        }
		if (empty($roll)) {
            $nameError = 'Please enter Roll';
            $valid = false;
        }
		if (empty($session)) {
            $nameError = 'Please enter Session';
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
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE students  set name = ?, dept = ?, roll = ?, session = ?, email = ?, mobile =? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$dept,$roll,$session,$email,$mobile, $id));
            Database::disconnect();
            header("Location: index.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM students where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['name'];
        $dept = $data['dept'];
        $roll = $data['roll'];
        $session = $data['session'];
        $email = $data['email'];
        $mobile = $data['mobile'];
        Database::disconnect();
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
                        <h3>Update a Student</h3>
                    </div>
             
                    <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
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
                            <input name="roll" type="text"  placeholder="Roll" value="<?php echo !empty($roll)?$roll:'';?>">
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
                            <input name="mobile" type="text"  placeholder="Mobile Number" value="<?php echo !empty($mobile)?$mobile:'';?>">
                            <?php if (!empty($mobileError)): ?>
                                <span class="help-inline"><?php echo $mobileError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  <br>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
						  
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
 
 