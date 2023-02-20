<style>

        .note-textarea {
            border: 0px;
            min-height: 150px;
            border-radius: 2px;
            width: 100%;
            /* background-color: #f0f4f9 */
        }
</style>
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="card border-10 pt-2 card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="card">
                        <div class="card-header border-bottom-0">
                            <div class="card-options">
                                <a href="#" id="save_note_btn" onclick="saveNote()"
                                    class="btn btn-primary font-weight-bold"
                                    style="margin-right: 7px">Save Note</a>
                                <a href="{{ route('user.send_note', $note->id) }}" onclick="shiNew(event)"
                                    data-type="dark" data-size="s" data-title="Send Note"
                                    class="btn btn-primary font-weight-bold">Send
                                    Note</a>
                            </div>
                        </div>
                        <div class="card-body p-0 card-margin">
                            <form class="validate-form settings" id="save_note_form" method="POST" action="{{ route('user.note', $note->id) }}">
                                @csrf
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Note Title</label>
                                        <input type="text" class="note-input" id="note-title"
                                            value="{{ $note->title ?? null }}" name="title"
                                            placeholder="Note Title...." required
                                            data-parsley-required-message="Note title is required">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Note Content</label>
                                        <textarea class="note-textarea" required id="note-content" name="content" placeholder="Write note...."
                                            data-parsley-required-message="Note content is required">{{ $note->content ?? null }}</textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    function viewNote(id, type) {
        var url = "{{ route('user.set.current.note') }}";
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                note_id: id,
                type: type,
            },
            success: function(response) {
                console.log(response);
            },
            error: function(err) {
                console.log(err);
            }
        });
        $("#note_div_section").load(window.location.href + " #note_div_section");
    }

    function saveNote() {
        console.log("bad");
        if (!($('#save_note_form').parsley().validate())) {
            return false;
        }
        console.log("good");

        var form = $('#save_note_form');
        var actionUrl = form.attr('action');
        $.ajax({
            type: 'POST',
            url: actionUrl,
            data: form.serialize(),
            success: function(response) {
                console.log(response);
                $("#note_div_section").load(window.location.href + " #note_div_section");
                return toastr.success("{{ session('success') }}", "Note Saved Successfully");
            },
            error: function(err) {
                console.log(err);
                return toastr.error("{{ session('error') }}", "Note not saved");
            }
        });
    }

    $(function() {

    });
</script>
