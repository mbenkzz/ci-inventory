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
                                    <input class="form-control py-4" id="inputUsername" type="text" placeholder="Masukkan username" />
                                </div>
                                <div class="form-group">
                                    <label class="mb-1 font-size-20" for="inputPassword">Password</label>
                                    <input class="form-control py-4" id="inputPassword" type="password" placeholder="Masukkan password" />
                                </div>
                                <div class="form-group">
                                    <label class="mb-1 font-size-20" for="inputNama">Nama</label>
                                    <input class="form-control py-4" id="inputNama" type="text" placeholder="Masukkan nama" />
                                </div>
                                <div class="form-group">
                                    <label class="mb-1 font-size-20" for="inputRole">Role</label>
                                    <select class="form-control" id="inputRole">
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
</body>

</html>