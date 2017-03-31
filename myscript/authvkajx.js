//ajax для маленькой корзины
function authvkajx()
{
//nocache = "&nocache=" + Math.random() * 1000000;
//clearone1 = "&clearone=" + clearone;
//document.getElementById('querymy').innerHTML = row;
scope = 'offline,notes,nohttps';
var query = "authvkajx.php?nocache=" + Math.random() * 1000000;

//https://oauth.vk.com/authorize?v=5.29&client_id=4857278&redirect_uri=http://pajamas.esy.es/index.php&scope=" + scope + "&display=page"  + "&nocache=" + Math.random() * 1000000;

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
				document.getElementById('access_token').innerHTML = this.responseText
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
