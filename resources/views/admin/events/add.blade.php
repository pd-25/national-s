<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Events</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('events.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Date</label>
                            <input name="event_desc" id="event_desc" type="date" value="{{date('Y-m-d')}}" class="form-control">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Event banner image</label>
                            <input type="file" name="event_image" class="form-control" required>
                            @if ($errors->has('event_image'))
                                <span class="text-danger">{{ $errors->first('event_image') }}</span>
                            @endif
                        </div>
                        <div class="col-6">
                            <label class="form-label">Event Name</label>
                            <input type="text" id="title" name="event_name" value="{{old('event_name')}}" class="form-control" required>
                            @if ($errors->has('event_name'))
                                <span class="text-danger">{{ $errors->first('event_name') }}</span>
                            @endif
                        </div>
                        <div class="col-6">
                            <label class="form-label">slug</label>
                            <input type="text" id="slug" name="event_slug" value="{{old('event_slug')}}" class="form-control" required>
                            @if ($errors->has('event_slug'))
                                <span class="text-danger">{{ $errors->first('event_slug') }}</span>
                            @endif
                        </div>
                        <div class="col-12">
                            <label class="form-label">Event descriptions</label>
                            <textarea  name="event_desc" class="form-control" required cols="30" rows="10">
                                {{old('event_desc')}}
                            </textarea>
                            @if ($errors->has('event_desc'))
                                <span class="text-danger">{{ $errors->first('event_desc') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
        $(document).ready(function(e) {

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