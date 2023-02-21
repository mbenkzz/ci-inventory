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
                        <div class="col-12 transaction-info-container"></div>
                    </div>
                </div>
            </main>
            <?php $this->load->view('admin/template-parts/footer') ?>
        </div>
    </div>
    <?php $this->load->view('admin/template-parts/scripts') ?>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '<?= admin_url('transaction/history/data') ?>',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status == 'success') {
                        var html = '';
                        $.each(response.data, function(index, transaction) {
                            html += generate_row(transaction);
                        });
                        $('.transaction-info').remove();
                        $('.transaction-info-container').append(html);
                    } else {
                        console.log(response.message);
                    }
                }
            })
        })

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
            html += '<div class="col-12 text-right">{:discount_badge}Subtotal: <span class="text-monospace">{:item_total}</span></div>';
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