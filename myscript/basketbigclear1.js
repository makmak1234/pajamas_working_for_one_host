//это удаление
function basketbigclear1(idclear, idtr, kgoods){
	idtr = "idtr" + kgoods;
	//alert(' idclear: ' + idclear + ' idtr: ' + idtr + ' kgoods: ' + kgoods);
	//document.getElementById('divid').innerHTML = idtr;
	//document.getElementById(idtr).innerHTML = "";
	//basketbig = document.getElementById('idbasketbig');
	//document.parentNode.removeChild(document.getElementById("divid1"));
	//document.getElementById('divid').innerHTML = idtr;
	//document.getElementsByName("numbergoods").onchange();
	
	query = "basketbigclear1.php?idclear1=" + idclear + "&kgoods1=" + kgoods + "&nocache1=" + Math.random() * 1000000;

	request1 = new ajaxRequest2;

	request1.open("GET", query, true);

	request1.onreadystatechange = function()
	{
		if (this.readyState == 4)
		{
			if (this.status == 200)
			{
				if (this.responseText != null)
				{
					document.getElementById("iddivbasketbig").innerHTML = this.responseText
				}
				else alert("Ajax error: No data received")
			}
			else alert( "Ajax error: " + this.statusText)
		}
	}
	
	request1.send(null)
}

function ajaxRequest1()
{
	try
	{
		var request = new XMLHttpRequest()
	}
	catch(e1)
	{
		try
		{
			request = new ActiveXObject("Msxml2.XMLHTTP")
		}
		catch(e2)
		{
			try
			{
				request = new ActiveXObject("Microsoft.XMLHTTP")
			}
			catch(e3)
			{
				request = false
			}
		}
	}
	return request
}

