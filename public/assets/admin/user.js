
$(function () {
    LOAD()

    $(".created").click(function () {
        $("#id").val("")
        $(".text-danger").empty();
        $("#modal-user").modal("show");
    })

    $(document).on("click",".view",function(){
        $("#modal-view").modal("show");
        let id = $(this).data("id")
        
        $.ajax({
            url: "/admin/user/" + id,
            type: "GET",
            success: function (data)
            {
                let res = data.response
                if (res.success == 200)
                {
                    let val = res.data
                    view_user = `
                    <tr>
                     <td>Nama : `+val.nama_user+`</td>
                    </tr>
                    <tr>
                     <td>Email : `+val.email+`</td>
                    </tr>
                    `                      
                    
                    $(".view-user").append(view_user)
                }
            }
        })
    })

    $(document).on("click", ".edit", function () {
        $(".text-danger").empty();
        $("#modal-user").modal("show");
        let id = $(this).data('id')
        $.ajax({
            url: "/admin/user/" + id + "/edit",
            type: "GET",
            success: function (data)
            {
                let res = data.response
                if (res.success == 200)
                {
                    $.each(res.data, function (key, val) {
                        $("#"+key).val(val)
                    })

                    $("#password").val("");
                }
            }
        })
    })

    $(document).on("click", ".delete", function () {
        let id = $(this).data('id')
        $.ajax({
            url: "/admin/user/" + id,
            type: "DELETE",
            success: function (data)
            {
                let res = data.response
                if (res.success == 200)
                {
                    swallSuccess('Success', res.message)
                    LOAD()
                }
            }
        })
    })


    $("#form-user").submit(function () {
        $(".text-danger").empty();
        data = [];

        let id = $("#id").val()
        if (id != '')
        {
            url = "/admin/user/"+id+patch;
            type = "POST"
        } else {
            url = "/admin/user";
            type = "POST"
            
        }

        let proses = {
            url: url,
            type: type,
            data: data,
            error: function (xhr)
            {
                ERROR_ALERT(xhr)
            },
            success: function (data) {
                let res = data.response
                if (res.success == 200) {
                    swallSuccess('Success', res.message)
                    LOAD()
                    $("#modal-user").modal("hide");
                }
            }
        }
        $(this).ajaxSubmit(proses)
        return false

    })


    function LOAD() {
        $("#user").DataTable({
            "order" : [0,'desc'],
            "processing": true,
            "serverSide": true,
            "bDestroy": true,
            "searching": true,
            "stateSave": true,
            "autoWidth": false,
            "ajax": function (data, callback, setting) {
                $.ajax({
                    url: "/admin/user",
                    type: "GET",
                    data: data,
                    error: function (xhr) {
                        callback({
                            draw: 1,
                            recordsTotal: 0,
                            recordFiltered: 0,
                            data: []
                        })
                    },
                    success: function (data)
                    {
                        let res = data.response
                        if (res.success == 200)
                        {
                            callback(res.data)
                        }
                    }
                })
            }
        })
    }

})