<div class="modal-content">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ @$editMode ? 'Update Chapter' : 'Create Chapter' }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form
            action="{{ @$editMode
                ? route('admin.course-content.update-chapter', @$chapter->id)
                : route('admin.course-content.store-chapter', @$id) }}"
            method="POST">
            @csrf
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" class="form-control" value="{{ @$chapter?->title }}" required />
            </div>
            <div class="modal-footer justify-content-end">
                <button type="submit" class="btn btn-primary">{{ @$editMode ? 'Update' : 'Create' }}</button>
            </div>
        </form>
    </div>
</div>
