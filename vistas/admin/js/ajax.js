function carga_ajax(file, id){
$.ajax({
		url:file,
		type:'get',
		beforeSend: function() {
 			$('#loader').attr("style","display:block");
		},
		success: function(response) {
			$('#loader').attr("style","display:none");
			$(id).html(response);
		}
});
}