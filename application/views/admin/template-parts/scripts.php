<script src="<?= base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/chart.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/datatables.bootstrap.min.js') ?>"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?= base_url('assets/js/scripts.js') ?>"></script>
<script>
    function logout() {
        swal({
                title: "Log out",
                text: "Apakah anda yakin log out dari aplikasi? Anda akan diarahkan ke halaman login",
                icon: "warning",
                buttons: ["Tidak", "Ya"],
                dangerMode: true,
            })
            .then((ya) => {
                if (ya) {
                    window.location.href = '<?= admin_url('logout') ?>';
                }
            });
    }
</script>