function resetValues() {
    $('#ward').empty();
    $('#ward').append(new Option('Please select', '', true, true));	
    $('#ward').attr("disabled", "disabled");		
}


function populateLGA(xmlindata) {

var mySelect = $('#LGA');
 $('#ward').disabled = false;
$(xmlindata).find("LGA").each(function()
  {
  optionValue=$(this).find("id").text();
  optionText =$(this).find("name").text();
   mySelect.append($('<option></option>').val(optionValue).html(optionText));	
  });
}

function populateWard(xmlindata) {

var mySelect = $('#ward');
$('#ward').removeAttr('disabled');    
$(xmlindata).find("ward").each(function()
  {
  optionValue=$(this).find("id").text();
  optionText =$(this).find("name").text();
   mySelect.append($('<option></option>').val(optionValue).html(optionText));	
  });
}
