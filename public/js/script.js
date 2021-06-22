$(".delete").click(function (e) { 
	e.preventDefault();
	var dataUrl = $(this).attr("data-url");
	$("#confirmModal a").attr("href", dataUrl);
	$("#confirmModal").modal("show");
});