<?php

$invalidInputEmailLog = "";
$invalidInputPassLog = "";
$invalidInputPassLog = "";

include "../db.php";

$emailCookie = "email";
$passwordCookie = "password";
// For Login
if (isset($_POST['login'])) {
    $emailOrPhone = $_POST['emailOrPhone'];

    $passLog = $_POST['passLogin'];

    if (empty(trim($emailOrPhone))) {
        $invalidInputEmailLog = "ایمیل ضروری است";
    }
    if (empty(trim($passLog))) {
        $invalidInputPassLog = "رمز عبور ضروری است";
    }
    echo "Right 1";
    if (!empty(trim($emailOrPhone)) && !empty(trim($passLog))) {
        if (filter_var($emailOrPhone, FILTER_VALIDATE_EMAIL) || preg_match("/^09[0-9]{9}$/", $emailOrPhone)) {
            echo "Right 2";
            $user = $db->prepare("SELECT * FROM admins WHERE (email = :email OR phone = :phone) AND password = :password");
            $user->execute(["email" => $emailOrPhone, "password" => $passLog, "phone" => $emailOrPhone]);

            if ($user->rowCount() == 1) {
                echo "Right 3";
                setcookie($emailCookie, $emailOrPhone, time() + (86400 * 30), '/');
                setcookie($passwordCookie, $passLog, time() + (86400 * 30), '/');

                header("Location:dashboardAdmin.php");
                exit();
            }
            header("Location:loginAdmin.php?err_msg=رمز ورود یا ایمیل صحیح نمیباشد");
            exit();


        } else {
            $invalidInputEmailLog = "ایمیل شما صحیح نیست";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../../../media/photo/icon-header.png" type="image/x-icon" />
    <link rel="stylesheet" href="../../style/rest.css" />
    <link rel="stylesheet" href="../../style/login.css" />
    <link rel="stylesheet" href="./adminStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/brands.min.css"
        integrity="sha512-8RxmFOVaKQe/xtg6lbscU9DU0IRhURWEuiI0tXevv+lXbAHfkpamD4VKFQRto9WgfOJDwOZ74c/s9Yesv3VvIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.rtl.css" />
    <title>پنل ادمین</title>
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
                        <img class="w-100" src="../../../media/photo/for-Login.png" alt="عکس لاگین" />
                    </div>
                </div>
                <!----------- Form Section ----------->
                <div class="side-form col-md-6 d-flex justify-content-center mt-5">
                    <div class="card-login">
                        <header class="text-center fs-3 fw-bold mb-2">ورود ادمین</header>
                        <!----------- Enter Email ----------->
                        <form method="POST" class="mt-3">
                            <div class="inputG email-input text-center pt-1 my-5">
                                <input type="text" name="emailOrPhone" class="input" id="email-login" autocomplete="on"
                                    dir="rtl" autofocus="autofocus" />
                                <label for="email">ایمیل / موبایل</label>
                                <p class="text-danger mt-3" id="msgEmailLog"></p>
                            </div>

                            <!----------- Enter Password ----------->
                            <div class="inputG password-input text-center pt-1 mt-2 mb-4">
                                <input type="password" name="passLogin" class="input" id="pass-login"
                                    autocomplete="on" />
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


    const msgWarning = $.querySelectorAll(".msgWarning");

    msgEmailLog.innerHTML = '<?php echo $invalidInputEmailLog ?>';
    msgPassLog.innerHTML = '<?php echo $invalidInputPassLog ?>';

  <?php if (isset($_GET['err_msg'])): ?>
        msgWarning.forEach(msg => {
            msg.innerHTML = '<?php echo $_GET['err_msg'] ?>'
        });
<?php endif ?>

        setInterval(() => {
            msgEmailLog.innerHTML = "";
            msgPassLog.innerHTML = "";

            msgWarning.forEach(msg => {
                msg.innerHTML = "";
            });
        }, 5000)

</script>
<script src="../../JS/loginAdmin.js"></script>

</html>