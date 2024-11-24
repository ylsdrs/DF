<?php
$host = 'localhost'; // عنوان السيرفر
$user = 'root';      // اسم المستخدم الافتراضي
$password = '';      // كلمة المرور الافتراضية
$dbname = 'eastern_restaurant'; // اسم قاعدة البيانات

// إنشاء اتصال
$conn = new mysqli($host, $user, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
?>
