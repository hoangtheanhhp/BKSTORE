 $(document).ready(function(){
 	var path = window.location.pathname.split("tmdt1.890m.com/").pop();
 	if (path=="/") {
 		path="home";
 	}
   	if (path =="home") {
	   	$("#home a:contains('Home')").parent().addClass('active');
	   }
	if (path.search('san-pham') ==1) {
	  $("#san-pham").addClass('active');
	 } 
	if ((path.search('tin-tuc-danh-gia') ==1) || (path.search('tin-tuc') ==0))
	 {
	  $("#tin-tuc-danh-gia").addClass('active');
	 }
 });