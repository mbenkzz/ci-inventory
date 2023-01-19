<!DOCTYPE html>
<html lang="id">

<head>
    <?php $this->load->view('admin/template-parts/head') ?>
</head>

<body class="sb-nav-fixed">
    <?php $this->load->view('admin/template-parts/header') ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php $this->load->view('admin/template-parts/sidebar') ?>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Tambah Pengguna</h1>

                    <div class="card mb-4">
                        <div class="card-body">
                            <form id="user_form">
                                <div class="form-group">
                                    <label class="mb-1 font-size-20" for="inputUsername">Username</label>
                                    <input class="form-control py-4" id="inputUsername" name="username" type="text" placeholder="Masukkan username" />
                                </div>
                                <div class="form-group">
                                    <label class="mb-1 font-size-20" for="inputPassword">Password</label>
                                    <input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Masukkan password" />
                                </div>
                                <div class="form-group">
                                    <label class="mb-1 font-size-20" for="inputNama">Nama</label>
                                    <input class="form-control py-4" id="inputNama" name="fullname" type="text" placeholder="Masukkan nama" />
                                </div>
                                <div class="form-group">
                                    <label class="mb-1 font-size-20" for="inputRole">Role</label>
                                    <select class="form-control" id="inputRole" name="role">
                                        <option value="admin">Admin</option>
                                        <option value="user" selected>User</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php $this->load->view('admin/template-parts/footer') ?>
        </div>
    </div>
    <?php $this->load->view('admin/template-parts/scripts') ?>
    <script>
        $(document).ready(function() {
            $('#user_form').on('submit', function(e) {
                e.preventDefault()

                var form = this
                $.ajax({
                    url : '<?= admin_url("user/add") ?>',
                    type: "POST",
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(json) {
                        console.log(json);
                    }
                })
            })
        })
    </script>
</body>

</html>