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
                    $('#modal-loading').modal('hide')
                    $('#modalDocumentNew').modal('hide')
                    $('#modalSuccess .modal-body').empty().append(data.message)
                    $('#modalSuccess').modal('show')
                    form[0].reset()
                    form[0].classList.remove('was-validated')
                    table.ajax.reload();
                },
                error:function(e){
                    $('#modal-loading').modal('hide')
                    error(e)
                }
            });
        }
    })

    function error(e){
        $('#modalSuccess .modal-header').empty().append('Error')
        $('#modalSuccess .modal-body').empty().append(e.responseJSON.message)
        $('#modalSuccess').modal('show')
    }

})