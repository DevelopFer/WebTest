$(document).ready(function(){
    initializeTags();
    $('#summernote').summernote({
         placeholder: 'Write here the body content of this awesome new post...',
        tabsize: 2,
        height: 300,
        airmode:false,
        popover: {},
        toolbar: [
             // [groupName, [list of button]]
            ['style', ['italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });


    $(document.body).on('click','button.btn-upload',function(){
        var file = $(this).closest('div.imgContainer').find('input[type="file"]');
        file.trigger('click');
    });

    $(document.body).on('change', 'input[type="file"]', function(){
        var file = $(this).prop('files')[0];
        var reader = new FileReader();
        reader.onloadend = function() {
            $('img#post-image').attr('src', reader.result);
        }
        reader.readAsDataURL(file);
    });
    $(document.body).on('submit', 'form.ajaxForm', function(e){
        e.preventDefault();
        var form = $(this);
        var name = $(this).find('input[name="name"]').val().trim();
        if(name.length <= 0){
            alert("Please insert a name for this tag");
        }else{
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:$(this).attr('action'),
                method:'POST',
                data:{name:$(this).find('input[name="name"]').val()},
                dataType:'json',
                success:function(r){
                    if(r.success){
                        initializeTags();
                        form.find('button.dismiss').trigger('click');
                    }else{
                        alert("Error trying to create the new tag");
                    }
                },
                error:function(){
                    console.log("err");
                }
            });
        }
    });
});

function initializeTags(){
    var selects =  $('.select2');
    $.each(selects, function(){
        var select = $(this);
        $.ajax({
            url:$(this).data('url'),
            method:'get',
            dataType:'json',
            success:function(tags){
                var data = [];
                for(var i = 0; i < tags.length; i++){
                    data.push({id:tags[i].id, text:tags[i].name});
                }
                select.select2({
                    data:data
                });
            },
            error:function(){
                console.log("error");
            }
        });
    });
};



