$(document).ready(function(){
    $('#form-login').on('submit', function(e){
        e.preventDefault()
        e.stopPropagation()
        let form = $(this)
        
        if (form[0].checkValidity()) {
            //console.log($(this).serialize())
            $.ajax({
                url : `/login-verification-candidate`,
                type : 'POST',
                data : $(this).serialize(),
                success: function(data){
                    //console.log(data)
                    if(!data.success){
                        //console.log('mal')
                        $('#notificacion-error').empty().append(`
                        <div class="notification error closeable" >
                        <p><span>Error!</span> ${data.error}</p>
                        <a class="close"></a></div>`
                        )
                    }else{
                        window.location.href = '/candidate/profile'
                    }
                },
                error:function(e){
                    alert(e)
                }
            });
        }
    })

    /*function error(error){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '¡Ha ocurrido un error!',
            footer: error,
            confirmButtonColor: "#D40E1E"
        })
    }*/

})