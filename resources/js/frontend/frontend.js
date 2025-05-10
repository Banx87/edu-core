const csrf_token = $(`meta[name="csrf_token"]`).attr("content");
const base_url = $(`meta[name="base_url"]`).attr("content");
const reloadUrl = base_url + "/instructor/courses/update";

var notyf = new Notyf({
	duration: 5000,
	dismissible: true,
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
});
