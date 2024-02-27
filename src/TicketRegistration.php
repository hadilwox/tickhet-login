<?php
include "./include/db.php";
$msgSuccessful = "";

if (isset($_COOKIE['email'])) {
  $emailUser = $_COOKIE['email'];
  $passwordUser = $_COOKIE['password'];

  $correctUser = $db->prepare("SELECT * FROM subscribers WHERE email = :email AND password = :password");
  $correctUser->execute(['email' => $emailUser, 'password' => $passwordUser]);
  // $correctUser = $db->query("SELECT * FROM subscribers WHERE email = $emailUser AND password = $passwordUser ");

  if ($correctUser->rowCount() == 1) {
    $dataUser = $correctUser->fetch(PDO::FETCH_ASSOC);
    if (isset($_POST['sendTicket'])) {
      $titleTicketUser = $_POST['titleTicket'];
      $contentTicketUser = $_POST['contentTicket'];

      $sendTicket = $db->prepare("INSERT INTO tickets SET title = :title , content = :content , user_id = :userID , status = 0 , answer = NULL");
      $sendTicket->execute(['title' => $titleTicketUser, 'content' => $contentTicketUser, 'userID' => $dataUser['id']]);

      $msgSuccessful = "تیکت با موفقیت ارسال شد";

    }

  } else {
    header("Location:login.php?err_msg=ورود شما نامعتبر است !!");

  }


} else {
  header("Location:login.php?err_msg=ابتدا حساب خود را بسازید");
}

?>

<?php include "./include/layout/header.php" ?>
<link rel="stylesheet" href="../src/style/OneTicket.css" />
<title>ثبت تیکت جدید</title>
</head>

<body>
  <main>
    <?php
    // Sidebar in web
    include "./include/layout/sidebar.php"
      ?>
    <div class="content d-flex align-items-center justify-content-center vh-100">
      <div class="d-flex flex-column">
        <!-- start here , delete the content of section and code ... -->
        <!-- got it  -->
        <section class="card main">
          <div class="card-header">
            <h2 class="p-3">ثبت تیکت</h2>
          </div>

          <div class="card-body d-flex flex-column justify-content-start align-items-start">
            <h4 class="py-2 fs-4">عنوان تیکت</h4>
            <form method="POST" class="w-100">
              <input type="text" name="titleTicket" class="w-100 text-secondary rounded-1 shadow-sm border-1 p-2 w-100"
                placeholder="عنوان تیکت را وارد کنید" />

              <h4 class="pt-4 fs-4">محتوای تیکت</h4>
              <textarea name="contentTicket" rows="10" class="w-100 text-secondary rounded-1 shadow-sm p-1"
                placeholder="محتوای تیکت را وارد کنید"></textarea>
              <button class="btn btn-success mt-2" name="sendTicket" type="submit">ثبت تیکت</button>
            </form>
          </div>
          <p class="text-center text-success success-msg">
            <?= $msgSuccessful ?>
          </p>
        </section>
      </div>
    </div>
  </main>
  <script src="../src/JS/dashboard.js"></script>
</body>

</html>