<?php include("heder.php")
?>



       <center>
       <div class="main" style=" background-color:white">
        <h2>عرض المنتجات المتوفرة</h2>
        
       <?php

       require("config.php");
        
       if(isset($_GET["code"])){
        $product_code=$_GET["code"];
        $q="delete from prod where id=:x";
        $s=$con->prepare($q);
        $s->execute(array("x"=>$product_code));
        if($s->rowCount()){
            echo "<font color='green'> one row deleted </font>";
        }
        else{
            echo "<font color='green'> Failed deleted </font>";
        }
       }
     





       $sele="select * from prod ";
       $view=$con->prepare($sele);
       $view->execute();
       if($view->rowCount()){
        foreach($view->fetchAll() as $row){
            $p_id=$row["id"];
            echo "
            <center>

                        
       
<div class='card' style='width: 15rem; float:right;
            margin-top:20px;
            margin-left:10px;
            margin-right:10px;
'>
  <img src=' $row[image]' class='card-img-top' style=' width: 100%;
            height: 200px'; >
  <div class='card-body'>
    <h5 class='card-title'> $row[name]</h5>
    <p class='card-text'> $row[price] </p>
   
 
     <a href='?code=$p_id' class='btn btn-danger' id='delete' > delete</a>
  </div>
</div>

      





            <center> ";

        }
       }
       ?>

    </div>
</center>


<!--    <a href='update.php?code=$p_id' class='btn btn-danger' style=' background-color: blue ; border-color:blue;'> تعديل منتج</a>->
</body>

</html>

<script>
 $("#delete").click(function(){
    return confirm("are you sure to delete this item");
 });
</script>