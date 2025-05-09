// Const variables
const csrf_token = $('meta[name="csrf-token"]').attr("content");
const base_url = $('meta[name="base_url"]').attr("content");

// Reusable functions
function updateApprovalStatus(id, status) {
	$.ajax({
		method: "PUT",
		url: base_url + `/admin/courses/${id}/update-approval`,
		data: { _token: csrf_token, status: status },
		success: function () {
			window.location.reload();
		},
		error: function (xhr, status, error) {},
	});
}

// on DOM load
$(function () {
	// Change approval status
	$(".update-approval-status").on("change", function () {
		let id = $(this).data("id");
		let status = $(this).val();

		updateApprovalStatus(id, status);
	});
});
