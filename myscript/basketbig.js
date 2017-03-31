function basketbig(row2, nidk, k, itemnumber){ //(row2, nidk, nid, pri, k)
	//document.getElementById("divid").innerHTML = idtd;
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
	
	//document.getElementById('divid').innerHTML = "request1";
	//nid1 = 4;
	
	query1 = "basketbigrequest.php?te=" + nid + "&nocache=" + Math.random() * 1000000

	request1 = new ajaxRequest1

	request1.open("GET", query1, true)
	
		//document.getElementById('divid').innerHTML = this.;

	request1.onreadystatechange = function()
	{
		if (this.readyState == 4)
		{
			if (this.status == 200)
			{
				if (this.responseText != null)
				{
					document.getElementById("idback").innerHTML = "this.responseText"
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


