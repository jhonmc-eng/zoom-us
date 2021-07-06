$(document).ready(function(){
    
    $('#uploadDocument').on('click', function(e){
        e.preventDefault()
        e.stopPropagation()
        $('#formDocumentNew').trigger('reset')
        $('#modalDocumentNew').modal('show')
    })

    $('#formDocumentNew').on('submit', function(e){
        e.preventDefault()
        e.stopPropagation()
        let form = $(this)
        if (form[0].checkValidity()) {
            $('#modal-loading').modal('show')
            var data_ = new FormData();
            var form_data = $(this).serializeArray();
            $.each(form_data, function (key, input) {
                data_.append(input.name, input.value)
            });
            data_.append('file_document',$("#formDocumentNew input[name=file_document]")[0].files[0])
            var params = new window.URLSearchParams(window.location.search);
            $.ajax({
                url : `/admin/jobs/upload-result/${params.get('job_id')}`,
                type : 'POST',
                data : data_,
                processData: false,
                contentType: false,
                success: function(data){
                    /*$('#modal-loading').modal('hide')
                    $('#modalDocumentNew').modal('hide')
                    $('#modalSuccess .modal-body').empty().append(data.message)
                    $('#modalSuccess').modal('show')
                    form[0].reset()
                    form[0].classList.remove('was-validated')*/
                    location.reload()
                },
                error:function(e){
                    $('#modal-loading').modal('hide')
                    error(e)
                }
            });
        }
    })

    $('.edit-document').on('click', function(e){
        e.preventDefault()
        e.stopPropagation() 
        let id = $(this).attr('data-id')
        let type = $(this).attr('data-type')
        let date = $(this).attr('data-publication')
        
        let url = `#formDocumentEdit > option[value='${type}']`
        $(url).attr("selected",true);
        $('#formDocumentEdit input[name="date_publication"]').val(date)
        $('#modalDocumentEdit').modal('show')

        $('#formDocumentEdit').on('submit', function(e){
            e.preventDefault()
            e.stopPropagation()
            console.log(id, type, date)
            
        })
        
    })

    $('.delete-document').on('click', function(e){
        e.preventDefault()
        e.stopPropagation()
        let id = $(this).attr('data-id')
        Swal.fire({
            title: '¿Desea eliminar este archivo?',
            text: "El archivo se eliminara permanentemente",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                
                $('#modal-loading').modal('show')
                $.ajax({
                    url : `/admin/jobs/delete-document/${id}`,
                    type : 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success:function(data){
                        if(data.Success){
                            //$('#modal-loading').modal('hide')
                            location.reload();
                        }else{
                            $('#modal-loading').modal('hide')
                            $('#modalSuccess .modal-header').empty().append('Error')
                            $('#modalSuccess .modal-body').empty().append(data.message)
                            $('#modalSuccess').modal('show')
                        }
                    },
                    error: function(e){
                        error(e)
                    }
                })
            }
        })
        /*$('#modalDeleteDocument .btn-confirmed').on('click', function(e){
            $.ajax({
                url : '/admin/jobs/',
                type : 'POST',
                success:function(data){
                    if(data.success){
                        console.log('data totalmente subida')
                    }else{
                        console.log('data totalmente subida onooooo')
                    }
                }
            })
        })*/
        

    })

    function error(e){
        $('#modalSuccess .modal-header').empty().append('Error')
        $('#modalSuccess .modal-body').empty().append(e.responseJSON.message)
        $('#modalSuccess').modal('show')
    }

})