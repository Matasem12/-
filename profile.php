<?php
// بدء الجلسة
session_start();

// التحقق من تسجيل الدخول
if (!isset($_SESSION['userId'])) {
  header('location:login.php'); // إذا لم يكن المستخدم مسجل الدخول، يتم توجيهه إلى صفحة تسجيل الدخول
}

// تضمين ملفات إضافية
require "assets/function.php"; // ملف يحتوي على دوال مساعدة
require 'assets/db.php'; // ملف الاتصال بقاعدة البيانات

// معالجة تحديث بيانات المستخدم
$notice = ""; // متغير لعرض الإشعارات

if (isset($_POST['saveSetting'])) { // التحقق من إرسال النموذج
  if ($con->query("UPDATE users SET name='$_POST[name]', number='$_POST[number]' WHERE id='$_SESSION[userId]'")) {
    $notice = "<div class='alert alert-success'>تم الحفظ بنجاح</div>"; // إشعار نجاح
    header("location:profile.php?notice=تم الحفظ بنجاح"); // إعادة توجيه مع إشعار
  } else {
    $notice = "<div class='alert alert-danger'>خطأ: " . $con->error . "</div>"; // إشعار خطأ
  }
}

if (isset($_GET['notice'])) { // التحقق من وجود إشعار في الرابط
  $notice = "<div class='alert alert-success'>" . $_GET['notice'] . "</div>"; // عرض الإشعار
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo siteTitle(); ?></title> <!-- عرض عنوان الموقع -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- تضمين Bootstrap -->
  <style>
    body {
      background: #ECF0F5;
      padding: 0;
      margin: 0;
    }
    .dashboard {
      position: fixed;
      width: 18%;
      height: 100%;
      background: #222D32;
    }
    .dashboard a {
      color: white;
      text-decoration: none;
    }
    .dashboard .flex {
      display: flex;
      align-items: center;
    }
    .dashboard .item ul {
      list-style: none;
      padding: 0;
    }
    .dashboard .item ul li {
      padding: 10px;
      border-bottom: 1px solid #1A2226;
    }
    .dashboard .item ul li:hover {
      background: #1E282C;
    }
    .marginLeft {
      margin-left: 18%;
    }
    .content2 {
      padding: 20px;
    }
    .center {
      text-align: center;
    }
    .well {
      background: white;
      border-radius: 5px;
      padding: 20px;
    }
  </style>
</head>
<body>
  <!-- الشريط الجانبي -->
  <div class="dashboard">
    <div style="background:#357CA5;padding: 14px 3px;color:white;font-size: 15pt;text-align: center;text-shadow: 1px 1px 11px black">
      <a href="index.php"><?php echo strtoupper(siteName()); ?></a> <!-- عرض اسم الموقع -->
    </div>
    <div class="flex" style="padding: 3px 7px;margin:5px 2px;">
      <div><img src="photo/<?php echo $user['pic'] ?>" class='img-circle' style='width: 77px;height: 66px'></div> <!-- عرض صورة المستخدم -->
      <div style="color:lightgreen;font-size: 13pt;padding: 14px 7px;margin-left: 11px;"><?php echo ucfirst($user['name']); ?></div> <!-- عرض اسم المستخدم -->
    </div>
    <div style="background: #1A2226;font-size: 10pt;padding: 11px;color: #79978F">القائمة</div>
    <div>
      <div style="background:#1E282C;color: white;padding: 13px 17px;border-left: 3px solid #3C8DBC;"><span><i class="fa fa-dashboard fa-fw"></i> لوحة التحكم</span></div>
      <div class="item">
        <ul class="nostyle zero">
          <a href="index.php"><li><i class="fa fa-circle-o fa-fw"></i> الرئيسية</li></a>
          <a href="inventeries.php"><li><i class="fa fa-circle-o fa-fw"></i> المنتجات</li></a>
          <a href="addnew.php"><li><i class="fa fa-circle-o fa-fw"></i> اضافة منتج جديد</li></a>
          <a href="reports.php"><li><i class="fa fa-circle-o fa-fw"></i> الفواتير</li></a>
        </ul>
      </div>
    </div>
    <div style="background:#1E282C;color: white;padding: 13px 17px;border-left: 3px solid #3C8DBC;"><span><i class="fa fa-globe fa-fw"></i> اعدادات اخرى</span></div>
    <div class="item">
      <ul class="nostyle zero">
        <a href="sitesetting.php"><li style="color: white"><i class="fa fa-circle-o fa-fw"></i> اعدادات المتجر</li></a>
        <a href="profile.php"><li><i class="fa fa-circle-o fa-fw"></i> الملف الشخصي👨‍💻</li></a>
        <a href="accountSetting.php"><li><i class="fa fa-circle-o fa-fw"></i> بيانات الحساب</li></a>
        <a href="logout.php"><li><i class="fa fa-circle-o fa-fw"></i> تسجيل الخروج</li></a>
      </ul>
    </div>
  </div>

  <!-- الجزء الرئيسي من الصفحة -->
  <div class="marginLeft">
    <div style="color:white;background:#3C8DBC">
      <div class="pull-right flex rightAccount" style="padding-right: 11px;padding: 7px;">
        <div><img src="photo/<?php echo $user['pic'] ?>" style='width: 41px;height: 33px;' class='img-circle'></div>
        <div style="padding: 8px"><?php echo ucfirst($user['name']) ?></div>
      </div>
      <div class="clear"></div>
    </div>
    <div class="content2">
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> لوحة التحكم</a></li>
        <li class="active">الملف الشخصي👨‍💻</li>
      </ol>
      <?php echo $notice ?> <!-- عرض الإشعارات -->
      <div style="width: 55%;margin: auto;padding: 22px;" class="well well-sm center">
        <h4>اعدادات الملف الشخصي</h4><hr>
        <form method="POST">
          <div class="form-group">
            <label for="some" class="col-form-label">الاسم</label>
            <input type="text" name="name" class="form-control" value="<?php echo $user['name'] ?>" id="some" required>
          </div>
          <div class="form-group">
            <label for="some" class="col-form-label">رقم الهاتف</label>
            <input type="text" name="number" value="<?php echo $user['number'] ?>" class="form-control" id="some" required>
          </div>
          <div class="center">
            <button class="btn btn-primary btn-sm btn-block" name="saveSetting">حفظ✔</button>
          </div>   
        </form>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
    $(document).ready(function() {
      $(".rightAccount").click(function() {
        $(".account").fadeToggle(); // إظهار/إخفاء قسم الحساب عند النقر
      });
    });
  </script>
</body>
</html>