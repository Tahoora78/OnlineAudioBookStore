
function pm(type,text){
    toastr.options = {
        timeOut: 5000,
        progressBar: true,
        showMethod: "slideDown",
        hideMethod: "slideUp",
        showDuration: 200,
        hideDuration: 200,
        positionClass: "toast-bottom-left",
    };
    if(type == 'success'){ toastr.success(text); }else if(type == 'error'){ toastr.error(text); }else if(type == 'info'){ toastr.info(text); }else if(type == 'warning'){ toastr.warning(text); }
}