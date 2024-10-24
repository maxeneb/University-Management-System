<?php
include 'db.php';
include 'process-programs.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Information</title>
    <script src="axios.min.js"></script>
    <link rel="icon" type="image/png" href="admin/images/cat.png" />
    <link rel="stylesheet" type="text/css" href="admin/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="admin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="admin/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="admin/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="admin/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="admin/css/util.css">
    <link rel="stylesheet" type="text/css" href="admin/css/entry.css">
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <form class="wrap-login100 validate-form" id="myForm" method="POST" action="process-programs.php">
                <span class="login100-form-title">
                    Program Entry Form
                </span>

                <div class="wrap-input100 validate-input" data-validate="Program ID is required">
                    <input class="input100" type="text" name="progID" placeholder="Program ID" value=<?php echo $progID; ?>>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Input is required">
                    <input class="input100" type="text" name="progfullname" placeholder="Full Name" value=<?php echo $progFullName; ?>>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Input is required">
                    <input class="input100" type="text" name="progshortname" placeholder="Short Name" value=<?php echo $progShortName; ?>>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Input is required">
                    <select class="input100" name="college" id="college">
                        <option value="" selected>Select College</option>
                    </select>
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Input is required">
                    <select class="input100" name="department" id="department">
                        <option value="" selected>Select Department</option>
                    </select>
                    <span class="focus-input100"></span>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Save
                    </button>

                    <button class="login100-form-btn" type="button" id="clearButton">
                        Clear
                    </button>
                </div>

                <div class="text-center p-t-12" style="margin-left:110px;">
                    <?php session_start();
                    if (isset($_SESSION['program_error'])) {
                        echo '<p style="color: red;">' . $_SESSION['program_error'] . '</p>';
                        unset($_SESSION['program_error']);
                    }
                    ?>
                </div>

                <div class="text-center p-t-50">
                    <a class="txt2" href="admin/display-programs.php">
                        <i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
                        Go Back
                    </a>
                </div>
            </form>
        </div>
    </div>
    <script src="fetchd.js"></script>


    <script>
        document.getElementById('clearButton').addEventListener('click', function () {
            var inputs = document.getElementById('myForm').getElementsByTagName('input');
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].value = '';
            }
            var selects = document.getElementById('myForm').getElementsByTagName('select');
            for (var i = 0; i < selects.length; i++) {
                selects[i].value = '';
            }
        });
    </script>


    <script src="admin/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="admin/vendor/bootstrap/js/popper.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="admin/vendor/select2/select2.min.js"></script>
    <script src="admin/vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <script src="admin/js/main.js"></script>
</body>

</html>