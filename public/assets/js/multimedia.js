$(function () {
    $('#upload_form form').ajaxForm({
        dataType: 'json',
        success: function (data) {
            $('div.multimedia_holder').oLoader('hide');
            if (data.status) {
                $.each(data.files, function (index, value) {
                    var id = 1;
                    if ($('div.multimedia_holder .thumbnail').length != undefined)
                        id = $('div.multimedia_holder .thumbnail').length + 1;

                    var class1 = '';
                    if ((id == 1) && (id % 5 == 1))
                        class1 = 'row';

                    var holder = $('<div />').attr({class: "col-lg-3 col-md-4 col-xs-6 thumb" + class1, id: 'image_' + id});

                    holder.append($('<input />').attr({type: 'hidden', name: 'image_ids[]', value: ''}));
                    holder.append($('<input />').attr({type: 'hidden', name: 'image_urls[]', value: value}));
                    holder.append($('<input />').attr({type: 'hidden', name: 'image_description[]', value: ''}));

                    var thumbnail = $('<div />').attr({class: "thumbnail"});
                    thumbnail.append($('<button />').attr({
                        type: "button", class: "close", onclick: 'removeFile(' + id + ')', 'data-dismiss': 'alert', 'aria-label': 'Close'
                    }).append($('<span />').attr({'aria-hidden': 'true'}).append('×')));

                    thumbnail.append($('<a />').attr({
                        href: '#description_class', class: "description button", onclick: 'addDescription(' + id + ')', 'data-toggle': 'modal', 'data-target': '#description_class'
                    }).append($('<span />').attr({'aria-hidden': 'true'}).append('<i class="fa fa-align-justify" aria-hidden="true"></i>')));

                    thumbnail.append($('<img />').attr({class: "img-responsive", src: value, style: 'max-height: 147px!important;'}));
                    holder.append(thumbnail);

                    $('div.multimedia_holder').append(holder);
                });
            } else {
                alert(data.message);
            }
        }
    });

    $('#description_class a#save').click(function (e) {
        e.preventDefault();
        $('#image_' + $('#description_class #modal_image_id').val() + ' input[name="image_description[]"]').val($('#description_class #modal_description').val());
        $('#description_class .close').click();
    });
});

tinymce.init({
    selector: '.tinyMce',
    inline: true,
    hidden_input: false
});

/**
 * this code will open upload dialog box
 */
function showUploadDialog() {
    $('#files').trigger('click');
}

/**
 * his code will submits form after files have been selected 
 */
function uploadFiles() {
    $('div.multimedia_holder').oLoader({
        backgroundColor: '#fff',
        image: '/assets/images/ownageLoader/loader4.gif',
        fadeInTime: 500,
        fadeOutTime: 1000,
        fadeLevel: 0.5
    });
    $('#upload_form form').submit();
}

/**
 * 
 * remuve attach file
 */

function removeFile(id) {
    $('#image_' + id).remove();
}

function addDescription(id) {
  $('#description_class #modal_description').val($('#image_' + id + ' input[name="image_description[]"]').val());
  $('#description_class #modal_image_id').val(id);
}