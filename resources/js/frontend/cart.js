// const variables
const base_url = $(`meta[name="base_url"]`).attr("content");
const csrf_token = $(`meta[name="csrf_token"]`).attr("content");

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

// Reusable functions
function addToCart(courseId) {
	var btn_text = $(`.add_to_cart[data-course-id="${courseId}"]`).html();

	$.ajax({
		method: "POST",
		url: base_url + "/add-to-cart/" + courseId,
		data: { _token: csrf_token },
		beforeSend: function () {
			$(`.add_to_cart[data-course-id="${courseId}"]`).html(
				'<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Adding...'
			);
		},
		success: function (data) {
			console.log(data);
			$(".cart_count").html(data.cart_items_count);

			notyf.success(data.message);
		},
		error: function (xhr, status, error) {
			let errors = xhr.responseJSON;
			if (errors.type == "info") {
				notyf.open({ type: "info", message: errors.message });
			} else {
				$.each(errors, function (key, value) {
					notyf.error(errors.message);
				});
			}
		},
		complete: function () {
			$(`.add_to_cart[data-course-id="${courseId}"]`).html(btn_text);
		},
	});
}

// on Dom Load
$(function () {
	// add course into cart
	$(".add_to_cart").on("click", function (e) {
		e.preventDefault();

		let courseId = $(this).data("course-id");

		addToCart(courseId);
	});
});
