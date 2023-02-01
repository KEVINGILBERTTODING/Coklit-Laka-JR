var flashData = $('.flash-data').data('flashdata');
if (flashData) {
    Swal.fire({
        title: 'Data',
        text: flashData,
        type: 'success'
    });

}

// Button Delete
$('.btn-delete').on('click', function (e) {
	e.preventDefault();
	const href = $(this).attr('href');
	Swal.fire({
		title: 'Apakah anda yakin?',
		text: "Proposal akan dihapus",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#2596BE',
		cancelButtonColor: '#F5365C',
		confirmButtonText: 'Ya, hapus proposal!'
	}).then((result) => {
		if (result.value) {
			document.location = href;
		}
	})

});



// Button Update
$('.btn-update').on('click', function (e) {
	
	Swal.fire({
		title: 'Apakah anda yakin?',
		text: "Data akan diupdate",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#2596BE',
		cancelButtonColor: '#F5365C',
		confirmButtonText: 'Ya, update data!'
	}).then((result) => {
		if (result.value) {
		
		}
	})



});

