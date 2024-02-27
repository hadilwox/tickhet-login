<?php
include "./include/db.php";
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
                <tr>
                  <th>ردیف</th>
                  <th>عنوان</th>
                  <th class="d-sm-none d-md-block">محتوا</th>
                  <th>پاسخ</th>
                </tr>
                <?php if (isset($_POST['emailLogin'])): ?>
                  <?php foreach ($tickets as $ticket): ?>
                    <?php if (in_array($emailUser, $ticket)): ?>
                      <tr class="body-table">
                        <td>
                          <?= $ticket['id'] ?>
                        </td>
                        <td>
                          <?= $ticket['title'] ?>
                        </td>
                        <td class="d-sm-none d-md-block">
                          <?= $ticket['content'] ?>
                        </td>
                        <td>
                          <?= $ticket['status'] == 0 ? "خیر" : "بله" ?>
                        </td>
                      </tr>
                    <?php endif ?>
                  <?php endforeach ?>
                <?php endif ?>
              </table>
            </div>
          </div>
        </section>
      </div>
    </div>
  </main>
  <script src="../src/JS/dashboard.js"></script>
  <script src="../src/JS/AllTickets.js"></script>
</body>

</html>