<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM students where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Read a Student</h3>
                    </div>
                         <table class="table table-striped table-bordered">
                    
                        <tr>  
							<td> Name </td>
							<td> <?php echo $data['name'];?> </td>
                   
					     </tr>
						  <tr>  
							<td> Dept </td>
							<td> <?php echo $data['dept'];?> </td>
                   
					     </tr>
						  <tr>  
							<td> Roll </td>
							<td> <?php echo $data['roll'];?> </td>
                   
					     </tr>
						  <tr>  
							<td> Session </td>
							<td> <?php echo $data['session'];?> </td>
                   
					     </tr>
						 
						<tr>  
							<td> Email Address </td>
							<td>   <?php echo $data['email'];?> </td>
                   
					     </tr>	
						<tr>  
							<td> Mobile Number </td>
							<td> <?php echo $data['mobile'];?> </td>
                   
					     </tr>	
						<tr>  
							<td> Image </td>
						    <td><img style="width: 50px; height: 50px;" src="image/<?php echo $data["image"];?>"/> </td>
 
						</tr>
                        
       
                     </table>
					   <a class="btn btn-success" href="index.php">Back</a>
                      
                  
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>
 