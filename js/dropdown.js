	jQuery().ready(function($){
			 
		// Ajax Called When Page is Load/Ready (Load LGA)
		jQuery.ajax({
						  url: 'LGA.php',
						  global:false,
						  type: "POST",
						  dataType: "xml",
						  async: true,	
						  success: populateLGA
						}); 
					
					

		//Ajax Called When You Change  LGA Name
		$("#LGA").change(function (env) 
			{
			 resetValues();	
			 	var data = { lga :$('#LGA').val()	};
			 		//console.log(data);
			jQuery.ajax({
							  url: 'ward.php',
							  type: "POST",
							  dataType: "xml",
							  data:data,
							  async: true,	
							  success: populateWard
						}); 
			});
	
		});	
	
