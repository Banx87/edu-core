// const variables
const base_url = $(`meta[name="base_url"]`).attr("content");
const csrf_token = $(`meta[name="csrf_token"]`).attr("content");

// Reusable functions
function addToCart(courseId) {
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

			$.each(errors, function (key, value) {
				notyf.error(errors.message);
			});
		},
		complete: function () {
			$(`.add_to_cart[data-course-id="${courseId}"]`).html(
				'Add to Cart <i class="far fa-arrow-right"></i>'
			);
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
