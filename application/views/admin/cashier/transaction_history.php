<!DOCTYPE html>
<html lang="id">

<head>
    <?php $this->load->view('admin/template-parts/head') ?>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <label for="datepicker_start">Periode Awal</label>
                                            <input type="text" id="datepicker_start">
                                        </div>
                                        <div class="col">
                                            <label for="datepicker_end">Periode Akhir</label>
                                            <input type="text" id="datepicker_end">
                                        </div>
                                        <div class="col-auto">
                                            <button class="btn btn-primary mt-4" onclick="get_transactions()">Tampilkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 transaction-info-container"></div>
                        <?php if(getSession()->role == 'admin'): ?>
                        <div class="col-12 transaction-info-conclusion invisible">
                            <div class="card">
                                <div class="card-body">
                                    <p class="h6">Total Pemasukan / Pengeluaran : <span id="pemasukan">0</span> / <span id="pengeluaran">0</span> </p>
                                    <p class="h5">Hasil : <span id="laba"></span> </p>
                                </div>
                            </div>
                        </div>
                        <?php endif ?>
                    </div>
                </div>
            </main>
            <?php $this->load->view('admin/template-parts/footer') ?>
        </div>
    </div>
    <?php $this->load->view('admin/template-parts/scripts') ?>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            var $datepicker_start = $('#datepicker_start').datepicker({
                modal: true,
                format: 'dd/mm/yyyy',
                maxDate: function() {
                    return $('#datepicker_end').val();
                }
            });

            var $datepicker_end = $('#datepicker_end').datepicker({
                modal: true,
                format: 'dd/mm/yyyy'    ,
                minDate: function() {
                    return $('#datepicker_start').val();
                }
            });

            $datepicker_start.value('<?= date('d/m/Y') ?>');
            $datepicker_end.value('<?= date('d/m/Y') ?>');
            get_transactions();
        })

        function get_transactions() {
            var start_date = $('#datepicker_start').val();
            var end_date = $('#datepicker_end').val();

            $.ajax({
                url: '<?= admin_url('transaction/history/data') ?>',
                type: 'GET',
                dataType: 'json',
                data: {
                    start_date: start_date,
                    end_date: end_date
                },
                success: function(response) {
                    var html = '';
                    if (response.status == 'success') {
                        $.each(response.data, function(index, transaction) {
                            html += generate_row(transaction);
                        });
                        $('.transaction-info').remove();
                        $('.transaction-info-container').append(html);

                        if(response.data.length == 0) {
                            html = '<div class="col-12">';
                            html += '<div class="card bg-light rounded-0 transaction-info">';
                            html += '<div class="card-body">';
                            html += '<p class="h5 text-center">Tidak ada transaksi</p>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            $('.transaction-info-container').append(html);
                            <?php if(getSession()->role == 'admin'): ?>
                              $('.transaction-info-conclusion').addClass('invisible');
                            <?php endif ?>
                            return;
                        }
                        <?php if(getSession()->role == 'admin'): ?>
                        $('.transaction-info-conclusion').removeClass('invisible');

                        $('#pemasukan').text(response.total_sell);
                        $('#pengeluaran').text(response.total_buy);
                        var laba = response.total_sell - response.total_buy;
                        if(laba < 0) {
                            $('#laba').removeClass('text-success');
                            $('#laba').text(laba).addClass('text-danger');
                            $('#laba').append(' (Rugi)');
                        } else {
                            $('#laba').removeClass('text-danger');
                            $('#laba').text(laba).addClass('text-success');
                            if (laba > 0) {
                                $('#laba').append(' (Untung)');
                            }
                        }
                        <?php endif ?>
                    } else {
                        html = '<div class="col-12">';
                        html += '<div class="alert alert-danger" role="alert">';
                        html += response.message;
                        html += '</div>';
                        html += '</div>';
                        $('.transaction-info-container').append(html);
                    }
                }
            })
        }

        function generate_row(transaction) {
            // generate html

            console.log(transaction);

            var html = '';
            html += '<div class="card bg-light rounded-0 transaction-info">';
            html += '<div class="card-header p-0">';
            html += '<div class="row no-gutters h5">';
            html += '<div class="col-12 col-md p-3 cursor-pointer" data-toggle="collapse" data-target="#collapse-{:id}" aria-expanded="false" aria-controls="collapse-{:id}">';
            html += '{:created_at} | {:cashier}';
            html += '</div>';
            html += '<div class="col-12 col-md-3 p-3 text-md-right cursor-pointer" data-toggle="collapse" data-target="#collapse-{:id}" aria-expanded="false" aria-controls="collapse-{:id}">';
            html += '<span class="text-monospace">{:total}</span>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '<div class="card-body p-0 collapse" id="collapse-{:id}">';
            var item_total = 0;
            $.each(transaction.items, function(index, item) {
                var item_html = '';
                item_html += '<div class="row h5 font-weight-normal py-2 px-3 border-bottom">';
                item_html += '<div class="col-12 col-sm">{:item_name} <span class="float-right text-center" style="width:3em">{:amount}</span></div>';
                item_html += '<div class="col-auto col-sm-3 col-xl-3 text-right"> <span title="Harga Beli">{:buy_price}</span> / <span class="font-weight-bold" title="Harga Jual">{:sell_price}<span></div>';
                item_html += '<div class="col-auto col-sm-2 col-xl-2 text-right">{:total}</div>';
                item_html += '</div>';

                item.total = parseInt(item.amount) * parseInt(item.sell_price);
                item_total += item.total;

                $.each(item, function(key, value) {
                    item_html = item_html.replaceAll('{:' + key + '}', value);
                });
                html += item_html;
            });
            html += '<div class="row h5 font-weight-normal py-2 px-3 border-bottom">';
            html += '<div class="col-2"><a class="btn btn-sm btn-outline-danger" href="<?= admin_url("transaction/print") ?>/{:id}" target="_blank">Cetak</a></div>';
            html += '<div class="col-10 text-right">{:discount_badge}Subtotal: <span class="text-monospace">{:item_total}</span></div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';

            // transaction.total = transaction.total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            // transaction.item_total = item_total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            transaction.item_total = item_total;
            transaction.discount_badge = transaction.disc > 0 ? '<span class="badge badge-danger mx-3">Diskon : ' + transaction.disc + '</span>' : '';
            $.each(transaction, function(key, value) {
                html = html.replaceAll('{:' + key + '}', value);
            });
            return html;
        }
    </script>
</body>

</html>