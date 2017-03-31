//ajax для маленькой корзины
function goodsbasketcheck(row, clearone, plus)
{
//	document.getElementById('basketsmall').innerHTML = plus;
//nocache = "&nocache=" + Math.random() * 1000000;
//clearone1 = "&clearone=" + clearone;
//document.getElementById('querymy').innerHTML = row;
var query = plus + "basketsmallm.php?mclon=" + clearone + "&id=" + row + "&nocache=" + Math.random() * 1000000;

request = new ajaxRequest;

request.open("GET", query, true);

request.onreadystatechange = function()
{
	if (this.readyState == 4)
	{
		if (this.status == 200)
		{
			if (this.responseText != null)
			{
				document.getElementById('basketsmall').innerHTML = this.responseText
				request.abort(null)
			}
			else alert("Ajax error: No data received")
		}
		else alert( "Ajax error: " + this.statusText)
	}
}
	
request.send(null)
}

function ajaxRequest()
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
