const base_url = $(`meta[name="base_url"]`).attr("content");
const basic_info_url = base_url + "/instructor/courses/create";
const update_url = base_url + "/instructor/courses/update";

// Initialize Notyf
var notyf = new Notyf({
	duration: 5000,
	dismissible: true,
});

var loader = `
<div class="modal-content text-center" style="display: inline; padding: 5rem;">
   <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
  		<span class="visually-hidden">Loading...</span>
	</div>
</div>`;

// Course tab navigation
$(".course-tab").on("click", function (e) {
	e.preventDefault();
	let step = $(this).data("step");
	$(".course-form").find("input[name=next_step]").val(step);
	$(".course-form").trigger("submit");
});

//

$(".basic_info_form").on("submit", function (e) {
	e.preventDefault();
	let formData = new FormData(this);

	$.ajax({
		method: "POST",
		url: basic_info_url,
		data: formData,
		contentType: false,
		processData: false,
		beforeSend: function () {},
		success: function (data) {
			if (data.status === "success") {
				window.location.href = data.redirect;
			}
		},
		error: function (xhr, status, error) {
			let errors = xhr.responseJSON.errors;

			$.each(errors, function (key, value) {
				notyf.error(value[0]);
			});
			// console.log(xhr);
		},
		complete: function () {},
	});
});

$(".more_info_form").on("submit", function (e) {
	e.preventDefault();
	let formData = new FormData(this);

	$.ajax({
		method: "POST",
		url: update_url,
		data: formData,
		contentType: false,
		processData: false,
		beforeSend: function () {},
		success: function (data) {
			if (data.status == "success") {
				window.location.href = data.redirect;
			}
		},
		error: function (xhr, status, error) {
			let errors = xhr.responseJSON.errors;

			$.each(errors, function (key, value) {
				notyf.error(value[0]);
			});
		},
		complete: function () {},
	});
});

$(".basic_info_update_form").on("submit", function (e) {
	e.preventDefault();
	let formData = new FormData(this);

	$.ajax({
		method: "POST",
		url: update_url,
		data: formData,
		contentType: false,
		processData: false,
		beforeSend: function () {},
		success: function (data) {
			if (data.status === "success") {
				window.location.href = data.redirect;
			}
		},
		error: function (xhr, status, error) {
			let errors = xhr.responseJSON.errors;

			$.each(errors, function (key, value) {
				notyf.error(value[0]);
			});
		},
		complete: function () {},
	});
});

// Show / hide path input on source
$(".preview_video_storage").on("change", function () {
	let value = $(this).val();
	$(".source_input").val("");
	$("#holder").html(""); // Empty the fileViewers preview image

	if (value == "upload") {
		$(".file_source").removeClass("d-none");
		$(".input_source").addClass("d-none");
	} else if (value !== "upload") {
		$(".file_source").addClass("d-none");
		$(".input_source").removeClass("d-none");
	}
});

//  Course Contents

$(".dynamic_modal_btn").on("click", function (e) {
	e.preventDefault();
	$("#dynamic_modal").modal("show");

	let course_id = $(this).data("id");
	$.ajax({
		method: "GET",
		url:
			base_url +
			"/instructor/course-content/:id/create-chapter".replace(":id", course_id),
		data: {},
		beforeSend: function () {
			$(".dynamic-modal-content").html(loader);
		},
		success: function (data) {
			$(".dynamic-modal-content").html(data);
		},
		error: function (xhr, status, error) {},
	});
});
