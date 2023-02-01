<script src="<?php echo base_url(); ?>assets/assets/js/jquery-3.6.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/js/jquery.mask.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url(); ?>assets/assets/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/assets/js/app.min.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/assets/js/myscript.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<script>
	$(document).ready(function() {

		window.alert = function() {};

	});
</script>
<script type="text/javascript">
	$(document).ready(function() {

		// Format mata uang.
		$('.uang').mask('000.000.000.000', {
			reverse: true
		});

	})
</script>

<!-- Cek if user is exist or not -->
<script>
	$(document).ready(function() {
		$.ajax({
			url: "<?php echo base_url('dcm/dashboard/cekUser') ?>",
			type: "POST",
			dataType: "JSON",
			success: function(data) {
				if (data.status == 'success') {
					$('.sidenav').removeClass('d-none');
				} else {
					$('#alertDialog').modal('show');
					$('.sidenav').addClass('d-none');
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	});
</script>


<script type="text/javascript">
	$(document).ready(function() {
		var date = new Date();
		var jam = date.getHours();
		if (jam >= 0 && jam <= 10) {
			$('.greeting').html('Selamat Pagi,  <?php echo $nama_lengkap; ?>');

		} else if (jam >= 11 && jam <= 14) {
			$('.greeting').html('Selamat Siang');
		} else if (jam >= 15 && jam <= 18) {
			$('.greeting').html('Selamat Sore');
		} else {
			$('.greeting').html('Selamat Malam');
		}
	});
</script>
