	jQuery().ready(function($){

		// Ajax Called When Page is Load/Ready (Load Category)
		jQuery.ajax({
						  url: 'farmcat.php',
						  global:false,
						  type: "POST",
						  dataType: "xml",
						  async: true,	
						  success: populateCat
						}); 
					
					

		//Ajax Called When You Change  Category Name
		$("#category").change(function () 
			{
			 resetValues();	
			    var data = { cat :$('#category').val()	};
			    //console.log(data);
			jQuery.ajax({
							  url: 'farm_type.php',
							  type: "POST",
							  dataType: "xml",
							  data:data,
							  async: true,	
							  success: populateType
						}); 
			});
	
		});	
	
