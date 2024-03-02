<?php
include "../db.php";

$msgSuccessful = "";

if (isset($_COOKIE['email'])) {
    $emailUser = $_COOKIE['email'];
    $passwordUser = $_COOKIE['password'];

    $correctUser = $db->prepare("SELECT * FROM subscribers WHERE email = :email AND password = :password");
    $correctUser->execute(['email' => $emailUser, 'password' => $passwordUser]);
    $dataUser = $correctUser->fetch(PDO::FETCH_ASSOC);

    if ($correctUser->rowCount() == 1) {
        if (isset($_GET['ticketID'])) {
            $ticketId = $_GET['ticketID'];
            $datatickets = $db->prepare("SELECT * FROM tickets WHERE id = :id");
            $datatickets->execute(['id' => $ticketId]);

            $dataticket = $datatickets->fetch(PDO::FETCH_ASSOC);

            if (isset($_POST['sendAnswer'])) {
                $answer = $_POST['answer'];
                $updatTicket = $db->prepare("UPDATE tickets SET answer = :answer , status = 1 WHERE id = :id");
                $updatTicket->execute(['id' => $ticketId, 'answer' => $answer]);

                $msgSuccessful = "پاسخ با موفقیت ارسال شد";

            }

        }

    } else {
        header("Location:login.php?err_msg=ورود شما نامعتبر است !!");

    }


} else {
    header("Location:login.php?err_msg=ابتدا حساب خود را بسازید");
}


?>

<?php include "../layout/headerAdmin.php"; ?>
<link rel="stylesheet" href="../src/style/OneTicket.css" />
<title>تیکت
    "
    <?= $dataticket['title'] ?>"
</title>
</head>

<body>
    <main>

        <div class="content d-flex align-items-center justify-content-center">
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
                            <h5 class="py-2"><i class="fa-solid fa-user"></i> از طرف
                                <?= $dataUser['username'] ?>
                            </h5>

                            <h4 class="py-2">محتوای تیکت</h4>
                            <p>
                                <?= $dataticket['content'] ?>
                            </p>
                            <h4 class="py-2">پاسخ تیکت</h4>
                            <?php if ($dataticket['status'] == 1): ?>
                                <p>
                                    <?= $dataticket['answer']; ?>
                                </p>
                            <?php else: ?>
                                <form method="POST">
                                    <textarea name="answer" id="topic" cols="100" rows="10"
                                        class="container text-secondary rounded-1 shadow-sm p-1 w-100"
                                        placeholder="پاسخ تیکت"></textarea>
                                    <button class="btn btn-success mt-2" name="sendAnswer" type="submit">ثبت پاسخ</button>
                                    <p class="text-center text-success success-msg mt-2">
                                    </p>
                                </form>
                            <?php endif ?>
                        <?php endif ?>

                    </div>



                </section>
            </div>
        </div>
    </main>
    <script src=" ../../JS/dashboard.js"></script>
    <script>
        const successMsg = document.querySelector(".success-msg");
        <?php if (isset($_POST['sendAnswer'])): ?>
            successMsg.innerHTML = "<?= $msgSuccessful ?>";

            setInterval(() => {
                successMsg.innerHTML = "";
            }, 5000)
        <?php endif ?>
    </script>
</body>

</html>