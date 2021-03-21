<form id="form-add-premise" action="{{ route('premise.store') }}" method="POST">
    <div class="modal fade" id="modal-add-premise" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tambah Premis</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label class="control-label col-md-2" for="name">Nama </label>
                    <div class="col-md-10">
                        <input type=text class="form-control" id="name" name="name" required autofocus>
                        @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              @csrf
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
              <button type="submit" class="btn btn-primary" id="btn-submit-premise">Simpan</button>
            </div>
          </div>
        </div>
    </div>
</form>