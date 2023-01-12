<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dapurbude - Login</title>
        <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form id="login_form">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputUsername">Username</label>
                                                <input class="form-control py-4" id="inputUsername" type="text" placeholder="Masukkan username" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" placeholder="Masukkan password" />
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-end mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary btn-lg" id="login_button">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="<?= base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="<?= base_url('assets/js/scripts.js') ?>"></script>
        <script>
            $(document).ready(function() {
                $('#login_form').on('submit', function(e) {
                    e.preventDefault();
                    var button = $('#login_button');
                    $.ajax({
                        url : '<?= admin_url('login') ?>',
                        type : 'POST',
                        data : {
                            username : $('#inputUsername').val(),
                            password : $('#inputPassword').val()
                        },
                        dataType: 'json',
                        success : function(json) {
                            swal_response(json.result, json.message).then(function() {window.location.reload()})
                        },
                        error: function(xhr, status, message) {
                            swal_error(message)
                        }
                    })
                })
            })
        </script>
    </body>
</html>
