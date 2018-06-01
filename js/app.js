$(document).ready(function() {
	$('.delete-client').click(function() {
		console.log("click")
		var id = $(this).data('id');

		$.ajax({
			method: "POST",
			url: './php/delete_client.php',
			data: {
				id: id
			},
			success: function(result) {
				console.log("successfull");
				alert(result);
			},
			error: function(result) {
				console.log("error");
			}
		})
	});
});