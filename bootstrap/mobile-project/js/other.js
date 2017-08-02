  		      function sideBar(id){
			var showSideBar1 = document.getElementById("showSideBar1");
			var showSideBar2 = document.getElementById("showSideBar2");
			var sidbox = document.getElementById("sid-box");
			
			  if(id==1){
					showSideBar1.style.display = "none";
					showSideBar2.style.display = "block";
	 				sidbox.style.display = "block";
	    }
			  else{
			  	showSideBar2.style.display = "none";
			  	showSideBar1.style.display = "block";
	    		sidbox.style.display = "none";
			  }
	    
}    