<?php

require "db_connect.php";
/*updete.php? id=row[id]
ناخذ 
*/


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> تعديل المنتج </title>
    <link rel="stylesheet" href="index.css" class="css">
</head>

<body>
    <?php

if(isset($_GET["code"])){
   $p_id=$_GET["code"];  
   $q="select * from prod where id=?  ";
   $s=$con->prepare($q);
                   $s->execute(array($p_id));
                   
                   if($s->rowCount()){
                       foreach($s->fetchAll() as $row){

                           $p_name=$row["name"];
                           $p_price=$row["price"];
                         }

    
                       }


                       if(isset($_POST["edit"])){

                       $name= $_POST["name"];
                       $price=$_POST["price"];
                        
                        $q="update prod  name=? , price=? 
                        where id=? ";
                        $s=$con->prepare($q);
                        $s->execute(array($name,$price,$p_id));
                        if($s->rowCount()){
                            echo "<font color='green'> one row updated </font>";
                        }
                        else{
                            echo "<font color='green'> Failed updated </font>";
                        }
                






                       }
        
                    }
  ?>
  <center>
         
    
             <div class="main">

                 <form action="insert.php" method="post">
                    

                     <h2>تعديل المنتجات</h2>
                     
                     <input type="text" name="name" value="<?php echo $p_name ?>">
                     <br>
                     <input type="text" name="price"  value="<?php echo $p_price ?>">
                     <br>
                     <input type="file" id="file" name="image">
                     <label for="file">تحديث صورة للمنتج</label>
                     <button name="edit">تعديل المنتج ⚙</button>
                     <br><br>
                     <a href="products.php">عرض كل المنتجات</a>
     
                 </form>
                 
             </div>
             <p></p>
         </center>
        
    
   
   
</body>

</html>