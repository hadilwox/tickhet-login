<?php
include "./include/db.php";

session_start();

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

    $tickets = $db->prepare("SELECT tickets.id ,email,password,title ,content,status FROM subscribers , tickets WHERE email = :email AND password = :password AND subscribers.id = tickets.user_id");
    $tickets->execute(['email' => $emailUser, 'password' => $passwordUser]);

    $countTicket = 1;

  } else {
    header("Location:login.php?err_msg=ورود شما نامعتبر است !!");

  }


} else {
  header("Location:login.php?err_msg=ابتدا حساب خود را بسازید");
}
?>
<?php include "./include/layout/header.php" ?>
<link rel="stylesheet" href="../src/style/AllTickets.css" />
<title>مشاهده تیکت ها</title>
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
            <h2 class="p-3">فهرست تیکت ها</h2>
          </div>
          <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <div class="w-100">
              <table class="table table-striped table-hover">

                <?php if ($tickets->rowCount() > 0): ?>

                  <tr>
                    <th>ردیف</th>
                    <th>عنوان</th>
                    <th class="d-none d-md-none d-sm-none d-lg-block">محتوا</th>
                    <th>پاسخ</th>
                    <th>نمایش</th>
                  </tr>
                  <?php foreach ($tickets as $ticket): ?>

                    <tr class="body-table">
                      <td>
                        <?= $countTicket++ ?>
                      </td>
                      <td>
                        <?= $ticket['title'] ?>
                      </td>
                      <td class="d-none d-md-none d-sm-none d-lg-block">
                        <?= substr($ticket['content'], 0, 100) ?> ...
                      </td>
                      <td>
                        <?= $ticket['status'] == 0 ? "خیر" : "بله" ?>
                      </td>
                      <td>

                        <a href="seeOneTicket.php?ticketID=<?= $ticket['id'] ?>"
                          class="text-white rounded-1 nav-link fw-light clickOneTicket">مشاهده</a>
                      </td>
                    </tr>

                  <?php endforeach ?>

                <?php else: ?>
                  <p class="fw-bold fs-5 text-center">تیکتی موجود نمیباشد</p>
                <?php endif ?>
              </table>

            </div>
          </div>
        </section>
      </div>
    </div>
  </main>


  <script src=" ../src/JS/dashboard.js"></script>
</body>

</html>