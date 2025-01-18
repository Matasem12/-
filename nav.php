<?php include "heder.php";
require "db_connect.php";
?>

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
    $email=check_user_input($_POST["useremail"]);
    $phone=check_user_input($_POST["phone"]);
    $pass1=check_user_input($_POST["password1"]);
    $pass2=check_user_input($_POST["password2"]);
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

    if(empty($nationality)){
        $error_array["nation1"] = "<span> <font color='red' > please enter your  nationality  </font> </span>";
    }
    elseif(!is_string($nationality)){
        $error_array["nation2"] = "<span> <font color='red' > the nationality is not valid  </font> </span>";
    }
    
    //print_r($_POST);
    if(empty($error_array)){
        $query="INSERT INTO users(u_name, u_email, u_password, u_phone, u_nationality, u_gender, u_priv) 
        VALUES (?,?,?,?,?,?,3)";

        $s=$con->prepare($query); //فحص الجملة
        $s->execute(array($name,$email,$hash_pass,$phone,$nationality,$gender));

        if($s->rowCount()){
            echo "تم ادراج صف واحد ";

        }else{
            echo "فشل إدراج حاول مرة أخرى";
        }
    }
}

?>

<div id="fullscreen_bg" class="fullscreen_bg">
 <form class="form-signin" method="post" style="margin: inherit;margin-top: 80px;">
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
        <div class="panel panel-primary">
        
            <h3 class="text-center">
                        اضافه حساب</h3>
        
        <div class="panel-body">   
        
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
                            </span>
                            <input type="text" class="form-control" name="username"  value= "<?php if(!empty($name)) echo $name;?> " placeholder="username" />
                        </div>
                        <?php  
                        if(isset($error_array["name1"])) echo  $error_array["name1"];
                        if(isset($error_array["name2"])) echo  $error_array["name2"]."<br>";
                        if(isset($error_array["name3"])) echo  $error_array["name3"];
                    ?>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input type="Email" class="form-control" name='useremail' placeholder="Email"  />
                        </div>
                        <?php  if(isset($error_array["email1"])) echo  $error_array["email1"];
                         if(isset($error_array["email2"])) echo  $error_array["email2"];
                          ?>
                       
                    </div>
                    
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name='password1' class="form-control" placeholder="New Password" />
                        </div>
                        <?php
                        if(isset($error_array["password1"])) echo  $error_array["password1"];
                        if(isset($error_array["password2"])) echo  $error_array["password2"]."<br>";
                        if(isset($error_array["password3"])) echo  $error_array["password3"];
                        ?>
                    </div>
					
								<div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name='password2' class="form-control" placeholder="Confirm Password" />
                        </div>
                        <?php
                        if(isset($error_array["confpass1"])) echo  $error_array["confpass1"];
                        if(isset($error_array["confpass2"])) echo  $error_array["confpass2"];
                        
                        ?>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="text" name='phone' class="form-control" placeholder="Phone" />
                        </div>
                        <?php 
                        if(isset($error_array["phone1"])) echo  $error_array["phone1"]."<br>";
                        if(isset($error_array["phone2"])) echo  $error_array["phone2"]."<br>";
                        if(isset($error_array["phone3"])) echo  $error_array["phone3"];
                    
                        ?>
                    </div>

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
                    
                    <select name="gender">
                          <option value="male"> ذكر </option>
                          <option value="fmale"> انثى </option>

                    </select>

                        <input class="btn btn-lg btn-primary btn-block" type="submit" value='Create Account' name='send'>
      </div>
       </div>
        </div>
    </div>
</div>
</form>

<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>