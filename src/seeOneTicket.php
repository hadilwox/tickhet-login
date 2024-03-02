<?php
include "./include/db.php";

if (isset($_COOKIE['email'])) {
  $emailUser = $_COOKIE['email'];
  $passwordUser = $_COOKIE['password'];

  $correctUser = $db->prepare("SELECT * FROM subscribers WHERE email = :email AND password = :password");
  $correctUser->execute(['email' => $emailUser, 'password' => $passwordUser]);

  if ($correctUser->rowCount() == 1) {
    if (isset($_GET['ticketID'])) {
      $ticketId = $_GET['ticketID'];
      $datatickets = $db->prepare("SELECT * FROM tickets WHERE id = :id");
      $datatickets->execute(['id' => $ticketId]);

      $dataticket = $datatickets->fetch(PDO::FETCH_ASSOC);

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
<title>تیکت
  "
  <?= $dataticket['title'] ?>"
</title>
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
        <section class="card  main">

          <?php if ($datatickets->rowCount() == 1): ?>
            <div class="card-header">
              <h2 class="p-3">
                <?= $dataticket['title'] ?>
              </h2>
            </div>
            <div class="card-body d-flex flex-column justify-content-start align-items-start ">
              <h4 class="py-2">محتوای تیکت</h4>
              <p>
                <?= $dataticket['content'] ?>
              </p>
              <h4 class="py-2">پاسخ تیکت</h4>
              <p>

                <?php
                if ($dataticket['status'] == 1) {
                  echo $dataticket['answer'];
                } else {
                  echo "لطفا تا پاسخ صبر کنید ...";
                }

                ?>
              </p>
            <?php endif ?>




          </div>



        </section>
      </div>
    </div>
  </main>
  <script src="../src/JS/dashboard.js"></script>
</body>

</html>