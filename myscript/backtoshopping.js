
		function backtoshopping(dirpajs){
			namesurname = document.getElementById("namesurname").value;
			city = document.getElementById("city").value;
			tel = document.getElementById("tel").value;
			email = document.getElementById("email").value;
			query = dirpajs + "?namesurname=" + namesurname + "&city=" + city + "&tel=" + tel + "&email=" + email;
			//alert(' query: ' + query);
			window.location.href = query;
		}
