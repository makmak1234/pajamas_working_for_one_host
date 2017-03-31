
	function submit_forms (rows) {
		var message = "Применить всё?";
		// Запросить разрешение на выполнение операции
		// и прервать ее, если разрешение не будет получено
		if (!confirm(message)) return;
	
		var allid, alltitle, allprice, alldescr;
		add = "*$#";
		//allid =  new Array();
		//alltitle = new Array();
		//allprice = new Array();
		//alldescr = new Array();
		idid = "id" + 0;
		idtitle = "title" + 0;
		//idprice = "price" + 0;
		idprretu = "idprru" + 0;
		idprretr = "idprrr" + 0;
		idprsalu = "idprsu" + 0;
		idprsalr = "idprsr" + 0;
		iddescr = "descr" + 0;
		allid = document.getElementById(idid).value;
		alltitle = document.getElementById(idtitle).value;
		//allprice = document.getElementById(idprice).value;
		allprretu = document.getElementById(idprretu).value;
		allprretr = document.getElementById(idprretr).value;
		allprsalu = document.getElementById(idprsalu).value;
		allprsalr = document.getElementById(idprsalr).value;
		alldescr = document.getElementById(iddescr).value;
//document.getElementById("divid").innerHTML = "rows=" + rows + "  ";
		for(i = 0; i <= rows-1; i++){
			idid = "id" + i; 
	//submit = "submit" + i; 
			idtitle = "title" + i;
			//idprice = "price" + i;
			idprretu = "idprru" + i;
			idprretr = "idprrr" + i;
			idprsalu = "idprsu" + i;
			idprsalr = "idprsr" + i;
			iddescr = "descr" + i;
			allid += add + document.getElementById(idid).value;
			alltitle += add +  document.getElementById(idtitle).value;
			//allprice += add +  document.getElementById(idprice).value;
			allprretu += add +  document.getElementById(idprretu).value;
			allprretr += add +  document.getElementById(idprretr).value;
			allprsalu += add +  document.getElementById(idprsalu).value;
			allprsalr += add +  document.getElementById(idprsalr).value;
			alldescr += add +  document.getElementById(iddescr).value;
			//allid[i] = document.getElementById(idid).value;
			//alltitle[i] = document.getElementById(idtitle).value;
			//allprice[i] = document.getElementById(idprice).value;
			//alldescr[i] = document.getElementById(iddescr).value;
//	textdiv = document.getElementById("divid").innerText;
//	document.getElementById("divid").innerHTML = textdiv + " alltitle= " + allid[i];
	//document.getElementById(submit).click();
		}
		document.getElementById("allid").value = allid;
		document.getElementById("alltitle").value = alltitle;
		//document.getElementById("allprice").value = allprice;
		document.getElementById("allprretu").value = allprretu;
		document.getElementById("allprretr").value = allprretr;
		document.getElementById("allprsalu").value = allprsalu;
		document.getElementById("allprsalr").value = allprsalr;
		document.getElementById("alldescr").value = alldescr;
		
	alltitle = document.getElementById("alltitle").value;
	textdiv = document.getElementById("divid").innerText;
	document.getElementById("divid").innerHTML = textdiv + " alltitle= " + alltitle;
		
		document.allsubmit.submit();
	}
	
function submit_dell(rows){

	var message = "Удалить выделенные записи?";
	// Запросить разрешение на выполнение операции
	// и прервать ее, если разрешение не будет получено
	if (!confirm(message)) return;

	iddbdell =  new Array();
	//alldell =  new Array();
	//iddbdell =  "";
	//alldell = "";
//document.getElementById("divid").innerHTML = "rows=" + rows + "  ";
	j = 0;
	for(i = 0; i <= rows-1; i++){
		iddell = "dell" + i; 
		idid = "id" + i; 
//submit = "submit" + i;
		currdell = document.getElementById(iddell).checked;
		tmpiddbdell = document.getElementById(idid).value;
		if(currdell){
			iddbdell[j] = tmpiddbdell; //= iddbdell + "," + tmpiddbdell;
			j++;
		}
//	textdiv = document.getElementById("divid").innerText;
//	document.getElementById("divid").innerHTML = textdiv + " alltitle= " + allid[i];
	//document.getElementById(submit).click();
	}
	document.getElementById("iddbdell").value = iddbdell;		
//	allidi = document.getElementById("alltitle").value;
//	textdiv = document.getElementById("divid").innerText;
//allidi = document.getElementById("iddbdell").value;
//document.getElementById("divid").innerHTML = " allidi= " + allidi;
		
	document.seldell.submit();
}

