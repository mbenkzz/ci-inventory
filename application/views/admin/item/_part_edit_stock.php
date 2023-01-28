<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="edit_barang_title">Edit Stok : <?= $item->name ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form id="form_update_stock">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <!-- show nama barang -->
                        <div class="col-12">
                            Kategori : <?php echo $item->category_name ?>
                        </div>
                        <div class="col-12">
                            <b class="h5"><?php echo "[{$item->item_code}] {$item->name}" ?></b>
                            <input type="hidden" name="id" value="<?php echo $item->id ?>">
                        </div>
                        <div class="col-12">
                            <?php echo $item->description ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="edit_barang_harga_beli">Harga Beli</label>
                        </div>
                        <div class="col-8">
                            <?php echo $item->buy_price ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="edit_barang_harga_jual">Harga Jual</label>
                        </div>
                        <div class="col-8">
                            <?php echo $item->sell_price ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="edit_barang_stok">Tambah Stok</label>
                        </div>
                        <div class="col-5">
                            <!-- input group with increase decrease button -->
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button" data-toggle="input-number" data-action="minus"><i class="fas fa-minus fa-fw"></i></button>
                                </div>
                                <input type="text" class="form-control input-number text-center" name="stock" id="edit_barang_stok" value="0" min="0">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" data-toggle="input-number" data-action="plus"><i class="fas fa-plus fa-fw"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <label><?= $item->unit ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="edit_barang_stok">Stok setelah penambahan</label>
                        </div>
                        <div class="col-8">
                        <span id="edit_barang_stok_before"><?php echo $item->stock ?></span> + <span id="edit_barang_stok_addition">0</span> = <span id="edit_barang_stok_total"><?php echo $item->stock ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary" id="edit_barang_stok_submit" disabled>Simpan</button>
            </div>
        </form>
    </div>
</div>