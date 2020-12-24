$(document).on("click", ".delete", function (e) {
    e.preventDefault();
    e.stopPropagation();
    var route = $(this).attr('href');
    var token = $("meta[name='csrf-token']").attr("content");
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value === true) {
            $.ajax({
                url: route,
                type: 'DELETE',
                data: {
                    "_token": token,
                },
                success: function () {
                    window.location.reload();
                }
            })
        }else {
            Swal.fire({
                title :'Canceled!',
                timer : 1500,
            })
        }
    })

});


