<?php

$invalidInputEmailLog = "";
$invalidInputPassLog = "";
$invalidInputEmailSign = "";
$invalidInputPassSign = "";
$invalidInputUserSign = "";

include "./include/db.php";

$emailCookie = "email";
$passwordCookie = "password";
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
        setcookie($emailCookie, $emailLog, time() + (86400 * 30) . '/');
        setcookie($passwordCookie, $passLog, time() + (86400 * 30) . '/');

        header("Location:dashboard.php");
        exit();
      }
      header("Location:login.php?err_msg=رمز ورود یا ایمیل صحیح نمیباشد");
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
    $invalidInputUserSign = "نام کاربری ضروری است";
  }

  if (!empty(trim($emailSign)) && !empty(trim($passSign)) && !empty(trim($usernameSign))) {
    if (!filter_var($emailSign, FILTER_VALIDATE_EMAIL)) {
      $invalidInputEmailLog = "ایمیل شما صحیح نیست";
    } else {
      $userEmail = $db->prepare("SELECT * FROM subscribers WHERE email = :email OR password = :password");
      $userEmail->execute(["email" => $emailSign, "password" => $passSign]);

      if ($userEmail->rowCount() == 1) {
        header("Location:login.php?err_msg=این ایمیل قبلا ثبت شده!");
      } elseif ($userEmail->rowCount() == 0) {

        $newUser = $db->prepare("INSERT INTO subscribers SET username = :username, email = :email, password = :password, role = 'user'");
        $newUser->execute(['email' => $emailSign, 'password' => $passSign, 'username' => $usernameSign]);

        setcookie($emailCookie, $emailSign, time() + (86400 * 30), '/');
        setcookie($passwordCookie, $passSign, time() + (86400 * 30), '/');
        setcookie($usernameCookie, $usernameSign, time() + (86400 * 30), '/');

        header("Location:dashboard.php");
        exit();
      }
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

<body>
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
                <input type="text" name="emailLogin" class="input" id="email-login" autocomplete="on" dir="rtl"
                  autofocus="autofocus" />
                <label for="email">ایمیل</label>
                <p class="text-danger mt-3" id="msgEmailLog"></p>
              </div>

              <!----------- Enter Password ----------->
              <div class="inputG password-input text-center pt-1 mt-2 mb-4">
                <input type="password" name="passLogin" class="input" id="pass-login" autocomplete="on" />
                <i class=" fa-regular fa-eye"></i>
                <label for="pass">رمز ورود</label>
                <p class="text-danger" id="msgPassLog"></p>
              </div>

              <!----------- Button for Click ----------->
              <div class="login-button d-grid gap-2 text-center pt-1 mt-3">
                <button name="login" class="btn btn-primary" id="btn-login" type="submit">
                  وارد شوید
                </button>
              </div>
              <!----------- Show Message ----------->
              <div class="text-center pt-1 mt-3">
                <p class="text-danger mt-3 msgWarning">
                </p>
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
                <input type="text" name="usernameSign" class="input" id="username" required="" autocomplete="on"
                  readonly onfocus="this.removeAttribute('readonly');" />
                <label for="email">نام کاربری</label>
                <p class="text-danger" id="msgUserSign"></p>
              </div>
              <!----------- Enter Email ----------->
              <div class="inputG email-input text-center pt-1 my-5">
                <input type="text" name="emailSign" class="input" id="email-sign" required="" autocomplete="on" readonly
                  onfocus="this.removeAttribute('readonly');" />
                <label for="email">ایمیل</label>
                <p class="text-danger" id="msgEmailSign"></p>
              </div>
              <!----------- Enter Password ----------->
              <div class="inputG password-input text-center mt-2 mb-4">
                <input type="password" name="passSign" class="input" id="pass-sign" autocomplete="on" required=""
                  readonly onfocus="this.removeAttribute('readonly');" />
                <i class="fa-regular fa-eye"></i>
                <label for="pass-sign">رمز ورود</label>
                <p class="text-danger" id="msgPassSign"></p>
              </div>
              <!----------- Show Message ----------->
              <div class="text-center pt-1 mt-3">
                <p class="text-danger" id="warning-message-sign"></p>
              </div>
              <!----------- Button for Click ----------->
              <div class="login-button d-grid gap-2 text-center pt-1 mt-3">
                <button class="btn btn-primary" name="sign" id="btn-sign" type="submit">وارد شوید</button>
              </div>
              <div class="text-center pt-1 mt-3">
                <p class="text-danger mt-3 msgWarning">
                </p>
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
<script>
  const $ = document;

  const msgEmailLog = $.getElementById("msgEmailLog");
  const msgPassLog = $.getElementById("msgPassLog");

  const msgUsernameSign = $.getAnimations("msgUserSign")
  const msgEmailSign = $.getAnimations("msgEmailSign")
  const msgPassSign = $.getAnimations("msgPassSign")

  const msgWarning = $.querySelectorAll(".msgWarning");

  msgEmailLog.innerHTML = '<?php echo $invalidInputEmailLog ?>';
  msgPassLog.innerHTML = '<?php echo $invalidInputPassLog ?>';

  msgUsernameSign.innerHTML = '<?php echo $invalidInputUserSign ?>';
  msgEmailSign.innerHTML = '<?php echo $invalidInputEmailSign ?>';
  msgPassSign.innerHTML = '<?php echo $invalidInputPassSign ?>';

  <?php if (isset($_GET['err_msg'])): ?>
    msgWarning.forEach(msg => {
      msg.innerHTML = '<?php echo $_GET['err_msg'] ?>'
    });
<?php endif ?>

    setInterval(() => {
      msgEmailLog.innerHTML = "";
      msgPassLog.innerHTML = "";

      msgUsernameSign.innerHTML = "";
      msgEmailSign.innerHTML = "";
      msgPassSign.innerHTML = "";

      msgWarning.forEach(msg => {
        msg.innerHTML = "";
      });
    }, 5000)

</script>
<script src="JS/login.js"></script>

</html>