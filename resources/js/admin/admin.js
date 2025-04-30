import $ from "jquery";
window.$ = window.jQuery = $;

const csrf_token = $('meta[name="csrf-token"]').attr("content");
let delete_url = null;

$(".delete-item").on("click", function (e) {
	e.preventDefault();

	let url = $(this).attr("href");
	delete_url = url;

	$("#modal-danger").modal("show");
});

$(".delete-confirm").on("click", function (e) {
	e.preventDefault();

	$.ajax({
		method: "DELETE",
		url: delete_url,
		data: { _token: csrf_token },
		beforeSend: function () {
			$(".delete-confirm").text("Deleting...");
		},
		success: function (data) {
			location.reload();
		},
		error: function (xhr, status, error) {},
	});
});
