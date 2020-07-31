var url = "http://team4code/users";

$(document).on('click','.open_modal',function(){
    var user_id = $(this).val();

    $.get(url + '/' + user_id, function (data) {
        //success data
        console.log(data);
        $('#user_id').val(data.id);
        $('#name').val(data.name);
        $('#email').val(data.email);
        $('#password').val(data.password);
        $('#btn-save').val("update");
        $('#myModal').modal('show');
    })
});

$('#btn_add').click(function(){
    $('#btn-save').val("add");
    $('#frmUsers').trigger("reset");
    $('#myModal').modal('show');
});

$(document).on('click','.delete-user',function(){
    var user_id = $(this).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    })
    $.ajax({
        type: "DELETE",
        url: url + '/' + user_id,
        success: function (data) {
            console.log(data);
            $("#user" + user_id).remove();
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});

$("#btn-save").click(function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    })
    e.preventDefault();
    var formData = {
        name: $('#name').val(),
        email: $('#email').val(),
        password: $('#password').val(),

    }
    //used to determine the http verb to use [add=POST], [update=PUT]
    var state = $('#btn-save').val();
    var type = "POST"; //for creating new resource
    var user_id = $('#user_id').val();
    var my_url = url;
    if (state == "update"){
        type = "PUT"; //for updating existing resource
        my_url += '/' + user_id;
    }
    console.log(formData);
    $.ajax({
        type: type,
        url: my_url,
        data: formData,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            var user = '<tr id="user' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.email + '</td><td>' + data.password + '</td>';
            user += '<td><button class="btn btn-warning btn-detail open_modal" value="' + data.id + '">Edit</button>';
            user += ' <button class="btn btn-danger btn-delete delete-user" value="' + data.id + '">Delete</button></td></tr>';
            if (state == "add"){ //if user added a new record
                $('#users-list').append(user);
            }else{ //if user updated an existing record
                $("#user" + user_id).replaceWith( user );
            }
            $('#frmUsers').trigger("reset");
            $('#myModal').modal('hide')
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});