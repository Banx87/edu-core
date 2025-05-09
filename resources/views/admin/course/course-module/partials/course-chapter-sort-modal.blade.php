<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Sort Chapters</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form method="POST">
            @csrf
            <ul class="item_list chapter_sortable_list">
                @forelse ($chapters as $chapter)
                    <li class="mt-2" data-course-id="{{ $chapter->course_id }}" data-chapter-id="{{ $chapter->id }}">
                        <span>{{ $chapter->title }}</span>
                        <div class="add_course_content_action_btn">
                            <a class="arrow dragger chapter_sorter" href="javascript:;"><i class="fas fa-arrows-alt"
                                    aria-hidden="true"></i></a>
                        </div>
                    </li>
                @empty
                    <li>
                        <span class="text-center">No chapters to found
                        </span>
                    </li>
                @endforelse
            </ul>
        </form>
    </div>
</div>

<script>
    var base_url = $(`meta[name="base_url"]`).attr("content");
    var csrf_token = $(`meta[name="csrf_token"]`).attr("content");
    $('.btn-close').on('click', function() {
        window.location.reload();
    })

    // Sort Chapter List
    if ($(".chapter_sortable_list li").length) {
        $(".chapter_sortable_list").sortable({
            items: "li",
            containment: "parent",
            cursor: "move",
            handle: ".dragger",
            forcePlaceholderSize: true,
            tolerance: 'pointer',
            update: function(event, ui) {
                let orderIds = $(this).sortable("toArray", {
                    attribute: "data-chapter-id",
                });

                let courseId = ui.item.data("course-id");

                $.ajax({
                    method: "POST",
                    url: base_url + `/instructor/course-content/${courseId}/sort-chapter`,
                    data: {
                        _token: csrf_token,
                        order_ids: orderIds,
                    },
                    success: function(data) {
                        notyf.success(data.message);
                    },
                    error: function(xhr, error, status) {
                        notyf.error(error.error);
                    },
                });
            },
        });
    }
</script>
