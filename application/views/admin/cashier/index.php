<!DOCTYPE html>
<html lang="id">

<head>
    <?php $this->load->view('admin/template-parts/head') ?>
    <style>
        .text-monospace {
            font-family: 'Courier New', Courier, monospace !important;
            font-weight: 700;
        }

        .item-list-header,
        .item-list-footer {
            font-weight: bold;
            background-color: #f8f9fa;
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
                    <div class="card my-4">
                        <div class="card-header">
                            <i class="fas fa-table mr-1"></i>
                            Kasir
                        </div>
                        <div class="card-body pb-0">
                            <div id="add_barang_form" class="row">
                                <div class="col-md-6 mb-3">
                                    <!-- select items -->
                                    <select id="add_barang_item" class="form-control">
                                        <option value="">Pilih Barang</option>
                                        <?php foreach ($items as $item) : ?>
                                            <option value="<?= $item->id ?>"><?= "[{$item->item_code}] {$item->name} ({$item->unit})" ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <small class="text-danger"></small>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button" data-toggle="input-number" data-action="minus"><i class="fas fa-minus"></i></button>
                                        </div>
                                        <input type="text" class="form-control text-center input-number" id="add_barang_amount" placeholder="Stok" value="1" data-min="1">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" data-toggle="input-number" data-action="plus"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <small class="text-danger"></small>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <button type="button" class="btn btn-primary btn-block" id="btn_add_item">Tambah</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="item-list-header row border-top border-bottom py-2">
                                <div class="col-2">
                                    <!-- checkbox -->
                                    <input type="checkbox" class="mr-2" id="check_all_items">
                                    <!-- item code -->
                                    Kode Barang
                                </div>
                                <div class="col-4">
                                    <!-- item name -->
                                    Barang & Satuan
                                </div>
                                <div class="col-1 text-center">
                                    <!-- item amount -->
                                    Jumlah
                                </div>
                                <div class="col-2 text-right">
                                    <!-- item price -->
                                    Harga
                                </div>
                                <div class="col-2 text-right">
                                    <!-- item total -->
                                    Total
                                </div>
                            </div>
                            <div class="item-list">
                                <div class="row item-row border-bottom py-1">
                                    <div class="col-2">
                                        <!-- checkbox -->
                                        <input type="checkbox" class="mr-2 check-item">
                                        <!-- item code -->
                                        ITEM0001
                                    </div>
                                    <div class="col-4">
                                        <!-- item name -->
                                        Item 1 (pcs)
                                    </div>
                                    <div class="col-1 text-center">
                                        <!-- item amount -->
                                        10
                                    </div>
                                    <div class="col-2 text-right text-monospace">
                                        <!-- item price -->
                                        10.000
                                    </div>
                                    <div class="col-2 text-right text-monospace">
                                        <!-- item total -->
                                        100.000
                                    </div>
                                    <div class="col-1 text-right">
                                        <span class="text-danger cursor-pointer btn-delete-item"><i class="fas fa-times fa-fw"></i></span>
                                    </div>
                                </div>
                                <div class="row item-row border-bottom py-1">
                                    <div class="col-2">
                                        <!-- checkbox -->
                                        <input type="checkbox" class="mr-2 check-item">
                                        <!-- item code -->
                                        ITEM0002
                                    </div>
                                    <div class="col-4">
                                        <!-- item name -->
                                        Item 2 (ball)
                                    </div>
                                    <div class="col-1 text-center">
                                        <!-- item amount -->
                                        10
                                    </div>
                                    <div class="col-2 text-right text-monospace">
                                        <!-- item price -->
                                        120.000
                                    </div>
                                    <div class="col-2 text-right text-monospace">
                                        <!-- item total -->
                                        1.200.000
                                    </div>
                                    <div class="col-1 text-right">
                                        <span class="text-danger cursor-pointer btn-delete-item"><i class="fas fa-times fa-fw"></i></span>
                                    </div>
                                </div>
                                <div class="row item-row border-bottom py-1">
                                    <div class="col-2">
                                        <!-- checkbox -->
                                        <input type="checkbox" class="mr-2 check-item">
                                        <!-- item code -->
                                        ITEM0003
                                    </div>
                                    <div class="col-4">
                                        <!-- item name -->
                                        Item 3 (roll)
                                    </div>
                                    <div class="col-1 text-center">
                                        <!-- item amount -->
                                        10
                                    </div>
                                    <div class="col-2 text-right text-monospace">
                                        <!-- item price -->
                                        10.000
                                    </div>
                                    <div class="col-2 text-right text-monospace">
                                        <!-- item total -->
                                        100.000
                                    </div>
                                    <div class="col-1 text-right">
                                        <span class="text-danger cursor-pointer btn-delete-item"><i class="fas fa-times fa-fw"></i></span>
                                    </div>
                                </div>
                                <div class="row item-row border-bottom py-1">
                                    <div class="col-2">
                                        <!-- checkbox -->
                                        <input type="checkbox" class="mr-2 check-item">
                                        <!-- item code -->
                                        ITEM0004
                                    </div>
                                    <div class="col-4">
                                        <!-- item name -->
                                        Item 4 (pack)
                                    </div>
                                    <div class="col-1 text-center">
                                        <!-- item amount -->
                                        1
                                    </div>
                                    <div class="col-2 text-right text-monospace">
                                        <!-- item price -->
                                        10.000
                                    </div>
                                    <div class="col-2 text-right text-monospace">
                                        <!-- item total -->
                                        10.000
                                    </div>
                                    <div class="col-1 text-right">
                                        <span class="text-danger cursor-pointer btn-delete-item"><i class="fas fa-times fa-fw"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row item-list-footer border-top border-bottom py-2">
                                <div class="col-7"></div>
                                <div class="col-2 text-right">
                                    Subtotal
                                </div>
                                <div class="col-2 text-right text-monospace">
                                    1.410.000
                                </div>
                            </div>
                            <div class="row item-list-footer border-top border-bottom py-2">
                                <div class="col-7"></div>
                                <div class="col-2 text-right">
                                    Diskon
                                </div>
                                <div class="col-2 text-right text-monospace">
                                    0
                                </div>
                            </div>
                            <div class="row item-list-footer border-top border-bottom py-2">
                                <div class="col-7"></div>
                                <div class="col-2 text-right">
                                    Total
                                </div>
                                <div class="col-2 text-right text-monospace">
                                    1.410.000
                                </div>
                            </div>
                            <div class="row item-list-footer border-top border-bottom py-2">
                                <div class="col-7"></div>
                                <div class="col-2 text-right">
                                    Bayar
                                </div>
                                <div class="col-2 text-right text-monospace">
                                    <input type="text" class="form-control form-control-sm text-right p-0 border-0">
                                </div>
                            </div>
                            <div class="row item-list-footer border-top border-bottom py-2">
                                <div class="col-7"></div>
                                <div class="col-2 text-right">
                                    Kembali
                                </div>
                                <div class="col-2 text-right text-monospace">
                                    90.000
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
        var selectedItem = null;
        const cart_changes = new Event('cart_changes');
        $(document).ready(function() {
            $('.item-list').html('');
            $('#add_barang_item').select2({
                width: '100%',
                placeholder: 'Pilih barang',
                ajax: {
                    url: '<?= admin_url('items/select2') ?>',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term,
                            page: params.page
                        };
                    },
                    processResults: function(data) {
                        // return mapping of object
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.id,
                                    text: item.text,
                                    code: item.code,
                                    name: item.name,
                                    stock: parseInt(item.stock),
                                    unit: item.unit,
                                    price: parseInt(item.price),
                                }
                            }),
                        };
                    },
                    cache: true
                }
            });
        });

        $('#add_barang_item').on('select2:select', function(e) {
            selectedItem = e.params.data;
            $('#add_barang_item').next('small.text-danger').text('');
        });

        $(document).on('click', '#btn_add_item', function(e) {
            e.preventDefault();

            var amount = parseInt($('#add_barang_amount').val()) || 0;
            if (selectedItem == null) {
                $('#add_barang_item').nextAll('small.text-danger').text('Pilih barang terlebih dahulu');
                return;
            }
            if (amount > selectedItem.stock) {
                $('#add_barang_item').next('small.text-danger').text('Stok barang kosong');
                return;
            }
            if (amount == 0) {
                $('#add_barang_amount').closest('.input-group').next('small.text-danger').text('Jumlah barang tidak boleh kosong');
                return;
            }
            var item = {
                id: selectedItem.id,
                code: selectedItem.code,
                name: selectedItem.name,
                amount: amount,
                unit: selectedItem.unit,
                price: selectedItem.price,
                price_string: selectedItem.price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."),
                total: amount * selectedItem.price,
                total_string: (amount * selectedItem.price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."),
            };


            var html = "";
            html += '<div class="row item-row border-bottom py-2">';
            html += '    <div class="col-2">';
            html += '        <input type="checkbox" class="mr-2 check-item">';
            html += '        <span class="item-code">__code__</span>';
            html += '    </div>';
            html += '    <div class="col-4">';
            html += '        <span class="item-name">__name__ (__unit__)</span>';
            html += '    </div>';
            html += '    <div class="col-1 text-center">';
            html += '        <span class="item-amount">__amount__</span>';
            html += '    </div>';
            html += '    <div class="col-2 text-right">';
            html += '        <span class="item-price text-monospace">__price_string__</span>';
            html += '    </div>';
            html += '    <div class="col-2 text-right">';
            html += '        <span class="item-total text-monospace">__total_string__</span>';
            html += '    </div>';
            html += '    <div class="col-1 text-center">';
            html += '        <span class="text-danger cursor-pointer btn-delete-item"><i class="fas fa-times fa-fw"></i></span>';
            html += '    </div>';
            html += '</div>';

            $.each(item, function(key, value) {
                html = html.replace('__' + key + '__', value);
            });

            $('.item-list').append(html);

            $('#add_barang_item').val(null).trigger('change');
            $('#add_barang_amount').val(1);
            $('#add_barang_form').find('small.text-danger').text('');
            selectedItem = null;

            document.dispatchEvent(cart_changes);
        });



        $(document).on('change', '#check_all_items', function() {
            if ($(this).is(':checked')) {
                $('.check-item').prop('checked', true);
            } else {
                $('.check-item').prop('checked', false);
            }
        });

        $(document).on('change', '.check-item', function() {
            if ($('.check-item:checked').length == $('.check-item').length) {
                $('#check_all_items').prop('checked', true);
            } else {
                $('#check_all_items').prop('checked', false);
            }
        });

        $(document).on('click', '.btn-delete-item', function() {
            $(this).closest('.item-row').remove();
        });
    </script>
</body>

</html>