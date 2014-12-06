<?php

    include_once "./class/cron.php";
    include_once "./class/job.php";
     
    if ( !empty($_GET['id'])) 
    {
        $id = $_REQUEST['id'];
    }

    if ( !empty($_POST['id'])) 
    {
        $id = $_POST['id'];
    
        $cron = new Cron();

        echo "test";

        $cron->removeJob($id - 1);

        $cron->commit();

        header("Location: index.php");
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
 
<body>
    <div class="container">
     
        <div class="span10 offset1">
            <div class="row">
                <h3>Delete a Job</h3>
            </div>
             
            <form class="form-horizontal" action="delete.php" method="post">
              <input type="hidden" name="id" value="<?php echo $id;?>"/>
              <p class="alert alert-error">Are you sure to delete ?</p>
              <div class="form-actions">
                  <button type="submit" class="btn btn-danger">Yes</button>
                  <a class="btn" href="index.php">No</a>
                </div>
            </form>
        </div>
    </div>
  </body>
</html>
