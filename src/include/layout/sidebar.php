<?php
$allPageName = $_SERVER['SCRIPT_NAME'];
$pageName = substr($allPageName, 19);
?>


<nav class="sidebar position-fixed h-100">
  <!-- section Up  -->
  <div class="logo-site d-flex align-content-center w-100 py-2 justify-content-start">
    <h1 class="fs-5 fw-bold text-black">تیکت های پشتیبانی</h1>
    <i class="fa-solid fa-bars toggle-menu text-black fs-3 position-absolute"></i>
  </div>
  <!-- Menu  -->
  <ul class="list-item navbar-nav mt-4">
    <li class="nav-item <?php if ($pageName == "dashboard.php") { ?> active <?php } ?>">
      <a class="nav-link text-black my-1" href="../src/dashboard.php">
        <i class="fa-solid fa-layer-group fs-5"></i>
        <span class="fs-5 fw-medium" style="--i: 1">داشبورد</span>
      </a>
    </li>
    <li
      class="nav-item  <?php if ($pageName == "seeAllTickets.php" || $pageName == "seeOneTicket.php") { ?> active <?php } ?>">
      <a class="nav-link text-black my-1" href="../src/seeAllTickets.php">
        <i class="fa-solid fa-ticket-simple fs-5"></i>
        <span class="fs-5 fw-medium" style="--i: 2">مشهاده تیکت ها</span>
      </a>
    </li>
    <li class="nav-item for-new-ticket  <?php if ($pageName == "TicketRegistration.php") { ?> active <?php } ?>">
      <a class="nav-link text-black my-1" href="../src/TicketRegistration.php">
        <i class="fa-solid fa-plus"></i>
        <i class="fa-solid fa-ticket-simple fs-5"></i>

        <span class="fs-5 fw-medium" style="--i: 3">ثبت تیکت جدید</span>
      </a>
    </li>
  </ul>
</nav>