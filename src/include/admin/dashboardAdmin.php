<?php

include "../db.php";


if (isset($_COOKIE['email'])) {
    if (isset($_GET['exit'])) {
        setcookie('email', "", time() - (86400 * 32));
        setcookie('password', "", time() - (86400 * 32));
        header("Location:loginAdmin.php");
        exit();
    }
    $emailUser = $_COOKIE['email'];
    $passwordUser = $_COOKIE['password'];

    $countAll = 0;
    $countSend = 0;
    $countAnswer = 0;


    $correctUser = $db->prepare("SELECT * FROM subscribers WHERE email = :email AND password = :password");
    $correctUser->execute(['email' => $emailUser, 'password' => $passwordUser]);
    // $correctUser = $db->query("SELECT * FROM subscribers WHERE email = $emailUser AND password = $passwordUser ");

    if ($correctUser->rowCount() == 1) {
        if (isset($_GET['status'])) {
            $answered = $_GET['status'];
            $tickets = $db->prepare("SELECT * FROM subscribers , tickets WHERE status = :status AND subscribers.id = tickets.user_id ORDER BY tickets.id DESC");
            $tickets->execute(['status' => $answered]);
        } else {
            $tickets = $db->query("SELECT * FROM subscribers , tickets WHERE subscribers.id = tickets.user_id ORDER BY tickets.id DESC");

        }
        $dataUser = $correctUser->fetch(PDO::FETCH_ASSOC);

        $countTicket = 1;

    } else {
        header("Location:login.php?err_msg=ورود شما نامعتبر است !!");

    }


} else {
    header("Location:login.php?err_msg=ابتدا حساب خود را بسازید");
}
?>

<?php include "../layout/headerAdmin.php"; ?>

<body>
    <main>
        <!-- Side Bar -->
        <nav class="sidebar position-fixed h-100">
            <!-- section Up  -->
            <div class="logo-site d-flex align-content-center w-100 py-2 justify-content-start">
                <h1 class="fs-5 fw-bold text-white">پنل ادمین</h1>
                <i class="fa-solid fa-bars toggle-menu text-white fs-3 position-absolute"></i>
            </div>
            <!-- Menu  -->
            <ul class="list-item navbar-nav mt-4">
                <li class="nav-item for-new-ticket <?php if (!isset($_GET['status'])) { ?> active<?php } ?>">
                    <a class="nav-link text-black my-1" href="dashboardAdmin.php">
                        <i class="fa-solid fa-folder-open fs-5 text-white"></i>
                        <span class="fs-5 fw-medium mx-1 text-white" style="--i: 1">همه تیکت ها</span>
                    </a>
                </li>
                <li class="nav-item  <?php if (isset($_GET['status']) && $_GET['status'] == 0) { ?> active<?php } ?>">
                    <a class="nav-link text-black my-1" href="dashboardAdmin.php?status=0">
                        <i class="fa-regular fa-circle-xmark fs-5 text-white" style="margin-right:0.20rem;"></i>
                        <span class="fs-5 fw-medium mx-1 text-white" style="--i: 2">پاسخ داده نشده</span>
                    </a>
                </li>
                <li class="nav-item  <?php if ($_GET['status'] == 1) { ?> active<?php } ?>">
                    <a class="nav-link text-black my-1" href="dashboardAdmin.php?status=1">
                        <i class="fa-regular fa-circle-check fs-5 text-white" style="margin-right:0.20rem;"></i>
                        <span class="fs-5 fw-medium mx-1 text-white" style="--i: 3">پاسخ داده شده</span>
                    </a>
                </li>

                <li class="nav-item for-new-ticket ">
                    <a class="nav-link text-black my-1" href="dashboardAdmin.php?exit=1">
                        <i class="fa-solid fa-right-from-bracket fs-5 text-white"></i>
                        <span class="fs-5 fw-medium mx-1 text-white" style="--i: 4">خروج</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Side Bar -->
        <div class="content d-flex align-items-center justify-content-center">
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
                                        <th>نام</th>
                                        <th>عنوان</th>
                                        <th class="d-none d-md-none d-sm-none d-lg-block">محتوا</th>
                                        <th>نمایش</th>
                                    </tr>
                                    <?php foreach ($tickets as $ticket): ?>

                                        <tr class="body-table">
                                            <td>
                                                <?= $countTicket++ ?>
                                            </td>
                                            <td>
                                                <?= substr($ticket['title'], 0, 40) ?>
                                            </td>
                                            <td>
                                                <?= $ticket['username'] ?>
                                            </td>
                                            <td class="d-none d-md-none d-sm-none d-lg-block">
                                                <?= substr($ticket['content'], 0, 100) ?> ...
                                            </td>
                                            <td>

                                                <a href="seeOneTicketAdmin.php?ticketID=<?= $ticket['id'] ?>"
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


    <script src=" ../../JS/dashboard.js"></script>
</body>

</html>