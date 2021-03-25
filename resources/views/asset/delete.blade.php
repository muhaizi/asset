<form id="form-delete" action="{{ route('asset.destroy', 0) }}" method="post">
    @method('DELETE')
    @csrf
    <div class="modal fade" id="modal-delete" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Aset</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure to delete this asset?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
              <button type="submit" class="btn btn-danger"><i class='fas fa-trash'></i> Hapus</button>
            </div>
          </div>
        </div>
    </div>
</form>