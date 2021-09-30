$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function swallError(title, text) {
    Swal.fire({
        type: 'error',
        title:title,
        text: text,
        timer : 3000,
      })
}

let patch = "?_method=PATCH";

function ERROR_ALERT(xhr) {
    
    if (xhr.status == 422) {
        $.each(xhr.responseJSON.errors, function (key, val) {
            $("#"+key).closest('div').append("<span class='text-danger'>"+val+"</span>")
        })
    }
}

function swallSuccess(title, text) {
    Swal.fire({
        type: 'success',
        title:title,
        text: text,
        timer : 3000,
      })
}

function swalLoading() {
    Swal.fire({
        title: 'Harap Tunggu!',
        html: '<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div> Loading ...',
        timer: 2000,
        timerProgressBar: true,
    })
}