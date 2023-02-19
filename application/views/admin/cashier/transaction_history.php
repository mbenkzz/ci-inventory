<!DOCTYPE html>
<html lang="id">

<head>
    <?php $this->load->view('admin/template-parts/head') ?>
    <style>
        .text-monospace {
            font-family: 'Courier New', Courier, monospace !important;
            font-weight: 700;
        }

        .transaction-info {
            border: 1px solid #000;
            border-radius: 0;
        }
    </style>
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
                    <h1 class="my-4">Riwayat Transaksi</h1>
                    <div class="row">
                        <div class="col-12">
                            <?php for($x = 0; $x < 10; $x++): ?>
                            <div class="card bg-light rounded-0 transaction-info">
                                <div class="card-header p-0">
                                    <div class="row no-gutters h5">
                                        <div class="col-12 col-md p-3 cursor-pointer" data-toggle='collapse' data-target="#collapse-<?= $x ?>" aria-expanded="false" aria-controls="collapse-<?= $x ?>">
                                            13-02-2021 09:35 | Kasir 1
                                        </div>
                                        <div class="col-12 col-md-3 p-3 text-md-right cursor-pointer" data-toggle='collapse' data-target="#collapse-<?= $x ?>" aria-expanded="false" aria-controls="collapse-<?= $x ?>">
                                            <span class="text-monospace">100.000</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0 collapse" id="collapse-<?= $x ?>">
                                    <div class="row h5 font-weight-normal py-2 px-3 border-bottom">
                                        <div class="col-2">ITEM0001</div>
                                        <div class="col">Beras</div>
                                        <div class="col-1">10</div>
                                        <div class="col-2 text-right">10.000</div>
                                        <div class="col-3 text-right">100.000</div>
                                    </div>
                                    <div class="row h5 font-weight-normal py-2 px-3 border-bottom">
                                        <div class="col-2">ITEM0002</div>
                                        <div class="col">Gula</div>
                                        <div class="col-1">10</div>
                                        <div class="col-2 text-right">15.000</div>
                                        <div class="col-3 text-right">150.000</div>
                                    </div>
                                </div>
                            </div>
                            <?php endfor ?>
                        </div>
                    </div>
                </div>
            </main>
            <?php $this->load->view('admin/template-parts/footer') ?>
        </div>
    </div>
    <?php $this->load->view('admin/template-parts/scripts') ?>
    <script>

    </script>
</body>

</html>