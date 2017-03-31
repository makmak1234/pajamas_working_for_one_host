//это изменение кол-ва
function basketbigclear(row2, nidk, k, itemnumber){
	
	priceall = 0;
	price = new Array();
	nid = new Array();
	//nid[k] = nidk;
	//document.getElementById("divid").innerHTML = "ni0= " + nid[0] + " ni1= " + nid[1] + "  pri0= " + pri[0] + " pri1= " + pri[1];
	row2 = row2 * nidk; //стоимость текущего товара на кол-во
	idnidk = "idnidk" + k;

	idrowk = "idrowk" + k;//стоимость текущего товара на кол-во
	document.getElementById(idrowk).innerHTML = row2;
	
	for(i=0; i < itemnumber; i++){
		idrowk = "idrowk" + i;
		idrow2 = "idrow2" + i;
		//div = document.getElementById(idrowk);
		//text = div.firstChild;
		price[i] = Number(document.getElementById(idrow2).firstChild.data);
		nid[i] = Number(document.getElementById(idnidk).firstChild.data);
		priceall = priceall + Number(document.getElementById(idrowk).firstChild.data);
		//document.getElementById("divid").innerHTML = text.data;
	}
	document.getElementById("priceall").innerHTML = "Стоимость всего: " + priceall

	
	nid1 = 4;
	query = "basketbigclear.php?kg2=" + k + "&nidaj=" + nidk + "&nocache2=" + Math.random() * 1000000;

	request2 = new ajaxRequest2;

	request2.open("GET", query, true);

	request2.onreadystatechange = function()
	{
		if (this.readyState == 4)
		{
			if (this.status == 200)
			{
				if (this.responseText != null)
				{
					//document.getElementById("idback").innerHTML = this.responseText
				}
				else alert("Ajax error: No data received")
			}
			else alert( "Ajax error: " + this.statusText)
		}
	}
	
	request2.send(null)
}

function ajaxRequest2()
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

