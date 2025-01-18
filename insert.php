<?php

require('config.php');

if(isset($_POST['upload'])){
    $NAME=$_POST['name'];
    $PRICE=$_POST['price'];
    $IMAGE=$_FILES['image'];
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/marting/user/images/';
   $uploadFile = $uploadDir . basename($_FILES['image']['name']);
   // $image_location=$_FILES['image']['tmp_name'];
    $image_name=$_FILES['image']['name'];
    $image_up= "/marting/user/images/".$image_name;
    $insert="INSERT INTO prod (name , price , image) VALUES ('$NAME','$PRICE','$image_up')";
    //mysqli_query($con,$insert); #فتح الاتصال مع قاعدة البيانات
    $im=$con->prepare($insert);
    $im->execute();
    if(move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)){ //
        echo "<script>alert('تم رفع المنتج بنجاح') </script>";

    }
    else{
          echo "<script>alert('حدثت مشكلة ، لم يتم رفع المنتج ') </script>";
    }

    header('location:index.php');

}

?>


<?php
/*
if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
  
   

    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        echo "File is valid and was successfully uploaded.\n";
    } else {
        echo "Possible file upload attack!\n";
    }
} else {
    echo "File upload error: " . $_FILES['image']['error'];

}
    */
