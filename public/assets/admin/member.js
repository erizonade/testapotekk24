$(function () {
    LOAD();

    $(".created").click(function () {
        $("#id").val("");
        $(".text-danger").empty();
        $("#modal-member").modal("show");
    });

    
    $(document).on("click",".view",function(){
        $("#modal-view").modal("show");
        let id = $(this).data("id")
        $(".view-member").empty()
        $.ajax({
            url: "/admin/member/" + id,
            type: "GET",
            success: function (data)
            {
                let res = data.response
                if (res.success == 200)
                {
                    let val = res.data
                    $(".foto-member").attr('src','/data/images/'+val.foto)
                    view_member = `
                    <tr>
                     <td>Nama  </td><td> : </td><td>`+val.nama_member+`</td>
                    </tr>
                    <tr>
                     <td>Email </td><td> : </td><td>`+val.email+`</td>
                    </tr>
                    <tr>
                     <td>No Hp </td><td> : </td><td>`+val.no_hp+`</td>
                    </tr>
                    <tr>
                     <td>No Ktp </td><td> : </td><td>`+val.nomor_ktp+`</td>
                    </tr>
                    <tr>
                     <td>Tanggal Lahir </td><td> : </td><td>`+val.tanggal_lahir+`</td>
                    </tr>
                    <tr>
                     <td>Jenis Kelamin </td><td> : </td><td>`+(val.jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan')+`</td>
                    </tr>
                    `                      
                    
                    $(".view-member").append(view_member)
                }
            }
        })
    })

    $(document).on("click", ".edit", function () {
        $(".text-danger").empty();
        $("#modal-member").modal("show");
        let id = $(this).data("id");
        $.ajax({
            url: "/admin/member/" + id + "/edit",
            type: "GET",
            success: function (data) {
                let res = data.response;
                if (res.success == 200) {
                    let val = res.data;
                    console.log(val)
                    $("#id").val(val.id);
                    $("#nama_member").val(val.nama_member);
                    $("#email").val(val.email);
                    $("#no_hp").val(val.no_hp);
                    $("#nomor_ktp").val(val.nomor_ktp);
                    $("#tanggal_lahir").val(val.tanggal_lahir);
                    $("#jenis_kelamin").val(val.jenis_kelamin);
                }
            },
        });
    });

    $(document).on("click", ".delete", function () {
        let id = $(this).data("id");
        $.ajax({
            url: "/admin/member/" + id,
            type: "DELETE",
            success: function (data) {
                let res = data.response;
                if (res.success == 200) {
                    swallSuccess("Success", res.message);
                    LOAD();
                }
            },
        });
    });

    $("#form-member").submit(function () {
        $(".text-danger").empty();
        data = [];

        let id = $("#id").val();
        if (id != "") {
            url = "/admin/member/" + id + patch;
            type = "POST";
        } else {
            url = "/admin/member";
            type = "POST";
        }

        let proses = {
            url: url,
            type: type,
            data: data,
            error: function (xhr) {
                ERROR_ALERT(xhr);
            },
            success: function (data) {
                let res = data.response;
                if (res.success == 200) {
                    swallSuccess("Success", res.message);
                    LOAD();
                    $("#modal-member").modal("hide");
                }
            },
        };
        $(this).ajaxSubmit(proses);
        return false;
    });

    function LOAD() {
        $("#member").DataTable({
            order: [0, "desc"],
            processing: true,
            serverSide: true,
            bDestroy: true,
            searching: true,
            stateSave: true,
            autoWidth: false,
            ajax: function (data, callback, setting) {
                $.ajax({
                    url: "/admin/member",
                    type: "GET",
                    data: data,
                    error: function (xhr) {
                        callback({
                            draw: 1,
                            recordsTotal: 0,
                            recordFiltered: 0,
                            data: [],
                        });
                    },
                    success: function (data) {
                        let res = data.response;
                        if (res.success == 200) {
                            callback(res.data);
                        }
                    },
                });
            },
        });
    }

});
