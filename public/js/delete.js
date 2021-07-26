$(function() {
    $('.delete').click(function() {
        //alert('Coś')
        //Swal.fire('Hello world!')
       /* var _this = this;*/
        var confirmation = confirm("Are you sure?");
        if (confirmation){
        Swal.fire({
            title: 'confirmDelete',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Tak',
            cancelButtonText: 'Nie'
        }).then((result) => {
            if (result.value) {
                /*alert('usuwaj ' + result.value +$(this).data("id") )*/
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
        }
    });
});
