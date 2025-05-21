/** Variables */
const base_url = $(`meta[name="base_url"]`).attr("content");
const csrf_token = $(`meta[name="csrf_token"]`).attr("content");

var notyf = new Notyf({
	duration: 5000,
	dismissible: true,
});

// HTML Elements

/** Reusaable functions */

// What type of player to use
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

// Set the selected lesson as the active one.
function updateWatchHistory(courseId, chapterId, lessonId) {
	$.ajax({
		method: "POST",
		url: `${base_url}/student/update-watch-history`,
		data: {
			_token: csrf_token,
			chapter_id: chapterId,
			course_id: courseId,
			lesson_id: lessonId,
		},

		beforeSend: function () {},
		success: function (data) {},
		error: function (xhr, status, error) {},
	});
}

/**On DOM Load */

// Reinitialize the video player and mount the selected lesson video
$(".lesson").on("click", function (e) {
	e.preventDefault();

	$(".lesson").removeClass("active");
	$(this).addClass("active");

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
		beforeSend: function () {},
		success: function (data) {
			$("#video-holder").html(playerHtml(data.storage, data.file_path));

			// Load lesson description
			$(".lesson_description").text(data.description);

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

			// Update watch history
			updateWatchHistory(courseId, chapterId, lessonId);
		},
		error: function (xhr, status, error) {},
	});
});

// Mark lesson as completed
$(".make_completed").on("click", function (e) {
	e.preventDefault();

	const courseId = $(this).data("course-id");
	const chapterId = $(this).data("chapter-id");
	const lessonId = $(this).data("lesson-id");

	$.ajax({
		method: "POST",
		url: `${base_url}/student/update-lesson-completion`,
		data: {
			_token: csrf_token,
			chapter_id: chapterId,
			course_id: courseId,
			lesson_id: lessonId,
		},
		beforeSend: function () {},
		success: function (data) {
			notyf.success(data.message);
		},
		error: function (xhr, status, error) {},
	});
});
