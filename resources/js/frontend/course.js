const base_url = $(`meta[name="base_url"]`).attr("content");
const basic_info_url = base_url + "/instructor/courses/create";
const update_url = base_url + "/instructor/courses/update";

const csrf_token = $(`meta[name="csrf_token"]`).attr("content");

// Initialize Notyf
var notyf = new Notyf({
	duration: 5000,
	dismissible: true,
});

// MODAL SPINNER
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

// Show / hide path input depending on source
$(document).on("change", ".preview_video_storage", function () {
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

$(".edit_chapter").on("click", function (e) {
	e.preventDefault();
	$("#dynamic_modal").modal("show");

	let chapter_id = $(this).data("chapter-id");

	$.ajax({
		method: "GET",
		url:
			base_url +
			"/instructor/course-content/:id/edit-chapter".replace(":id", chapter_id),
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

$(".add_lesson").on("click", function (e) {
	e.preventDefault();

	$("#dynamic_modal").modal("show");

	let courseID = $(this).data("course-id");
	let chapterID = $(this).data("chapter-id");

	$.ajax({
		method: "GET",
		url: base_url + "/instructor/course-content/create-lesson",
		data: {
			chapter_id: chapterID,
			course_id: courseID,
		},
		beforeSend: function () {
			$(".dynamic-modal-content").html(loader);
		},
		success: function (data) {
			$(".dynamic-modal-content").html(data);
		},
		error: function () {},
		complete: function () {},
	});
});

$(".edit_lesson").on("click", function (e) {
	e.preventDefault();

	$("#dynamic_modal").modal("show");

	let courseId = $(this).data("course-id");
	let chapterId = $(this).data("chapter-id");
	let lessonId = $(this).data("lesson-id");

	console.log(courseId);
	console.log(chapterId);
	console.log(lessonId);
	$.ajax({
		method: "GET",
		url: base_url + "/instructor/course-content/edit-lesson",
		data: {
			chapter_id: chapterId,
			course_id: courseId,
			lesson_id: lessonId,
		},
		beforeSend: function () {
			$(".dynamic-modal-content").html(loader);
		},
		success: function (data) {
			$(".dynamic-modal-content").html(data);
		},
		error: function () {},
		complete: function () {},
	});
});

if ($(".sortable_list li").length) {
	$(".sortable_list").sortable({
		items: "> li",
		containment: "parent",
		cursor: "move",
		handle: ".dragger",
		update: function (event, ui) {
			let orderIds = $(this).sortable("toArray", {
				attribute: "data-lesson-id",
			});

			let chapterId = ui.item.data("chapter-id");
			$.ajax({
				method: "POST",
				url: base_url + `/instructor/course-content/${chapterId}/sort-lesson`,
				data: {
					_token: csrf_token,
					order_ids: orderIds,
				},
				success: function (data) {
					notyf.success(data.message);
				},
				error: function (xhr, error, status) {
					notyf.error(error.error);
				},
			});
		},
	});
}
