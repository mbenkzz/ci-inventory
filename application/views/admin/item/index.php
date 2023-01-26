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
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table mr-1"></i>
                                    Tambah Baru
                                    <button class="btn btn-sm btn-outline-secondary float-right" type="button" data-toggle="collapse" data-target="#add_barang_collapse" aria-expanded="false" aria-controls="add_barang_collapse">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                                <div class="card-body py-0 collapse" id="add_barang_collapse">
                                    <form id="add_barang" class="pt-3" action="">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 mb-2">
                                                <label class="" for="add_barang_category">Kategori</label>
                                                <select class="form-control mr-sm-2" id="add_barang_category" name="category">
                                                    <option value="">Pilih Kategori</option>
                                                    <option value="1">Kategori 1</option>
                                                    <option value="2">Kategori 2</option>
                                                    <option value="3">Kategori 3</option>
                                                </select>
                                                <small class="text-danger"></small>
                                            </div>
                                            <div class="col-lg-8 col-md-6 mb-2">
                                                <label class="" for="add_barang_name">Nama Barang</label>
                                                <input type="text" class="form-control mr-sm-2" id="add_barang_name" name="name" placeholder="Nama Barang">
                                                <small class="text-danger"></small>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-6 mb-2">
                                                <label class="" for="add_barang_stock">Stok</label>
                                                <!-- inpt group with increase decrease button -->
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-outline-secondary" type="button" id="add_barang_stock_decrease"><i class="fas fa-minus"></i></button>
                                                    </div>
                                                    <input type="text" class="form-control text-center" id="add_barang_stock" name="stock" placeholder="Stok">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button" id="add_barang_stock_increase"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <small class="text-danger"></small>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-6 mb-2">
                                                <label class="" for="add_barang_unit">Satuan</label>
                                                <input type="text" name="unit" class="form-control mr-sm-2" placeholder="(pcs, unit, roll)">
                                                <small class="text-danger"></small>
                                            </div>
                                            <div class="col-xl-4 col-lg-3 col-md-6 mb-2">
                                                <label class="" for="add_barang_price">Harga Jual</label>
                                                <input type="number" class="form-control mr-sm-2" id="add_barang_price" name="sell_price" placeholder="Harga Jual" value="0">
                                                <small class="text-danger"></small>
                                            </div>
                                            <div class="col-xl-4 col-lg-3 col-md-6 mb-2">
                                                <label class="" for="add_barang_buy_price">Harga Beli</label>
                                                <input type="number" class="form-control mr-sm-2" id="add_barang_buy_price" name="buy_price" placeholder="Harga Beli" value="0">
                                                <small class="text-danger"></small>
                                            </div>
                                            <div class="col-lg-12 col-md-12 mb-2">
                                                <button type="submit" class="btn btn-primary btn-block">Tambah</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table mr-1"></i>
                                    Daftar Barang
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <!-- tabel barang -->
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Stok</th>
                                                <th>Satuan</th>
                                                <th>Harga</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
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

        function delete_user(id) {
            swal({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: "<?= admin_url('user/delete') ?>",
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