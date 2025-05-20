// Variables
const base_url = $(`meta[name="base_url"]`).attr("content");
const csrf_token = $(`meta[name="csrf_token"]`).attr("content");

// HTML Elements

// Reusaable functions
function playerHtml(source_type, source) {
	let player = "";

	switch (source_type) {
		case "youtube":
			player = `<video id="vid1" class="video-js vjs-default-skin" controls autoplay width="640" height="264"
                        data-setup='{"techOrder": ["youtube"], "sources": [{"type": "video/${source_type}", "src": "${source}"}]}'>
                        </video>`;
			break;
		case "vimeo":
			player = `<video id="vid1" class="video-js" width="640" height="264"
                      data-setup='{ "techOrder": ["vimeo"], "sources": [{ "type": "video/vimeo", "src": "${source}"}], "vimeo": { "color": "#fbc51b"} }'>
                     </video>`;
			break;
		case "upload" | "external_link":
			player = `<iframe src="${source}" width="640" height="264" frameborder="0" allowfullscreen webkitallowfullscreen mozallowfullscreen></iframe>`;

			break;
		default:
			break;
	}
	return player;
}

// On DOM Load

$(".lesson").on("click", function (e) {
	e.preventDefault();
	const courseId = $(this).data("course-id");
	const chapterId = $(this).data("chapter-id");
	const lessonId = $(this).data("lesson-id");

	$.ajax({
		method: "GET",
		url: `${base_url}/student/get-lesson-content`,
		data: {
			chapter_id: chapterId,
			course_id: courseId,
			lesson_id: lessonId,
		},

		beforeSend: function () {
			// Show loading spinner
			// $("#lesson-content").html(
			// 	`<div class="text-center"><i class="fa fa-spinner fa-spin"></i></div>`
			// );
		},
		success: function (data) {
			// Hide loading spinner
			// $("#lesson-content").html(response);
			// console.log(data);
			$("#video-holder").html(playerHtml(data.storage, data.file_path));

			// Resetting existing Player
			if (videojs.getPlayers()["vid1"]) {
				videojs.getPlayers()["vid1"].dispose();
			}

			// Initialize video.js player
			if ($("#vid1").length > 0) {
				videojs("vid1").ready(function () {
					this.play();
				});
			}
		},
		error: function (xhr, status, error) {
			// Hide loading spinner
			// $("#lesson-content").html(
			// 	`<div class="text-center"><i class="fa fa-exclamation-triangle"></i> ${xhr.responseText}</div>`
			// );
		},
	});
});
