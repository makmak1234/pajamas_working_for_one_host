//ajax для маленькой корзины
function goodsbasketcheck(row, clearone, plus)
{
//	document.getElementById('basketsmall').innerHTML = plus;
//nocache = "&nocache=" + Math.random() * 1000000;
//clearone1 = "&clearone=" + clearone;
//document.getElementById('querymy').innerHTML = row;
var query = plus + "basketsmall.php?mclon=" + clearone + "&id=" + row + "&nocache=" + Math.random() * 1000000;

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

/*function formregis(){
	//document.body.style.opacity = "0.3";
	//document.body.style.brightness = "50%"; 
	formreg = document.getElementById("formregis");
	formreg.style.display = "block";
}*/

function formregok(bsbigclsal){
	document.getElementById("formregis").style.display = "none";
	window.location.href = bsbigclsal;
}

function fregsub1(form){
	organiz = form.organiz.value;
	city = form.city.value;
	tel = form.tel.value;
	email = form.email.value;
	dirbsbigcl = form.dirbsbigcl.value;
	
	params = "organiz=" + organiz + "&city=" + city + "&tel=" + tel + "&email=" + email;
//document.getElementById('querymy').innerHTML = params;	
	request = new ajaxRequest()
	request.open("POST", dirbsbigcl, true)//basketbigclear.php
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
	request.setRequestHeader("Content-length", params.length)
	request.setRequestHeader("Connection", "close")
	
	request.onreadystatechange = function()
	{
		if (this.readyState == 4)
		{
			if (this.status == 200)
			{
				if (this.responseText != null)
				{
					document.getElementById("valcode").style.display = "block";
					document.getElementById("valbutton").type = "button";
					document.getElementById("mysubmit").type = "hidden";
					document.getElementById("valpass").innerHTML = this.responseText;
					request.abort(null)
				}
				else alert("Ajax error: No data received")
			}
			else alert( "Ajax error: " + this.statusText)
		}
	}

	
	request.send(params)
}

function fpasssub2(form){
	document.getElementById("ajaxload").style.display = "block";
	valpass = form.inpvalpass.value;
	params = "valpass=" + valpass;
	dirbsbigcl = form.dirbsbigcl.value;
//document.getElementById('querymy').innerHTML = params;	
	request = new ajaxRequest()
	request.open("POST", dirbsbigcl, true)//basketbigclear.php
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
	request.setRequestHeader("Content-length", params.length)
	request.setRequestHeader("Connection", "close")
	
	request.onreadystatechange = function()
	{
		if (this.readyState == 4)
		{
			if (this.status == 200)
			{
				if (this.responseText != null)
				{
					//document.getElementById("valcode").style.display = "block";
					//document.getElementById("valbutton").type = "button";
					//document.getElementById("mysubmit").type = "hidden";
					txtreply = this.responseText;
					//myreply = JSON.parse(txtreply); //JSON.parse
					//myreply = JSON.parse(txtreply);
					myreply = this.responseText;
					arreply = myreply.split('","');
					organiz = arreply[3];
					city = arreply[4];
					tel = arreply[5];
					email = arreply[6];
					valpass = arreply[7];
					if(organiz)document.getElementById("organiz").value = organiz;
					if(city)document.getElementById("city").value = city;
					if(tel)document.getElementById("tel").value = tel;
					if(email)document.getElementById("email").value = email;
					if(valpass){
						document.getElementById("valcode").style.display = "block";
						document.getElementById("valbutton").type = "button";
						document.getElementById("mysubmit").type = "hidden";
						document.getElementById("valpass").innerHTML = valpass;
						document.getElementById("incorrval").innerHTML = "Код верный";
						document.getElementById("valbutton").onclick();
					}
					else document.getElementById("incorrval").innerHTML = "Код неверный";
					document.getElementById("ajaxload").style.display = "none";
					request.abort(null)
				}
				else alert("Ajax error: No data received")
			}
			else alert( "Ajax error: " + this.statusText)
		}
	}

	
	request.send(params)
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
