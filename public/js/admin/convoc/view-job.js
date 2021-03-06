$(document).ready(function() {

    $('#uploadDocument').on('click', function(e) {
        e.preventDefault()
        e.stopPropagation()
        $('#formDocumentNew').trigger('reset')
        $('#modalDocumentNew').modal('show')
    })

    $('#formDocumentNew').on('submit', function(e) {
        e.preventDefault()
        e.stopPropagation()
        let form = $(this)
        if (form[0].checkValidity()) {
            showLoading()
            var data_ = new FormData();
            var form_data = $(this).serializeArray();
            $.each(form_data, function(key, input) {
                data_.append(input.name, input.value)
            });
            data_.append('file_document', $("#formDocumentNew input[name=file_document]")[0].files[0])

            var params = new window.URLSearchParams(window.location.search);
            $.ajax({
                url: `/admin/jobs/upload-result/${params.get('job_id')}`,
                type: 'POST',
                data: data_,
                processData: false,
                contentType: false,
                success: function(data) {
                    /*$('#modal-loading').modal('hide')
                    $('#modalDocumentNew').modal('hide')
                    $('#modalSuccess .modal-body').empty().append(data.message)
                    $('#modalSuccess').modal('show')
                    form[0].reset()
                    form[0].classList.remove('was-validated')*/
                    location.reload()
                },
                error: function(e) {
                    Swal.close()
                    error(e.responseJson.error)
                }
            });
        }
    })

    $('.edit-document').on('click', function(e) {
        e.preventDefault()
        e.stopPropagation()
        let id = $(this).attr('data-id')
        let type = $(this).attr('data-type')
        let date = $(this).attr('data-publication')
        let text = $(this).attr('data-name')

        $('#formDocumentEdit input[name="type_document_text"]').val(text)
        $('#formDocumentEdit input[name="date_publication"]').val(date)
        $('#modalDocumentEdit').modal('show')

        $('#formDocumentEdit').on('submit', function(e) {
            e.preventDefault()
            e.stopPropagation()
            let form = $(this)
            if (form[0].checkValidity()) {
                showLoading()
                var data_ = new FormData();
                var form_data = $(this).serializeArray();
                $.each(form_data, function(key, input) {
                    data_.append(input.name, input.value)
                });
                data_.append('file_document', $("#formDocumentEdit input[name=file_document]")[0].files[0])
                data_.append('type_document', type)
                $.ajax({
                    url: `/admin/jobs/change-document/${id}`,
                    type: 'POST',
                    data: data_,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.success) {
                            location.reload()
                        } else {
                            Swal.close()
                            $('#modalDocumentNew').modal('hide')
                            error(data.message)
                            form[0].reset()
                            form[0].classList.remove('was-validated')
                        }
                        /*$('#modal-loading').modal('hide')
                        $('#modalDocumentNew').modal('hide')
                        $('#modalSuccess .modal-body').empty().append(data.message)
                        $('#modalSuccess').modal('show')
                        form[0].reset()
                        form[0].classList.remove('was-validated')*/
                        //location.reload()
                    },
                    error: function(e) {
                        Swal.close()
                        error(e)
                    }
                });
            }

        })

    })

    $('.delete-document').on('click', function(e) {
        e.preventDefault()
        e.stopPropagation()
        let id = $(this).attr('data-id')
        Swal.fire({
                title: '??Desea eliminar este archivo?',
                text: "El archivo se eliminara permanentemente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    showLoading()
                    $.ajax({
                        url: `/admin/jobs/delete-document/${id}`,
                        type: 'POST',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        success: function(data) {
                            if (data.Success) {
                                //$('#modal-loading').modal('hide')
                                location.reload();
                            } else {
                                Swal.close()
                                error(data.message)
                            }
                        },
                        error: function(e) {
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


    function showLoading() {
        Swal.fire({
            title: '??Subiendo archivos!',
            html: 'Espere un momento',
            allowOutsideClick: false,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
            }
        })
    }

    function error(error) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: error,
            confirmButtonColor: "#D40E1E"
        })
    }

    function success(message) {
        Swal.fire({
            icon: 'success',
            title: 'Exito',
            text: `??${message}!`,
            confirmButtonColor: "#28a745"
        })
    }
})