<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Notice</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('campusgalary.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Image <small class="text-success">(You can add multiple images)</small></label>
                            <input name="image[]" id="image" multiple type="file" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Program Title</label>
                            <input type="text" id="title" rows="4" name="program_name" class="form-control" value="{{old('program_name')}}">
                            @if ($errors->has('program_name'))
                                <span class="text-danger">{{ $errors->first('program_name') }}</span>
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