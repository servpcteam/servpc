$(document).ready(function() {
	$('.edit-status').click(function() {
		//console.log("click")
		var id = $(this).data('id');
		//console.log(id)
		$.ajax({
			method: "POST",
			url: './php/edit_status.php',
			data: {
				id: id
			},
			complete:function(){location.reload()},
			
			success: function(result) {
				//console.log("successfull");
				//alert(result);

			},
			error: function(result) {
				console.log("error");
			}
		})
	});
});