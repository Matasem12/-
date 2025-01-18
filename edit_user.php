<?php
include ("heder.php");
require "db_connect.php";
?>
</nav>         <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2><i class="fa fa-users"></i> Users</h2>
                   </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-8">
                        <!-- Form Elements -->
                         <?php
                         if(isset($_GET["code"])){
                            $user_id=$_GET["code"];  
                            $q="select u_id, u_name , u_email , u_phone , u_gender , u_nationality , u_status , p_name from users inner join privleges on privleges.p_id =users.u_priv where u_id=?  ";
                            $s=$con->prepare($q);
                                            $s->execute(array($user_id));
                                            
                                            if($s->rowCount()){
                                                foreach($s->fetchAll() as $row){

                                                    $u_name=$row["u_name"];
                                                    $u_id=$row["u_id"];
                                                    $u_email=$row["u_email"];
                                                    $u_phone=$row["u_phone"];
                                                    $p_name=$row["p_name"];
                                                    $u_gender=$row["u_gender"];
                                                    $u_status=$row["u_status"];
                                                    $u_nationality=$row["u_nationality"];
     

                                                }
                                            }
                                               


if(isset($_POST["edit"])){
    function check_user_input($input){
        $input=trim($input);
        $input=htmlentities($input);
        $input=htmlspecialchars($input);
        return $input;
    }
    
    ///////////////////////////////////////

    $name=check_user_input($_POST["username"]);
    $email=check_user_input($_POST["email"]);
    $phone=check_user_input($_POST["phone"]);
    $status=check_user_input($_POST["status"]);
    $privilege=check_user_input($_POST["privilege"]);
   # $nationality=check_user_input($_POST["nationality"]);
    $gender=check_user_input($_POST["gender"]);

    /////////////////////////////////////////////

    if(empty($name)){
       $error_array["name1"] = "<span> <font color='red' > please enter your name </font> </span>";
    }
    elseif(is_numeric($name)){
        $error_array["name2"] = "<span> <font color='red' > name must be text </font> </span>";
    }
    if(strlen($name)>15){
        $error_array["name3"] = "<span> <font color='red' > name is too long </font> </span>";
    }
    ////////////////////////////////////////////////////

    if(empty($email)){
        $error_array["email1"] = "<span> <font color='red' > please enter your email </font> </span>";
    }
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $error_array["email2"] = "<span> <font color='red' > your email is not valid </font> </span>";
    }

/*    if(empty($pass1)){
        $error_array["password1"] = "<span> <font color='red' > please enter your  new password </font> </span>";
    }                           //التاكد
    elseif(strlen($pass1)<6 || !preg_match('@[0-9]@',$pass1) ||  !preg_match('@[a-z]@',$pass1) || !preg_match('@[A-Z]@',$pass1) ||  !preg_match('@[#+/W#]@',$pass1)){
        $error_array["password2"] = "<span> <font color='red' > the password must be complex </font> </span>";
    
    }
    elseif (strlen($pass1)>15){
        $error_array["password3"] = "<span> <font color='red' > the password is too long </font> </span>";
    }
    else{
      $hash_pass=password_hash($pass1,PASSWORD_BCRYPT);
    }

    if(empty($pass2)){
        $error_array["confpass1"] = "<span> <font color='red' > please enter the confirm password password </font> </span>";
    }
    elseif($pass2!=$pass1){
        $error_array["confpass2"] = "<span> <font color='red' > virting in the confirm password </font> </span>";
    
    }
*/
    if(empty($phone)){
        $error_array["phone1"] = "<span> <font color='red' > please enter your  phone  </font> </span>";
    }
    elseif(!is_numeric($phone)){
        $error_array["phone2"] = "<span> <font color='red' > virting in the phone number,, it not valid </font> </span>";
    
    }
    if (strlen($phone)<5 || strlen($phone)>9){
        $error_array["phone3"] = "<span> <font color='red' > virting in the phone number size,, it not valid </font> </span>";
    }

    /*if(empty($nationality)){
        $error_array["nation1"] = "<span> <font color='red' > please enter your  nationality  </font> </span>";
    }*/
  /*  elseif(!is_string($nationality)){
        $error_array["nation2"] = "<span> <font color='red' > the nationality is not valid  </font> </span>";
    }
    */
    //print_r($_POST);
    if(empty($error_array)){

        $q="update users set u_name=? , u_email=? , u_phone=? , u_gender=? , u_priv=? , u_status=? 
        where u_id=? ";
        $s=$con->prepare($q);
        $s->execute(array($name,$email,$phone,$gender,$privilege,$status,$user_id));
        if($s->rowCount()){
            echo "<font color='green'> one row updated </font>";
        }
        else{
            echo "<font color='green'> Failed updated </font>";
        }

    }
}
                         }
?>






                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-plus-circle"></i> edit data User
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form" method="POST">
                                            <div class="form-group">
                                                <label>edit Name</label>
                                                <input type="text" value="<?php echo $u_name ?>" placeholder="Please Enter your Name " name="username" class="form-control" />
                                        </div>
                                            <div class="form-group">
                                                <label>edit Email</label>
                                                <input type="email"  value="<?php echo $u_email ?>" class="form-control" name="email"  placeholder="PLease Enter Eamil" />
                                         </div>
                                            <div class="form-group">
                                                <label>edit Phone</label>
                                                <input type="text"  value="<?php echo $u_phone ?>" class="form-control" name="phone" placeholder="PLease Enter Phone" />
                                          </div>
                                            
                                          <div class="form-group">
                                                <label>edit gender</label>
                                          <select name="gender" >
                          <?php      echo "<option value='$u_gender'>$u_gender</option>"; ?>
                          <option value="male"> male </option>
                          <option value="fmale"> fmale </option>


                          
                    </select></div>

                    <div class="form-group">
                                                <label>status</label>
                                          <select name="status" >
                          
                          <option value="1"> Enable </option>
                          <option value="0"> UnEnable </option>


                          
                    </select></div>

                                            <div class="form-group">
                                                <label>edit User Type</label>
                                                <select class="form-control" name="privilege" >
                                                <?php
                                                     
                                                      #echo "<option value='$p_name'>$p_name</option>";
                                                        $q="select * from privleges";
                                                        $s=$con->prepare($q);
                                                        $s->execute();
                                                        $x=2;
                                                        if($s->rowCount()){
                                                            foreach($s->fetchAll() as $row){
                                                                $p_n=$row["p_name"];
                                                                echo "<option value='$x'>$p_n</option>";
                                                                $x++;
                                                            }
                                                        }
                                                ?>
                                                <option>User</option>
                                                </select>
                                                    

                                                    
                                            </div>
                                            <div style="float:right;">
                                                <button type="submit" class="btn btn-primary" name="edit">edit User</button>
                                                <button type="reset" class="btn btn-danger">Cancel</button>
                                            </div>

                                    </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>                    <hr />

                    </div>
             
                    <!-- /. ROW  -->
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
   </div>
   
   <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>

<script>
 $("#delete").click(function(){
    return confirm("are you sure to delete this item");
 });
</script>