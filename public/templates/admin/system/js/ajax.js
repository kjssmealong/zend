$(document).ready(function () {
    var table = $('#myTable').DataTable();
    $('#myTable tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
            $(this).addClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

});


function restoreAjax(id, status) {

    axios({
        method: 'post',
        url: "./restore",
        headers: {'Content-Type': 'application/json'},
        params: {
            id: id,
            status: status
        }
    }).then(function (response) {
        var color = status ? 'btn-danger' : 'btn-success';
        var icon = status ? 'fa-toggle-off' : 'fa-toggle-on';
        var testStatus = status ? 0 : 1;
        var test = "<a class='btn btn-sm " + color + "'href='javascript:void(0)'  onclick='restoreAjax(" + id + "," + testStatus + " )'><i class='fas " + icon + "'></i></a>";
        $('#status-' + id).html(test);
    }).catch(function (error) {
        alert("Fail");
    });
}

function deleteFunction(id) {
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
                deleteAjax(id),
                'success'
            )
        }
    })
}


function restoretrashAjax(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "do you want to restore it ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, restore it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                axios({
                    method: 'post',
                    url: "./restoretrash/id/" + id,
                }).then(function (response) {
                    var table = $('#myTable').DataTable();
                    table.row('.selected').remove().draw(false);
                }).catch(function (error) {
                    alert("Fail");
                }),
                'success'
            )
        }
    })
}

function deltrashAjax(id) {
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
                axios({
                    method: 'post',
                    url: "./deltrash/id/" + id,
                }).then(function (response) {
                    var table = $('#myTable').DataTable();
                    table.row('.selected').remove().draw(false);
                }).catch(function (error) {
                    alert("Fail");
                }),
                'success'
            )
        }
    })
}

function deleteAjax(id) {
    axios({
        method: 'post',
        url: './delete/id/' + id,
    }).then(function (response) {
        var table = $('#myTable').DataTable();
        table.row('.selected').remove().draw(false);
    }).catch(function (error) {
        alert("Fail");
    });
}