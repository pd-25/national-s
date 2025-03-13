<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Notice</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('notice.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Date</label>
                            <input name="notice_date" id="notice_date" type="date" value="{{date('Y-m-d')}}" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Image</label>
                            <input name="image" id="image" type="file" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Notice Title</label>
                            <textarea type="text" id="title" rows="4" name="notice_name" class="form-control" required>{{old('notice_name')}} </textarea>
                            @if ($errors->has('notice_name'))
                                <span class="text-danger">{{ $errors->first('notice_name') }}</span>
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