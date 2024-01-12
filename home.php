<?php
session_start();
include "db_conn.php";

if (isset($_SESSION['username']) && isset($_SESSION['id'])) { //ログインしてる間何をするか
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <title>Document</title>
    </head>

    <body>
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">

            <?php if ($_SESSION['role'] == 'admin') { ?>
                <!-- admin用 -->
                <div class="card" style="width: 18rem;">
                    <img src="img/admin.png" class="card-img-top" alt="admin image">
                    <div class="card-body text-center">
                        <h5 class="card-title ">
                            <?= $_SESSION['name'] ?></h5>
                        <a href="logout.php" class="btn btn-dark">Logout</a>
                    </div>

                </div>
                <div class="p-3">
                    <?php include 'php/members.php'; //include:複数のページで共通の機能や構造を使いたい時に
                    if (mysqli_num_rows($res) > 0) { ?>


                        <h1 class="display-4 fs-1">Members</h1>
                        <table class="table" style="width: 24rem">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">User name</th>
                                    <th scope="col">Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                while ($rows = mysqli_fetch_assoc($res)) { ?>
                                    <tr>
                                        <th scope="row"><?= $i ?></th>
                                        <td><?= $rows['name'] ?></td>
                                        <td><?= $rows['username'] ?></td>
                                        <td><?= $rows['role'] ?></td>

                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                    <?php } ?>

                </div>

            <?php } else { ?>
                <!-- User用 -->
                <div class="card" style="width: 18rem;">
                    <img src="img/user.png" class="card-img-top" alt="admin image">
                    <div class="card-body text-center">
                        <h5 class="card-title ">
                            <?= $_SESSION['name'] ?></h5>
                        <a href="logout.php" class="btn btn-dark">Logout</a>
                    </div>

                </div>
            <?php } ?>
        </div>
    </body>

    </html>
<?php } else {
    header("Location: ../index.php");
} ?>