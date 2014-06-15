(function(){
	$("form").submit(function(){
		var propContainer = $("#prop_container input");
		var propListValue = '';
		
		for ($i=0; $i<propContainer.length; $i++){
			var input = $(propContainer[$i]);
			var num = parseInt(input.val());
			if (num == 0 || isNaN(num)){
				continue;
			}
			
			var id = input.attr('id');
			var one = id + '-' + num + ';';
			propListValue += one; 
		}
		
		$("#prop_list").val(propListValue);
	});
})();