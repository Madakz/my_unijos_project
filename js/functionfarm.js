function resetValues() {
    $('#farm_type').empty();
    $('#farm_type').append(new Option('Please select', '', true, true));	
    $('#farm_type').attr("disabled", "disabled");		
}


function populateCat(xmlindata) {

var mySelect = $('#category');
 $('#farm_type').disabled = false;
$(xmlindata).find("category").each(function()
  {
  optionValue=$(this).find("id").text();
  optionText =$(this).find("name").text();
   mySelect.append($('<option></option>').val(optionValue).html(optionText));	
  });
}

function populateType(xmlindata) {

var mySelect = $('#farm_type');
$('#farm_type').removeAttr('disabled');    
$(xmlindata).find("type").each(function()
  {
  optionValue=$(this).find("id").text();
  optionText =$(this).find("name").text();
   mySelect.append($('<option></option>').val(optionValue).html(optionText));	
  });
}
