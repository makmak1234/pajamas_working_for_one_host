function pause(nameId, mouse){
	if (mouse == "mouseout2" || mouse == "mouseover2"){
		nameId += "_pause2"; 
	}
	else{
		nameId += "_pause";
	}	
	var lr_pause = document.getElementById(nameId); // id left_pause
	if (mouse == "mouseover" || mouse == "mouseover2"){ 
		lr_pause.style.display = "block";
		//left_pause.style.opacity = "0";
		//left_pause.style.opacity = "0.5";
		//left_pause.style.transition = "opacity 0.5s ease-out 0.5s";
		//left_pause.style.opacity = "0.5";
	}
	if (mouse == "mouseout" || mouse == "mouseout2"){ lr_pause.style.display = "none";}
}

function entranceeditor(){
	
}

