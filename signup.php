<?php
// الاتصال بقاعدة البيانات
$conn = mysqli_connect("localhost", "root", "", "eastern_restaurant");

if (!$conn) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}

// التأكد من أن الطلب قادم من النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // قراءة البيانات من النموذج
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : '';

    // التحقق من عدم وجود بريد إلكتروني مكرر
    $checkQuery = "SELECT * FROM users WHERE email = '$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // البريد الإلكتروني مسجل مسبقًا
        echo "<p>البريد الإلكتروني مسجل بالفعل! <a href='signup.html'>العودة للتسجيل</a></p>";
    } else {
        // إدخال المستخدم الجديد إلى قاعدة البيانات
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if (mysqli_query($conn, $query)) {
            echo "<p>تم إنشاء الحساب بنجاح! <a href='index.html'>العودة إلى الصفحة الرئيسية</a></p>";
        } else {
            echo "<p>حدث خطأ أثناء إنشاء الحساب: " . mysqli_error($conn) . "</p>";
        }
    }
}

// إغلاق الاتصال بقاعدة البيانات
mysqli_close($conn);
?>
