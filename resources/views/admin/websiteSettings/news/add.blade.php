<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">News</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('news.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Date</label>
                            <input name="news_date" id="news_date" type="date" value="{{date('Y-m-d')}}" class="form-control">
                        </div>
                        <div class="col-6">
                            <label class="form-label">News banner image</label>
                            <input type="file" name="news_image" class="form-control" required>
                            @if ($errors->has('news_image'))
                                <span class="text-danger">{{ $errors->first('news_image') }}</span>
                            @endif
                        </div>
                        <div class="col-6">
                            <label class="form-label">News Title</label>
                            <input type="text" id="title" name="news_title" value="{{old('news_title')}}" class="form-control" required>
                            @if ($errors->has('news_title'))
                                <span class="text-danger">{{ $errors->first('news_title') }}</span>
                            @endif
                        </div>
                        <div class="col-6">
                            <label class="form-label">slug</label>
                            <input type="text" id="slug" name="news_slug" value="{{old('news_slug')}}" class="form-control" required>
                            @if ($errors->has('news_slug'))
                                <span class="text-danger">{{ $errors->first('news_slug') }}</span>
                            @endif
                        </div>
                        <div class="col-12">
                            <label class="form-label">News descriptions</label>
                            <textarea id="editor" name="news_desc" class="form-control" required cols="30" rows="10">
                                {{old('news_desc')}}
                            </textarea>
                            @if ($errors->has('news_desc'))
                                <span class="text-danger">{{ $errors->first('news_desc') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
        $(document).ready(function(e) {
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });


            $('#title').on('input', function() {
                var title = $(this).val();
                var slug = title
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9 -]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                $('#slug ').val(slug);
            });

        });
</script>