<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Programs</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/display.css">
</head>

<body>
    <div class="limiter">

        <?php include '../db.php'; ?>

        <header class="header" role="banner">
            <h1 class="logo">
                <div class="logo_pic">
                    <img src="images/cat.png" alt="IMG">
                    <a href="#">University of <span>Hawli</span></a>
                </div>
            </h1>
            <div class="nav-wrap">
                <nav class="main-nav" role="navigation">
                    <ul class="unstyled list-hover-slide">
                        <li><a href="display-students.php">Students</a></li>
                        <li><a href="display-colleges.php">Colleges</a></li>
                        <li><a href="">Programs</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <span class="login100-form-title" style="margin-top:5px;">
            <h2>Programs Offered</h2>

            <div class="text-center p-t-12">
                <button><a href='../program-entry.php'>Add Program</a></button>
            </div>
        </span>

        <?php
        $sql = "SELECT 
        p.progid, 
        p.progfullname AS program_name, 
        p.progshortname,
        c.collfullname AS college_name,
        d.deptfullname AS department_name
            FROM programs p
            INNER JOIN colleges c ON p.progcollid = c.collid
            LEFT JOIN departments d ON p.progcolldeptid = d.deptid";


        $result = $dbconnection->query($sql);

        if ($result->rowCount() > 0): ?>
            <div class="normal-table-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="normal-table-list">
                                <div class="bsc-tbl">
                                    <table class="table table-sc-ex">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Full Name</th>
                                                <th>Short Name</th>
                                                <th>College</th>
                                                <th>Department</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                                                <tr>
                                                    <td>
                                                        <?= $row["progid"] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row["program_name"] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row["progshortname"] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row["college_name"] ?>
                                                    </td>
                                                    <td>
                                                        <?= $row["department_name"] ?>
                                                    </td>
                                                    <td>
                                                        <a class='edit' href='../program-entry.php?edit=<?= $row["progid"] ?>'>
                                                            <img src="images/icons/edits.png" alt="IMG">
                                                        </a>
                                                        <a class='remove' href='../remove-program.php?id=<?= $row["progid"] ?>'>
                                                            <img src="images/icons/delete.png" alt="IMG">
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php endwhile; ?>
                                            <tr>
                                                <td><button><i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
                                                        <a href="../logout.php">Logout</a></button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="bsc-tbl">
                <table class="table table-sc-ex">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Short Name</th>
                            <th>College</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>

                <h4>No programs added...</h4>
            </div>
        <?php endif; ?>
    </div>
    </div>
    </div>
    </div>

    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <script src="js/main.js"></script>

</body>

</html>