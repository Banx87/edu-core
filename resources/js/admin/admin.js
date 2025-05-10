import $ from "jquery";
window.$ = window.jQuery = $;

var notyf = new Notyf();

const csrf_token = $('meta[name="csrf_token"]').attr("content");
let delete_url = null;

$(function () {
	$(".select2").select2();
});

$(".delete-item").on("click", function (e) {
	e.preventDefault();

	let url = $(this).attr("href");
	// delete_url = url;

	Swal.fire({
		title: "Are you sure?",
		text: "You won't be able to revert this!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, delete it!",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				method: "DELETE",
				url: url,
				data: { _token: csrf_token },
				beforeSend: function () {},
				success: function (data) {
					// Swal.fire({
					// 	title: "Deleted!",
					// 	text: "Selected lesson has been deleted.",
					// 	icon: "success",
					// });
					window.location.reload();
				},
				error: function (xhr, error, status) {
					notyf.error(error);
				},
				complete() {},
			});
		}
	});

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
			window.location.reload();
		},
		error: function (xhr, status, error) {
			window.location.reload();
			// let errorMessage = xhr.responseJSON;
			// notyf.error(errorMessage.message);
		},
		complete: function () {
			// $(".delete-confirm").text("Delete");
		},
	});
});
