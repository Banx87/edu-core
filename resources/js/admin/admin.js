import $ from "jquery";
window.$ = window.jQuery = $;

var notyf = new Notyf();

const base_url = $(`meta[name="base_url"]`).attr("content");
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
				headers: {
					"X-CSRF-TOKEN": csrf_token,
				},
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

$(function () {
	const selectedTab = localStorage.getItem("selectedPaymentSettingTab");
	if (selectedTab) {
		$("#" + selectedTab + "_settings").addClass("active show");
		$("#" + selectedTab).addClass("active show");
	} else {
		$("#paypal_settings, #paypal").addClass("active show");
	}
});

$(".paymentSettingTab").on("click", function () {
	var tabs = document.getElementsByClassName("paymentSettingTab");

	for (const tab of tabs) {
		tab.classList.remove("active", "show");
		this.classList.add("active", "show");
		localStorage.setItem("selectedPaymentSettingTab", this.getAttribute("id"));
	}
});

/* Certificate Builder */
// Certificate builder elements draggable
$(function () {
	$(".draggable_item").draggable({
		containment: "#certificate_body",
		stop: function (event, ui) {
			// console.log(event);
			// console.log(ui);

			// Get the ID of the dragged element
			var id = $(this).attr("id");

			console.log(id);

			// Get the current position of the dragged element
			var position = ui.position;

			$.ajax({
				method: "POST",
				url: `${base_url}/admin/certificate-item-position`,
				data: {
					_token: csrf_token,
					element_id: id,
					x_position: position.left,
					y_position: position.top,
				},
				success: function (data) {},
				error: function (xhr, status, error) {
					notyf.error(error);
				},
			});
		},
	});
});
