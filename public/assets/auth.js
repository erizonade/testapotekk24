$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$(function () {
    $("#form-login-user").submit(function () {
        $(".text-danger").empty();
        data = [];
        let login = {
            url: "/login",
            type: "POST",
            data: data,
            error: function (xhr) {
                if (xhr.status == 422) {
                    $.each(xhr.responseJSON.errors, function (key, val) {
                        $("#" + key)
                            .closest("div")
                            .append(
                                "<span class='text-danger'>" + val + "</span>"
                            );
                    });
                }
            },
            success: function (data) {
                let res = data.response;
                if (res.success == 200) {
                    window.location.href = res.url;
                }

                if (res.error == 401) {
                    swallError("Opps", res.message);
                }
            },
        };
        $(this).ajaxSubmit(login);
        return false;
    });

    $(".modal-member").click(function(){
        $("#modal-member").modal("show")
    })

    $("#form-member").submit(function () {
        $(".text-danger").empty();
        data = [];

        url = "/registrasi";
        type = "POST";

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
                    $("#modal-member").modal("hide");
                }
            },
        };
        $(this).ajaxSubmit(proses);
        return false;
    });


});
