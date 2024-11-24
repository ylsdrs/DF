<?php
// الاتصال بقاعدة البيانات
$conn = mysqli_connect("localhost", "root", "", "eastern_restaurant");

if (!$conn) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            echo "<p>تم تسجيل الدخول بنجاح! <a href='index.html'>العودة إلى الصفحة الرئيسية</a></p>";
        } else {
            echo "<p>كلمة المرور غير صحيحة! <a href='signin.html'>حاول مجددًا</a></p>";
        }
    } else {
        echo "<p>البريد الإلكتروني غير مسجل! <a href='signup.html'>إنشاء حساب</a></p>";
    }
}

mysqli_close($conn);
?>
