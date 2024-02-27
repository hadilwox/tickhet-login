<?php
include "./include/db.php";
?>

<?php include "./include/layout/header.php" ?>
<link rel="stylesheet" href="../src/style/OneTicket.css" />
<title>تیکت ...</title>
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

          <div class="card-header">
            <h2 class="p-3">عنوان تیکت اول</h2>

            <div class="card-body d-flex flex-column justify-content-start align-items-start ">
              <h4 class="py-2">محتوای تیکت</h4>
              <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و
                متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز.</p>
              <h4 class="py-2">پاسخ تیکت</h4>
              <textarea name="topic" id="topic" cols="70" rows="10"
                class="container text-secondary rounded-1 shadow-sm p-1" placeholder="پاسخ تیکت"></textarea>
              <button class="btn btn-success mt-2">ثبت پاسخ</button>






            </div>
          </div>


        </section>
      </div>
    </div>
  </main>
  <script src="../src/JS/dashboard.js"></script>
</body>

</html>