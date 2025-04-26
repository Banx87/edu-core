import $ from "jquery";

$(".toggle-password").on("click", function () {
	const passwordField = $("." + this.id);
	const currentType = passwordField.attr("type");
	passwordField.attr("type", currentType === "password" ? "text" : "password");
});
