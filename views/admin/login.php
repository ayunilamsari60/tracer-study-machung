<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Login | Skote - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?= base_url("assets/images/favicon.ico")?>">

        <!-- Bootstrap Css -->
        <link href="<?= base_url("assets/css/bootstrap.min.css")?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?= base_url("assets/css/icons.min.css")?>" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?= base_url("assets/css/app.min.css")?>" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary">Welcome Back !</h5>
                                            <p>Sign in to continue to Skote.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="<?= base_url("assets/images/profile-img.png")?>" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                                <div class="p-2">
                                    <form class="form-horizontal" action="login" method="POST">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                                        </div>
                
                                        <div class="mb-3">
                                            <label class="form-label">Password</label>
                                            <div class="input-group auth-pass-inputgroup">
                                                <input type="password" class="form-control" name="password" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="remember-check" name="remember">
                                            <label class="form-check-label" for="remember-check" >
                                                Remember me
                                            </label>
                                        </div>
                                        
                                        <div class="mt-3 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                                        </div>
                                    </form>
                                </div>
            
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                        <p>© SI Trace Study
                            <script>
                                document.write(new Date().getFullYear())
                            </script>, Crafted with <i class="mdi mdi-heart text-danger"></i> by Ma Chung
                        </p>
                    </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end account-pages -->

        <!-- JAVASCRIPT -->
        <script src="<?= base_url("assets/libs/jquery/jquery.min.js")?>"></script>
        <script src="<?= base_url("assets/libs/bootstrap/js/bootstrap.bundle.min.js")?>"></script>
        <script src="<?= base_url("assets/libs/metismenu/metisMenu.min.js")?>"></script>
        <script src="<?= base_url("assets/libs/simplebar/simplebar.min.js")?>"></script>
        <script src="<?= base_url("assets/libs/node-waves/waves.min.js")?>"></script>
        
        <!-- App js -->
        <script src="<?= base_url("assets/js/app.js")?>"></script>
    </body>
</html>
