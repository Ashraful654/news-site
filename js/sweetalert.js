$(".DeleteUser").click(function() {
    let id = $(this).attr("data-id");
    // alert(id);
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                swal("Poof! Your imaginary file has been deleted!", {
                    icon: "success",
                });
                window.setTimeout(function() {
                    window.location.href = 'backend/delete-user.php?id=' + id;
                }, 5000);

            } else {
                swal("Your imaginary file is safe!");
            }
        });
});