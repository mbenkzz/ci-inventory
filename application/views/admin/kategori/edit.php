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
                    <h1 class="mt-4">Update Kategori</h1>

                    <a href="<?= admin_url('category') ?>" class="btn btn-danger btn-sm mb-4"><i class="fas fa-arrow-left fa-fw mr-2"></i>Kembali ke tabel</a>

                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <form id="category_form">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="mb-1 font-size-20" for="inputName">Nama Kategori</label>
                                                    <input class="form-control py-4" id="inputName" name="name" type="text" placeholder="Masukkan nama kategori" maxlength="64" value="<?= $category->name ?? '' ?>"/>
                                                    <small class="form-text text-danger"></small>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="mb-1 font-size-20" for="inputDescription">Keterangan</label>
                                                    <textarea class="form-control" id="inputDescription" name="description" rows="3" placeholder="Deskripsi / Keterangan"><?= $category->description ?? '' ?></textarea>
                                                    <small class="form-text text-danger"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary">Simpan</button>
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
    <?php $this->load->view('admin/template-parts/scripts') ?>
    <script>
        $(document).ready(function() {

            $('#category_form').on('submit', function(e) {
                e.preventDefault()

                var form = this
                $.ajax({
                    url: '<?= admin_url("category/edit/{$category->id}") ?>',
                    type: "POST",
                    data: new FormData(form),
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(json) {
                        if (json.status == 'success') {
                            swal_success(json.message).then((value) => {
                                window.location.href = '<?= admin_url("category") ?>'
                            })
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
                        swal_error(xhr.status + ' ' + thrownError)
                    }
                })
            })
        })
    </script>
</body>

</html>