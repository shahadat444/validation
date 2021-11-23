<?php include_once '../model-1/db_config.php'?>
<?php
$miss1=$miss2=$miss3=$success="";
$ADD_PRODUCT_NAME=$ADD_PRODUCT_CODE="";
        if ($_SERVER['REQUEST_METHOD']=="POST") {
      $ADD_PRODUCT_NAME =trim($_POST['ADD_PRODUCT_NAME']);
      $ADD_PRODUCT_CODE =trim($_POST['ADD_PRODUCT_CODE']);
            if (empty($ADD_PRODUCT_NAME)||empty($ADD_PRODUCT_CODE)) {
            if (empty($ADD_PRODUCT_NAME)&&empty($ADD_PRODUCT_CODE)) {
                   $miss1 = "kindly fill up the from";
               }
               elseif (empty($ADD_PRODUCT_NAME)) {
                   $miss2 = "kindly add product name";
               }
               elseif (empty($ADD_PRODUCT_CODE)) {
                  $miss3 ="kindly add product code";
               }

               $sql = "INSERT INTO product_table (ADD_PRODUCT_NAME,ADD_PRODUCT_CODE) VALUES (?, ?)";
               $sql_statment = mysqli_prepare($link,$sql);
               if ($sql_statment) {
                   mysqli_stmt_bind_param($sql_statment, "ss", $input1, $input2);
                   $input1 = $ADD_PRODUCT_NAME;
                   $input2 = $ADD_PRODUCT_CODE;
                   $execute = mysqli_stmt_execute($sql_statment);
                   if ($execute) {
                    $success="successfully added";
                    header("location: index.php");
                   }
                   else {
                       "Oops! something went wrong. please try again later.";
                   }
                }
             }
        
     }  

?>

<!DOCTYPE html>
<html>

<?php include '../view/layout/header.php';?>

<body>

    <div class="wrapper">
        <!-- Sidebar Holder -->

        <?php include '../view/layout/side_nevber.php';?>

        <!-- Page Content Holder -->
        <div id="content">
        <?php include '../view/layout/content-manu.php';?>
        <div class="container mt-5">
         <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="mb-3">
                <h3>Add_product_Type</h3>
                <?php  if (!empty($success)) {
                     echo '<span style="color:green";>'.$success.'</span>';
                        }
                  else {
                    echo '<span style="color:red";>'.$miss1.'</span>';
                  }
                  ?> 
            </div>
            <form accept="" class="shadow p-4" action="index.php" method="POST">                  
                <div class="mb-3">
                    <label for="ADD_PRODUCT_NAME">ADD_PRODUCT_NAME</label>
                    <input value="<?php echo $ADD_PRODUCT_NAME;?>" type="text" class="form-control" name="ADD_PRODUCT_NAME" id="username" placeholder="Add here">
                           <?php
                           if (!empty($miss2)) {
                           echo '<span style="color:red";>'.$miss2.'</span>';
                           }
                           
                           ?>

                <div class="mb-3">
                    <label for="ADD_PRODUCT_CODE">ADD_PRODUCT_CODE</label>
                    <input value="<?php echo $ADD_PRODUCT_CODE;?>" type="text" class="form-control" name="ADD_PRODUCT_CODE" id="Password" placeholder="Add here">
                    <?php
                           if (!empty($miss3)) {
                           echo '<span style="color:red";>'.$miss3.'</span>';
                           }
                           
                           ?>
             </div>

        <!--        <label class="mb-3">
                    <input type="checkbox" name="RememberMe"> Remember Me
                </label> 

                <a href="#" class="float-end text-decoration-none">Reset Password</a> -->

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">ADD</button>
             </div>

                <hr>

                <p class="text-center mb-0">I don't know product name? <a href="#">Find Here</a></p>
                
            </form>
        </div>
    </div>
</div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
   
    <?php include '../view/layout/js_lib.php';?>
</body>

</html>