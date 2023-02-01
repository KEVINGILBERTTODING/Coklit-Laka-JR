<script src="<?php echo base_url(); ?>assets/assets/js/jquery-3.6.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/assets/js/jquery.mask.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url(); ?>assets/assets/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/assets/js/app.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" type="text/javascript"></script>
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


<script>
	$('#dark-version').change(function() {
		if ($(this).is(':checked')) {
			localStorage.setItem('dark-mode', 'true');
			// Perintah untuk dark mode
			$('body').addClass('bg-default');
			$('body').addClass('text-default');
			$('body').addClass('dark-version');
			$('body').addClass('navbar-dark');
			$('body').addClass('bg-dark');
			$('body').addClass('sidebar-dark');
			$('body').addClass('navbar-dark');
			$('body').addClass('settingbar-dark');
			$('#sidenav-main').removeClass('bg-white');
			$('body').addClass('footer-dark');
		} else {
			localStorage.setItem('dark-mode', 'false');
			console.log('cliked')
			// Perintah untuk light mode
			$('body').removeClass('bg-default');
			$('body').removeClass('text-default');
			$('body').removeClass('dark-version');
			$('body').removeClass('navbar-dark');
			$('body').removeClass('bg-dark');
			$('body').removeClass('sidebar-dark');
			$('body').removeClass('navbar-dark');
			$('body').removeClass('settingbar-dark');
			$('#sidenav-main').addClass('bg-white');
			$('body').removeClass('footer-dark');
		}
	});
</script>



<script>
	$(document).ready(function() {
		if (localStorage.getItem('dark-mode') == 'true') {
			console.log(localStorage.getItem('dark-mode'));
			$('#dark-version').prop('checked', true);

			// Perintah untuk dark mode
			$('body').addClass('bg-default');
			$('body').addClass('text-default');
			$('body').addClass('dark-version');
			$('body').addClass('navbar-dark');
			$('body').addClass('bg-dark');
			$('body').addClass('sidebar-dark');
			$('body').addClass('navbar-dark');
			$('body').addClass('settingbar-dark');
			$('#sidenav-main').removeClass('bg-white');
			$('body').addClass('footer-dark');
			$('.navbar-vertical .navbar-nav .nav-link').addClass('text-white');


		} else {
			console.log(localStorage.getItem('dark-mode'));
			$('#dark-version').prop('checked', false);
			// Perintah untuk light mode
			$('body').removeClass('bg-default');
			$('body').removeClass('text-default');
			$('body').removeClass('dark-version');
			$('body').removeClass('navbar-dark');
			$('body').removeClass('bg-dark');
			$('body').removeClass('sidebar-dark');
			$('body').removeClass('navbar-dark');
			$('body').removeClass('settingbar-dark');
			$('#sidenav-main').addClass('bg-white');
			$('body').removeClass('footer-dark');
			$('.navbar-vertical .navbar-nav .nav-link').removeClass('text-white');

		}
	});
</script>
