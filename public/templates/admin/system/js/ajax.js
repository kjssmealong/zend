$(document).ready(function() {
    var table = $('#myTable').DataTable();
    $('#myTable tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );

} );

function restoreAjax(id , status, file) {
    $.ajax({
        type: "POST",
        url: "./restore/id/"+id,
        data: 'id=' + id + '&status=' + status ,
        success: function (e) {
            var color = status ? 'btn-danger'  : 'btn-success';
            var icon = status ?  'fa-toggle-off' : 'fa-toggle-on' ;
            var testStatus = status ? 0 : 1;
            var test = "<a class='btn btn-sm " + color + "'href='#'  onclick='restoreAjax(" + id + "," + testStatus + ",  `" +    file  + "`  )'><i class='fas " + icon +"'></i></a>";
            $('#status-' + id).html(test);
        },
        error: function (e) {
            alert("Fail");
        }
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



function restoretrashAjax(id , file) {
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
                $.ajax({
                    type: "POST",
                    url: "./restoretrash/id/"+id,
                    success: function (e) {
                        var table = $('#myTable').DataTable();
                        table.row('.selected').remove().draw( false );
                    },
                    error: function (e) {
                        alert("Fail");
                    },
                    contentType: "application/json",
                }),
                'success'
            )
        }
    })
}

function deltrashAjax(id , file) {
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
                $.ajax({
                    type: "POST",
                    url: "./deltrash/id/"+id,
                    success: function (e) {
                        var table = $('#myTable').DataTable();
                        table.row('.selected').remove().draw( false );
                    },
                    error: function (e) {
                        alert("Fail");
                    },
                    contentType: "application/json",
                }),
                'success'
            )
        }
    })
}

function deleteAjax(id, file) {
    $.ajax({
        type: "POST",
        url: './delete/id/'+id,
        success: function (e) {
            var table = $('#myTable').DataTable();
            table.row('.selected').remove().draw( false );
        },
        error: function (e) {
            alert("Fail");
        },
        contentType: "application/json",
        dataType:  "text"
    });
}