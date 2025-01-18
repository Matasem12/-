<?php
include("heder.php")
?>
    <center>
        <div class="main" style=" background-color:white">
            <?php
            //enctype="multipart/form-data" هذا ضروري عند ارسال نصوص مع ملفات 
            ?>
            <form action="insert.php" method="post" enctype="multipart/form-data">
                <h2>موقع تسويق اونلاين</h2>
                <img src="sss.jpg" alt="logo" width="450px">
                <br>
                <input type="text" name="name"  placeholder="اسم المنتج">
                <br>
                <br>
                <input type="text" name="price" placeholder="السعر">
                <br>
                <input type="file" id="file" name="image" >
                <label for="file">اختيار صورة للمنتج</label>
                <button name="upload">رفع المنتج</button>
                <br><br>
                <a href="products.php">عرض كل المنتجات</a>

            </form>
        </div>
        <p></p>
    </center>
</body>

</html>