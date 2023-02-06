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
                    <div class="container-fluid">
                        <div class="card my-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Kasir
                            </div>
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <!-- select items -->
                                        <select id="add_barang_item" class="form-control select2">
                                            <option value="">Pilih Barang</option>
                                            <?php foreach ($items as $item) : ?>
                                                <option value="<?= $item->id ?>"><?= "[{$item->item_code}] {$item->name} ({$item->unit})" ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary" type="button" data-toggle="input-number" data-action="minus"><i class="fas fa-minus"></i></button>
                                            </div>
                                            <input type="text" class="form-control text-center input-number" id="add_barang_amount" placeholder="Stok" value="0">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" data-toggle="input-number" data-action="plus"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                        <small class="text-danger"></small>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <button class="btn btn-primary btn-block">Tambah</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- table responsive -->
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Barang</th>
                                                <th>Stok</th>
                                                <th>Harga</th>
                                                <th>Total</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" class="text-right">Total</td>
                                                <td>100000</td>
                                                <td></td>
                                            </tr>
                                            <!-- bayar -->
                                            <tr>
                                                <td colspan="4" class="text-right">Bayar</td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-outline-secondary" type="button" data-toggle="input-number" data-action="minus"><i class="fas fa-minus"></i></button>
                                                        </div>
                                                        <input type="text" class="form-control text-center input-number" id="add_barang_amount" placeholder="Stok" value="0">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="button" data-toggle="input-number" data-action="plus"><i class="fas fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td></td>
                                        </tfoot>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Barang 1</td>
                                                <td>10</td>
                                                <td>10000</td>
                                                <td>100000</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Barang 2</td>
                                                <td>10</td>
                                                <td>10000</td>
                                                <td>100000</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Barang 3</td>
                                                <td>10</td>
                                                <td>10000</td>
                                                <td>100000</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Barang 4</td>
                                                <td>10</td>
                                                <td>10000</td>
                                                <td>100000</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                                </td>
                                            </tr>
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
            $('.select2').select2({
                width: '100%'
            });
        });
    </script>
</body>

</html>