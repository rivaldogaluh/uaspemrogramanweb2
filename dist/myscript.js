const flashData = $('.flash-data').data('flashdata');

if (flashData) {
    Swal.fire({
        title: 'Your Data Has Been ' + flashData,
        icon: 'success'
    });
}

//tombol hapus
$('.tombol-hapus').on('click', function (e) {

    e.preventDefault();

    const href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah kamu yakin?',
        text: "data ini akan dihapus",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Iya, hapus.',
        cancelButtonText: 'Batal.'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })

});