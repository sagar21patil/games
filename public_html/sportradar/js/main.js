$(document).ready(function () {

//sportfilter function will get called on Submit event
  $('#sportfilter').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var oneFilled = checkFields(form);
        ///User should select at least one field for filter
        if(oneFilled==true)
        {
          //Ajax call to pull requested data from API
          $.ajax({
              url: "api/events/read.php",
              data: form.serialize(),
              dataType: "json",
              type: "POST",
              success: function (data) {
                $('div.table-responsive').html(data);
              },
              error: function(xhr, status, error){
                //If API return error then it will display to user
                 var errorMessage = xhr.status + ': ' + xhr.statusText
                 alert('Error - ' + errorMessage);
             }

          });
        }else {
          alert("Please select at least one field");
        }

    });

});

//Below function return true or false on basis of fields are filled or not
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
