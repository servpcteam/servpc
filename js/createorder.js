$(document).ready(function() {
	$('.create-order').click(function() {
	
		var sprzet = document.querySelector('#dodanie select[name="sprzet"]').value;
		var numerseryjny = document.querySelector('#dodanie input[name="numerseryjny"]').value;
		var producent = document.querySelector('#dodanie input[name="producent"]').value;
		var opis = document.querySelector('#dodanie input[name="opis"]').value;
		console.log(opis)

		$.ajax({
			method: "POST",
			url: './php/create_order.php',
			data: {
				sprzet: sprzet
				numerseryjny : numerseryjny
				producent : producent
				opis : opis
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