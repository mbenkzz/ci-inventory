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
                    <h1 class="mt-4">Edit Barang : </h1>

                    <a href="<?= admin_url('items') ?>" class="btn btn-danger btn-sm mb-4"><i class="fas fa-arrow-left fa-fw mr-1"></i><i class="fas fa-table mr-2"></i>Kembali ke tabel</a>
                    <a href="<?= admin_url('items') ?>" class="btn btn-info btn-sm mb-4 disabled"><i class="fas fa-arrow-left fa-fw mr-1"></i><i class="fas fa-info-circle mr-2"></i>Kembali ke detail barang</a>

                    <div class="row mt-4">
                        <div class="col-lg-9 col-xl-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-box mr-1"></i>
                                    <b><?= $item->item_code ?></b>
                                    <?= $item->name ?>
                                    <span class="badge badge-primary mx-2"><?= $item->category_name ?></span>
                                </div>
                                <div class="card-body pt-3">
                                    <form id="edit_barang">
                                        <input type="hidden" name="id" value="<?= $item->id ?>">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="mb-1 font-size-20" for="inputCategory">Kategori</label>
                                                    <select class="form-control" id="inputCategory" name="category_id">
                                                        <option value="">Pilih kategori</option>
                                                        <?php foreach ($categories as $category) : ?>
                                                            <option value="<?= $category->id ?>" <?= $item->category_id == $category->id ? "selected" : "" ?>><?= $category->name ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <small class="form-text text-danger"></small>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <!-- nama barang -->
                                                    <label class="mb-1 font-size-20" for="inputName">Nama Barang</label>
                                                    <input type="text" class="form-control" id="inputName" name="name" value="<?= $item->name ?>">
                                                    <small class="form-text text-danger"></small>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <!-- satuan -->
                                                    <label class="mb-1 font-size-20" for="inputUnit">Satuan</label>
                                                    <input type="text" class="form-control" id="inputUnit" name="unit" value="<?= $item->unit ?>">
                                                    <small class="form-text text-danger"></small>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <!-- harga beli -->
                                                    <label class="mb-1 font-size-20" for="inputPrice">Harga Beli</label>
                                                    <input type="number" class="form-control" id="inputPrice" name="buy_price" value="<?= $item->buy_price ?>" min="0">
                                                    <small class="form-text text-danger"></small>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <!-- harga jual -->
                                                    <label class="mb-1 font-size-20" for="inputSalePrice">Harga Jual</label>
                                                    <input type="number" class="form-control" id="inputSalePrice" name="sell_price" value="<?= $item->sell_price ?>" min="0">
                                                    <small class="form-text text-danger"></small>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <!-- deskripsi -->
                                                    <label class="mb-1 font-size-20" for="inputDescription">Deskripsi / Keterangan</label>
                                                    <textarea class="form-control" id="inputDescription" name="description" rows="3"><?= $item->description ?></textarea>
                                                    <small class="form-text text-danger"></small>
                                                </div>
                                            </div>
                                            <!-- submit -->
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php $this->load->view('admin/template-parts/footer') ?>
        </div>
    </div>
    <div class="modal fade" id="modal_update_stock" data-backdrop="static" tabindex="-1"></div>
    <?php $this->load->view('admin/template-parts/scripts') ?>
    <script>
        $(document).ready(function() {

        });

        $('#edit_barang').on('submit', function(e) {
            e.preventDefault();
            var form = this

            $.ajax({
                url: "<?= admin_url('items/edit/' . $item->id) ?>",
                type: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    $(form).find('button[type=submit]').attr('disabled', true)
                },
                complete: function() {
                    $(form).find('button[type=submit]').attr('disabled', false)
                },
                success: function(json) {
                    if (json.status == 'success') {
                        swal("Data berhasil diubah!", {
                            icon: "success",
                        }).then((value) => {
                            location.reload();
                        });
                    } else {
                        // remove all help block
                        $(form).find('small').text('')
                        // add help block
                        $.each(json.message, function(key, value) {
                            var input = $(form).find('[name="' + key + '"]')

                            var help_block = input.next('small')
                            help_block.text(value)
                        })
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    swal_error(thrownError);
                }
            });
        });
    </script>
</body>

</html>