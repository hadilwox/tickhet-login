<?php
session_start();

include "./include/db.php";
// For Login
if (isset($_POST['login'])) {
  $emailLog = $_POST['emailLogin'];
  $passLog = $_POST['passLogin'];

  if (empty(trim($emailLog))) {
    $invalidInputEmailLog = "ایمیل ضروری است";
  }
  if (empty(trim($passLog))) {
    $invalidInputPassLog = "رمز عبور ضروری است";
  }
  if (!empty(trim($emailLog)) && !empty(trim($passLog))) {
    if (!filter_var($emailLog, FILTER_VALIDATE_EMAIL)) {
      $invalidInputEmailLog = "ایمیل شما صحیح نیست";
    } else {
      $user = $db->prepare("SELECT * FROM subscribers WHERE email = :email AND password = :password");
      $user->execute(["email" => $emailLog, "password" => $passLog]);

      if ($user->rowCount() == 1) {
        $_SESSION['email'] = $emailLog;
        header("Location:/dashboard.php");
        exit();
      }
      header("Location:login.php?err_msg=کابری با این اطلاعات یافت نشد. ثبت نام کنید");
      exit();
    }
  }
}



// For Sign
if (isset($_POST['sign'])) {
  $emailSign = $_POST['emailSign'];
  $passSign = $_POST['passSign'];
  $usernameSign = $_POST['usernameSign'];


  if (empty(trim($emailSign))) {
    $invalidInputEmailSign = "ایمیل ضروری است";
  }
  if (empty(trim($passSign))) {
    $invalidInputPassSign = "رمز عبور ضروری است";
  }
  if (empty(trim($usernameSign))) {
    $invalidInputPassSign = "نام کاربری ضروری است";
  }

  if (!empty(trim($emailSign)) && !empty(trim($passSign)) && !empty(trim($usernameSign))) {
    if (!filter_var($emailSign, FILTER_VALIDATE_EMAIL)) {
      $invalidInputEmailLog = "ایمیل شما صحیح نیست";
    } else {
      $userEmail = $db->prepare("SELECT * FROM subscribers WHERE email = :email AND password = :password");
      $userEmail->execute(["email" => $emailSign, "password" => $passSign]);

      if ($userEmail->rowCount() == 1) {
        $invalidInputEmailSign = "این ایمیل قبلا ثبت شده است";

        $_SESSION['email'] = $emailSign;
        header("Location:/dashboard.php");
        exit();
      }
      header("Location:login.php?err_msg=کابری با این اطلاعات یافت نشد. ثبت نام کنید");
      exit();
    }
  }
}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../media/photo/icon-header.png" type="image/x-icon" />
  <link rel="stylesheet" href="./style/rest.css" />
  <link rel="stylesheet" href="./style/login.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/brands.min.css"
    integrity="sha512-8RxmFOVaKQe/xtg6lbscU9DU0IRhURWEuiI0tXevv+lXbAHfkpamD4VKFQRto9WgfOJDwOZ74c/s9Yesv3VvIQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.rtl.css" />
  <title>صفحه ورود</title>
</head>
<!----------- body ----------->

<body class="vh-100">
  <div class="wrapper">
    <div class="container main">
      <!------------------------------- login ------------------------------->

      <section class="row login-section mx-auto">
        <!----------- Photo Section ----------->
        <div class="side-image col-md-6 mt-2">
          <div class="image-login">
            <!----------- image ----------->
            <img class="w-100" src="../media/photo/for-Login.png" alt="عکس لاگین" />
          </div>
        </div>
        <!----------- Form Section ----------->
        <div class="side-form col-md-6 d-flex justify-content-center my-4">
          <div class="card-login">
            <header class="text-center fs-3 fw-bold mb-2">ورود</header>
            <!----------- Enter Email ----------->
            <form method="POST">
              <div class="inputG email-input text-center pt-1 my-5">
                <input type="email" name="emailLogin" class="input" id="email-login" required="" autocomplete="on"
                  dir="rtl" autofocus="autofocus" />
                <label for="email">ایمیل</label>
              </div>
              <!----------- Enter Password ----------->
              <div class="inputG password-input text-center pt-1 mt-2 mb-4">
                <input type="password" name="passLogin" class="input" id="pass-login" required="" autocomplete="on" />
                <i class=" fa-regular fa-eye"></i>
                <label for="pass">رمز ورود</label>
              </div>
              <!----------- Show Message ----------->
              <div class="text-center pt-1 mt-3">
                <p class="text-danger" id="warning-message-login"></p>
              </div>
              <!----------- Button for Click ----------->
              <div class="login-button d-grid gap-2 text-center pt-1 mt-3">
                <button name="login" class="btn btn-primary" id="btn-login" type="submit">
                  وارد شوید
                </button>
              </div>
            </form>
            <div class="text text-center p-2 fw-medium mt-3">
              آیا حسابی ندارید ؟
              <a class="creat-account-link"> ایجاد حساب </a>
            </div>
          </div>
        </div>
      </section>

      <!------------------------------- sign ------------------------------->

      <section class="row sign-section mx-auto shadow">
        <!----------- Photo Section ----------->
        <div class="side-image col-md-6 mt-2">
          <div class="image-login">
            <!----------- image ----------->
            <img class="w-100" src="../media/photo/for-Login.png" alt="عکس لاگین" />
          </div>
        </div>
        <!----------- Form Section ----------->
        <div class="side-form col-md-6 d-flex justify-content-center my-4">
          <div class="card-login">
            <header class="text-center fs-3 fw-bold mb-2">ساخت حساب</header>
            <!----------- Enter UserName ----------->
            <form method="POST">
              <div class="inputG username-input text-center pt-1 my-5">
                <input type="text" name="usernameSign" class="input" id="username" required="" autocomplete="off" />
                <label for="email">نام کاربری</label>
              </div>
              <!----------- Enter Email ----------->
              <div class="inputG email-input text-center pt-1 my-5">
                <input type="email" name="emailSign" class="input" id="email-sign" required="" autocomplete="off" />
                <label for="email">ایمیل</label>
              </div>
              <!----------- Enter Password ----------->
              <div class="inputG password-input text-center mt-2 mb-4">
                <input type="password" name="passSign" class="input" id="pass-sign" required="" />
                <i class="fa-regular fa-eye"></i>
                <label for="pass-sign">رمز ورود</label>
              </div>
              <!----------- Show Message ----------->
              <div class="text-center pt-1 mt-3">
                <p class="text-danger" id="warning-message-sign"></p>
              </div>
              <!----------- Button for Click ----------->
              <div class="login-button d-grid gap-2 text-center pt-1 mt-3">
                <button class="btn btn-primary" name="sign" id="btn-sign" type="submit">وارد شوید</button>
              </div>
            </form>
            <div class="text text-center p-2 fw-medium mt-3">
              آیا حساب آماده دارید ؟<a class="login-now-link">
                همین الان وارد شوید</a>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</body>
<script src="JS/login.js"></script>

</html>