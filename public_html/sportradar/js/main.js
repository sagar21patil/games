$(document).ready(function () {

  $('#sportfilter').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var oneFilled = checkFields(form);
        ///alert(oneFilled);
        if(oneFilled==true)
        {
          $.ajax({
              url: "api/events/read.php",
              data: form.serialize(),
              dataType: "json",
              type: "POST",
              success: function (data) {
                $('div.table-responsive').html(data);
              },
              error: function(xhr, status, error){
                 var errorMessage = xhr.status + ': ' + xhr.statusText
                 alert('Error - ' + errorMessage);
             }

          });
        }else {
          alert("Please select at least one field");
        }

    });

});

function fetchData()
{
  var formdata=$("#sportfilter").serialize();
  //var $form = $(this).closest("form").attr('id');
  //var oneFilled = checkFields(formdata);
  alert($(this).closest("form").attr('id'));
  $.ajax({
      url: "api/events/read.php",
      data: formdata,
      dataType: "json",
      type: "POST",
      success: function (data) {
        $('div.table-responsive').html(data);
      },
      error: function(xhr, status, error){
         var errorMessage = xhr.status + ': ' + xhr.statusText
         alert('Error - ' + errorMessage);
     }

  });
}
function checkFields(form) {
        inputs = form.find(':input').not('[type="submit"],[type="button"],[type="reset"]'),
        filled = inputs.filter(function(){
            return $.trim($(this).val()).length > 0;
        });

    if(filled.length === 0) {
        return false;
    }

    return true;
}
