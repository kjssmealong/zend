function restoreAjax(id , status, file) {
    $.ajax({
        type: "POST",
        url: 'http://localhost/zend/admin/' + file + '/restore/id/'+id,
        data: 'id=' + id + '&status=' + status,
        success: function (e) {
            var color = status ? 'btn-danger'  : 'btn-success';
            var icon = status ?  'fa-toggle-off' : 'fa-toggle-on' ;
            var testStatus = status ? 0 : 1;
            var test = "<a class='btn btn-sm " + color + "'href='#' onclick='restoreAjax(" + id + "," + testStatus + ")'><i class='fas " + icon +"'></i></a>";
            $('#status-' + id).html(test);
        },
    });
}

function deleteFunction(id , file) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                deleteAjax(id, file),
                'success'
            )
        }
    })
}



function deleteAjax(id, file) {
    $.ajax({
        type: "POST",
        url: 'http://localhost/zend/admin/' + file +'/delete/id/'+id,
        data: id,
        success: function (e) {
            window.location.reload(e);
        },
        contentType: "application/json",
        dataType:  "text"
    });
}