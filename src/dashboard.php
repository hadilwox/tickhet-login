<?php
include_once "./include/db.php";

if (isset($_COOKIE['email'])) {
  $emailUser = $_COOKIE['email'];
  $passwordUser = $_COOKIE['password'];

  $countAll = 0;
  $countSend = 0;
  $countAnswer = 0;

  $correctUser = $db->prepare("SELECT * FROM subscribers WHERE email = :email AND password = :password");
  $correctUser->execute(['email' => $emailUser, 'password' => $passwordUser]);
  // $correctUser = $db->query("SELECT * FROM subscribers WHERE email = $emailUser AND password = $passwordUser ");

  if ($correctUser->rowCount() == 1) {
    $dataUser = $correctUser->fetch(PDO::FETCH_ASSOC);
    $usernameUser = $dataUser['username'];

    $tickets = $db->query("SELECT email,password,title ,content,status FROM subscribers , tickets WHERE subscribers.id = tickets.user_id");
    foreach ($tickets as $ticket) {
      if (in_array($emailUser, $ticket)) {
        $countAll++;
        if ($ticket['status'] == 1) {
          $countAnswer++;
        } elseif ($ticket['status'] == 0) {
          $countSend++;
        }
      }
    }

  } else {
    header("Location:login.php?err_msg=ورود شما نامعتبر است !!");

  }


} else {
  header("Location:login.php?err_msg=ابتدا حساب خود را بسازید");
}



?>
<?php include "./include/layout/header.php" ?>
<title>داشبورد</title>
</head>

<body>
  <main>

    <?php
    // Sidebar in web
    include "./include/layout/sidebar.php"
      ?>
    <div class="content d-flex align-items-center justify-content-center vh-100">
      <div class="main d-flex flex-column">
        <div dir="ltr" class="btn-new-ticket mb-3">
          <a class="btn bg-white" href="../src/TicketRegistration.php">ثبت تیکت جدید</a>
        </div>
        <section class="dashboard-main card">
          <div class="card-header">
            <h2 class="card-title p-3">وضعیت تیکت ها</h2>
            <p class="text">خوشامدی <span class="fw-bold">
                <?= $usernameUser ?>
              </span></p>
          </div>
          <div class="card-body d-flex  justify-content-evenly flex-sm-column align-items-sm-center flex-md-row">
            <div
              class="condition-tocket send-t border border-2 border-secondary rounded-2 d-flex flex-column align-items-center justify-content-evenly">
              <div class="icon text-center">
                <img width="70" height="70" src="../media/photo/send-ticket.png" alt="ticket" />
              </div>
              <div class="text">
                <p class="text-center">ارسال شده</p>
              </div>
              <div class="number text-center"><span id="send-ticket">
                  <?= $countSend ?>
                </span></div>
            </div>

            <div
              class="condition-tocket answer-t border border-2 border-secondary rounded-2 d-flex flex-column align-items-center justify-content-evenly">
              <div class="icon">
                <img width="100" height="100" src="../media/photo/answer-ticket.png" alt="ticket" />
              </div>
              <div class="text">
                <p class="text-center">پاسخ داده شده</p>
              </div>
              <div class="number text-center"><span id="answer-ticket">
                  <?= $countAnswer ?>
                </span></div>
            </div>
            <div
              class="condition-tocket all-t border border-2 border-secondary rounded-2 d-flex flex-column align-items-center justify-content-evenly">
              <div class="icon">
                <img src="../media/photo/all-ticket.png" alt="ticket" />
              </div>
              <div class="text">
                <p class="text-center">مجموع</p>
              </div>
              <div class="number text-center"><span id="all-ticket">
                  <?= $countAll ?>
                </span></div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </main>
  <script src="../src/JS/dashboard.js"></script>
</body>

</html>