function submit_mark(rows){
		for(i = 0; i <= rows-1; i++){
			iddell = "dell" + i; 
			document.getElementById(iddell).checked = myswitch;
		}
		if(myswitch){
			myswitch = false;
			document.getElementById("allmark").value = "Снять выделения"; 
		}
		else{
			myswitch = true;
			document.getElementById("allmark").value = "Выделить всё"; 
		}
}

function price1(valpr, namepr, ipr){
	exchrtus = document.getElementsByName("exchrtus")[0].checked;
	factorus = document.getElementsByName("factorus")[0].checked;
	exchrt = document.getElementsByName("exchrt")[0].value;
	factor = document.getElementsByName("factor")[0].value;
	
	switch(namepr){
		case "prretu":
			prretu = valpr;
			if(exchrtus){
				prretr = prretu * exchrt; // руб по курсу к грн
			}
			if(factorus){
				prsalu = prretu / factor; // опт в грн по коэф к розн
				if(window.prretr !== undefined) prsalr = prretr / factor; // опт в руб по коэф к розн
			}
			break;
		case "prretr":
			prretr = valpr;
			if(exchrtus){
				prretu = prretr / exchrt; // грн по курсу к руб
			}
			if(factorus){
				if(window.prretu !== undefined) prsalu = prretu / factor; // опт в грн по коэф к розн
				prsalr = prretr / factor; // опт в руб по коэф к розн
			}
			break;
		case "prsalu":
			prsalu = valpr;
			if(exchrtus){
				prsalr = prsalu * exchrt; // руб по курсу к грн
			}
			if(factorus){
				prretu = prsalu * factor; // розн в грн по коэф к опт
				if(window.prsalr !== undefined) prretr = prsalr * factor; // розн в руб по коэф к опт
			}
			break;
		case "prsalr":
			prsalr = valpr;
			if(exchrtus){
				prsalu = prsalr / exchrt; // грн по курсу к руб
			}
			if(factorus){
				if(window.prsalu !== undefined) prretu = prsalu * factor; // розн в грн по коэф к опт
				prretr = prsalr * factor; // розн в руб по коэф к опт
			}
			break;
	}
	
	idprru = "idprru" + ipr;
	idprrr = "idprrr" + ipr;
	idprsu = "idprsu" + ipr;
	idprsr = "idprsr" + ipr;
	
	if(window.prretu !== undefined){
		prretu = Math.round(prretu);
		document.getElementById(idprru).value = prretu;
		prretu = null;
	}
	if(window.prretr !== undefined){
		prretr = Math.round(prretr);
		document.getElementById(idprrr).value = prretr;
		prretr = null;
	}
	if(window.prsalu !== undefined){
		prsalu = Math.round(prsalu);
		document.getElementById(idprsu).value = prsalu;
		prsalu = null;
	}
	if(window.prsalr !== undefined){
		prsalr = Math.round(prsalr);
		document.getElementById(idprsr).value = prsalr;
		prsalr = null;
	}
	
//document.getElementById("elem").innerHTML = " idprru= " + idprru;
	
	//document.getElementById(idprru).value = prretu;
	//document.getElementById(idprrr).value = prretr;
	//document.getElementById(idprsu).value = prsalu;
	//document.getElementById(idprsr).value = prsalr;
	exchrtus = null;
	factorus = null;
	exchrt = null;
	factor = null;
	idprru = null;
	idprrr = null;
	idprsu = null;
	idprsr = null;
	
	delete exchrtus;
	delete factorus;
	delete exchrt;
	delete factor;
	delete idprru;
	delete idprrr;
	delete idprsu;
	delete idprsr;
}
