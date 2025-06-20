import "./cart.js";

const csrf_token = $(`meta[name="csrf_token"]`).attr("content");
const base_url = $(`meta[name="base_url"]`).attr("content");
const reloadUrl = base_url + "/instructor/courses/update";

var notyf = new Notyf({
	types: [
		{
			type: "info",
			background: "#356df1",
			icon: true,
			position: {
				x: "center",
				y: "top",
			},
			duration: 5000,
			dismissible: true,
		},
	],
});

// MODAL SPINNER
var loader = `
<div class="modal-content text-center" style="display: inline; padding: 1.6rem;">
   <div class="spinner-border text-primary" style="width: 1rem; height: 1rem;" role="status">
  		<span class="visually-hidden">Loading...</span>
	</div>
</div>`;

// Ez share init
document.addEventListener("DOMContentLoaded", function () {
	ezShare.execute();
});

$(function () {
	// Dynamic delete popup
	$(".delete-item").on("click", function (e) {
		e.preventDefault();

		let url = $(this).attr("href");

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
	});

	// Subscribe to newsletter
	$(".newsletter-form").on("submit", function (e) {
		e.preventDefault();

		let formData = $(this).serialize();

		$.ajax({
			method: "POST",
			url: `${base_url}/newsletter-subscribe`,
			data: formData,
			beforeSend: function () {
				$(".newsletter_btn").html(loader);
				$(".newsletter_btn").attr("disabled", true);
			},
			success: function (data) {
				notyf.success(data.message);
			},
			error: function (xhr, error, status) {
				notyf.error(xhr.responseJSON.message);
			},
			complete() {
				$(".newsletter_btn").text("Subscribe");
				$(".newsletter_btn").attr("disabled", false);
				$(".newsletter-form").trigger("reset");
			},
		});
	});

	// Notify that the feature is not implemented yet
	$(".TODO").on("click", function (e) {
		notyf.open({
			type: "info",
			message: "This feature is not implemented yet.",
		});
	});
});

/* TinyMCE */
document.addEventListener("DOMContentLoaded", function () {
	let options = {
		selector: ".editor",
		height: 300,
		menubar: false,
		statusbar: false,
		plugins:
			"advlist autolink lists link image charmap print preview" +
			"anchor searchreplace visualblocks code fullscreen" +
			"insertdatetime media table paste code help wordcount",
		toolbar:
			"undo redo | blocks formatselect | " +
			"bold italic backcolor | alignleft aligncenter " +
			"alignright alignjustify | bullist numlist outdent indent | " +
			"removeformat | help",
		content_style:
			"body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }",
	};
	if (localStorage.getItem("tablerTheme") === "dark") {
		options.skin = "oxide-dark";
		options.content_css = "dark";
	}
	tinyMCE.init(options);
});
