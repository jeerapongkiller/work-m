<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="assets/css/main.css" rel="stylesheet">

    <style>
        .form-control {
            border-radius: 0;
            border-color: #ccc;
            border-width: 0 0 2px 0;
            border-style: none none solid none;
            box-shadow: none;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #5e9bfc;
        }

        .js-hide-label {
            opacity: 0;
        }

        .js-unhighlight-label {
            color: #999
        }
        ::-webkit-input-placeholder {
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- bg-midnight-bloom -->
    <div class="app-container app-theme-login body-tabs-shadow fixed-sidebar fixed-header">
        <div class="login col-md-4 col-xs-2">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h3 class="card-login mb-3">ลงชื่อเข้าใช้</h3>
                    <form method="post" id="frmlogin" name="frmlogin" action="sections/employee/checklogin.php">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="position-relative form-group">
                                    <label for="login_username" class="bmd-label-floating"></label>
                                    <input name="login_username" id="login_username" type="text" placeholder="ชื่อผู้ใช้" class="form-control" style="text-align:center">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="position-relative form-group">
                                    <label for="login_password" class="bmd-label-floating"></label>
                                    <input name="login_password" id="login_password" type="password" placeholder="รหัสผ่าน" class="form-control" style="text-align:center">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">เข้าสู่ระบบ</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <hr>
                                <p>© 2020 Develop by LazyFox</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </main>
    <script type="text/javascript" src="./assets/scripts/main.js"></script>
</body>

</html>