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
if(isset($_POST["send"])){
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
    $pass1=check_user_input($_POST["password"]);
    $pass2=check_user_input($_POST["confirmpassword"]);
    $nationality=check_user_input($_POST["nationality"]);
    $gender=check_user_input($_POST["gender"]);

    /////////////////////////////////////////////

    if(empty($name)){
       $error_array["name1"] = "<span> <font color='red' > please enter your name </font> </span>";
    }
    elseif(is_numeric($name)){
        $error_array["name2"] = "<span> <font color='red' > name must be text </font> </span>";
    }
    if(strlen($name)>25){
        $error_array["name3"] = "<span> <font color='red' > name is too long </font> </span>";
    }
    ////////////////////////////////////////////////////

    if(empty($email)){
        $error_array["email1"] = "<span> <font color='red' > please enter your email </font> </span>";
    }
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $error_array["email2"] = "<span> <font color='red' > your email is not valid </font> </span>";
    }

    if(empty($pass1)){
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
    elseif(!is_string($nationality)){
        $error_array["nation2"] = "<span> <font color='red' > the nationality is not valid  </font> </span>";
    }
    
    //print_r($_POST);
    if(empty($error_array)){
        $query="INSERT INTO users(u_name, u_email, u_password, u_phone, u_nationality, u_gender, u_priv) 
        VALUES (?,?,?,?,?,?,?)";

        $s=$con->prepare($query); //فحص الجملة
        $s->execute(array($name,$email,$hash_pass,$phone,"yemeni",$gender,2));

        if($s->rowCount()){
            echo "one row inserted";

        }else{
            echo "Failed Inserted try again";
        }
    }
}

?>






                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-plus-circle"></i> Add New User
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form role="form"  method="post"  >
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" placeholder="Please Enter your Name " name="username" class="form-control" value="<?php if(!empty($name)) echo $name;?>" />
                                        </div>
                                        <?php  
                        if(isset($error_array["name1"])) echo  $error_array["name1"];
                        if(isset($error_array["name2"])) echo  $error_array["name2"]."<br>";
                        if(isset($error_array["name3"])) echo  $error_array["name3"];
                    ?>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email"  placeholder="PLease Enter Eamil" value="<?php if(!empty($email)) echo $email;?>" />
                                         </div>
                                         <?php  if(isset($error_array["email1"])) echo  $error_array["email1"];
                         if(isset($error_array["email2"])) echo  $error_array["email2"];
                          ?>
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" class="form-control" name="phone" placeholder="PLease Enter Phone" value="<?php if(!empty($phone)) echo $phone;?>" />
                                          </div>
                                          <?php 
                        if(isset($error_array["phone1"])) echo  $error_array["phone1"]."<br>";
                        if(isset($error_array["phone2"])) echo  $error_array["phone2"]."<br>";
                        if(isset($error_array["phone3"])) echo  $error_array["phone3"];
                    
                        ?>

                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password" placeholder="Please Enter password" value="<?php if(!empty($pass1)) echo $pass1;?>">
                                         </div>
                                         <?php
                        if(isset($error_array["password1"])) echo  $error_array["password1"];
                        if(isset($error_array["password2"])) echo  $error_array["password2"]."<br>";
                        if(isset($error_array["password3"])) echo  $error_array["password3"];
                        ?>

                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control" name="confirmpassword" placeholder="Please Enter confirm password" value="<?php if(!empty($pass2)) echo $pass2;?>">
                                          </div>
                                          <?php
                        if(isset($error_array["confpass1"])) echo  $error_array["confpass1"];
                        if(isset($error_array["confpass2"])) echo  $error_array["confpass2"];
                        
                        ?>

<label>nationality</label>
<br>
<div class="form-group">

                        <div class="input-group">
                        
                        
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="text" name='nationality' value="yemeni" class="form-control" placeholder="nationality" />
                        </div>
                        <?php 
                        if(isset($error_array["nation1"])) echo  $error_array["nation1"]."<br>";
                        if(isset($error_array["nation2"])) echo  $error_array["nation2"]."<br>";
                        ?>
                    </div>
                    
                                          <div class="form-group">
                                                <label>gender</label>
                                          <select name="gender">
                          <option value="male"> male </option>
                          <option value="fmale"> fmale </option>

                    </select></div>

                                            <div class="form-group">
                                                <label>User Type</label>
                                                <select class="form-control" name="privilege">
                                                <?php
                                                        $q="select * from privleges";
                                                        $s=$con->prepare($q);
                                                        $s->execute();

                                                        if($s->rowCount()){
                                                            foreach($s->fetchAll() as $row){
                                                                $p_n=$row["p_name"];
                                                                echo "<option value='$p_n'>$p_n</option>";
                                                            }
                                                        }
                                                ?>
                                                <option>User</option>
                                                </select>
                                                    

                                                    
                                            </div>
                                            <div style="float:right;">
                                                <button type="submit" class="btn btn-primary " name="send">Add User</button>
                                                <button type="reset" class="btn btn-danger">Cancel</button>
                                            </div>

                                    </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>                    <hr />

                    <div class="row">
                        <div class="col-md-12">
                            <!-- حذف صف -->
                             <?php
                            if(isset($_GET["code"])){
        $product_code=$_GET["code"];
        $q="delete from users where u_id=:x";
        $s=$con->prepare($q);
        $s->execute(array("x"=>$product_code));
        if($s->rowCount()){
            echo "<font color='green'> one row deleted </font>";
        }
        else{
            echo "<font color='green'> Failed deleted </font>";
        }
       }
     ?>
                            <!--   كود الحذف-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-users"></i> Users
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover"
                                            id="dataTables-example">
                                            <thead>
                                                <tr>
                                                <th>No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Privilege</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            <?php 
                                            $q="select u_id , u_name , u_email , u_phone , p_name from users inner join privleges on privleges.p_id =users.u_priv";
                                            $s=$con->prepare($q);
                                            $s->execute();
                                            $x=0;
                                            foreach($s->fetchAll() as $row){
                                                $u_name=$row["u_name"];
                                                $u_id=$row["u_id"];
                                                $u_email=$row["u_email"];
                                                $u_phone=$row["u_phone"];
                                                $p_name=$row["p_name"];
                                                $x++;
                                                echo"<tr class='odd gradeX'>
                                                <td>$u_id</td>
                                                    <td>$u_name</td>
                                                    <td>$u_email</td>
                                                    <td>$u_phone</td>
                                                    <td class='center'>$p_name</td>

                                                    <td>
                                                        <a href='edit_user.php?code=$u_id' class='btn btn-success'>Edit</a>
                                                        <a href='?code=$u_id' class='btn btn-danger' id='delete'>Delete</a>
                                                    </td>
                                                </tr>
                                                ";
                                            }?>

                                                
                                                
                                            </tbody>
                             
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <!--End Advanced Tables -->
                        
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