<div class="card border-10 pt-2 card-primary">
    <div class="card-body">
        <form class="validate-form" method="POST" action="{{ route('admin.add_faq') }}">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label class="form-label">Question</label>
                        <input type="text" class="form-control" placeholder="Question"
                            value="{{ old('question') }}" name="question" required=""
                            data-parsley-required-message="Question is required">
                        @error('question')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label class="form-label">Answer</label>
                        <textarea name="answer" class="form-control" rows="5" required="" placeholder="Answer"
                            data-parsley-required-message="Answer is required">{{ old('answer') }}</textarea>
                        @error('answer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-12 text-center mt-1">
                <button class="btn btn-primary p-2" type="submit" style="font-size: 15px">Add New</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(function () {
  $('.validate-form').parsley().on('field:validated', function() {
    var ok = $('.parsley-error').length === 0;
    $('.bs-callout-info').toggleClass('hidden', !ok);
    $('.bs-callout-warning').toggleClass('hidden', ok);
  })
});
</script>