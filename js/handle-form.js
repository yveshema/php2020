function showForm(){
    var form = document.getElementById("the-form");
    form.classList.toggle('show');
}

$(document).ready(function(){
    $('#the-form').on('submit', function(e){
	e.preventDefault();

	$.ajax({
	    type: "POST",
	    url: "DiDiCo.php",
	    data: new FormData(this),
	    dataType: 'json',
	    contentType: false,
	    cache: false,
	    processData: false,
	    complete: function(response){
		$("#the-form").css("display","none");
		alert("done");
	    }


	});

    });

});

