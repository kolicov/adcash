tinymce.init({
  selector: '.tinyMce',
  setup : function(ed) {
    ed.on('change', function(e) {
      // This will print out all your content in the tinyMce box
      console.log('the content '+ed.getContent());
      // Your text from the tinyMce box will now be passed to your  text area ...
      $(".tinymce").text(ed.getContent());
    });
  }
});
$("#wrapper").on("change", "#inputId", function(){});

$('.multiple').select2({
  maximumInputLength: 10
});

$('.select2').select2();

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#blah')
        .attr('src', e.target.result)
        .width(200)
        .height(200);
    };
    reader.readAsDataURL(input.files[0]);
  }
}

$('a[href="#myModal"]').click(function () {
    $('#id').val($(this).attr('rel_id'));
    $('#price').val($(this).prev().html());
});

$('#myModal #edit').click(function (e) {
    e.preventDefault();
    $('form#edite_price').submit();
});

$('form#edite_price').ajaxForm({
    dataType: 'json',
    success: function (data) {
        $('#item_' + $('form#edite_price #id').val()).html($('form#edite_price #price').val());
        $('#myModal .close').click();
    }
});

// $('form').submit(function () {
//     tinyMCE.triggerSave();
// });

$("div.multimedia_holder").sortable();