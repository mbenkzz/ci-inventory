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
                    <div class="card my-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Tabel Kategori
                            <a href="<?= admin_url('category/add') ?>" class="btn btn-primary btn-sm float-right"><i class="fas fa-plus fa-fw mr-2"></i>Tambah</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama Kategori</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($categories as $kategori) : ?>
                                            <tr>
                                                <td><?= $kategori->name ?></td>
                                                <td><?= $kategori->description ?></td>
                                                <td>
                                                    <a href="<?= admin_url('category/edit/' . $kategori->id) ?>" class="btn btn-primary btn-sm"><i class="fas fa-pen fa-fw mr-2"></i>Edit</a>
                                                    <a role="button" class="btn btn-danger btn-sm" <?= $kategori->items_count == 0 ? "onclick='delete_category($kategori->id)'" : 'disabled' ?>><i class="fas fa-trash fa-fw mr-2"></i>Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
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
            
        });

        function delete_category(id) {
            swal({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "<?= admin_url('category/delete') ?>",
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(json) {
                            if (json.status == 'success') {
                                swal("Data berhasil dihapus!", {
                                    icon: "success",
                                }).then((value) => {
                                    location.reload();
                                });
                            } else {
                                swal("Data gagal dihapus!", {
                                    icon: "error",
                                });
                            }
                        }
                    });
                }
            });
        }
    </script>
</body>

</html>