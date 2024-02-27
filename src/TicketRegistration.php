<?php
include "./include/db.php";
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
            <input type="text" name="topic" id="topic" class="w-100 text-secondary rounded-1 shadow-sm border-1 p-2"
              placeholder="عنوان تیکت را وارد کنید" />

            <h4 class="pt-4 fs-4">محتوای تیکت</h4>
            <textarea name="topic" id="topic" rows="10" class="w-100 text-secondary rounded-1 shadow-sm p-1"
              placeholder="محتوای تیکت را وارد کنید"></textarea>
            <button class="btn btn-success mt-2">ثبت تیکت</button>
          </div>
        </section>
      </div>
    </div>
  </main>
  <script src="../src/JS/dashboard.js"></script>
</body>

</html>