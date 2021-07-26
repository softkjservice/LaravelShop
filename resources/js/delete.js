$(function() {
    $('.delete').click(function() {
        Swal.fire({
            title: 'confirmDelete_00',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Tak',
            cancelButtonText: 'Nie'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    method: "DELETE",
                    url: deleteUrl + $(this).data("id")
                })
                .done(function (data) {
                    window.location.reload();
                })
                .fail(function (data) {
                    Swal.fire('Oops...', data.responseJSON.message, data.responseJSON.status);
                });
            }
        })
    });
});
