<form id="form-updateall" action="{{ route('asset.pengesahan') }}" method="post">
  @csrf
   <div class="modal fade" id="modal-approveall" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Pengesahan Aset </h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure to approve this asset?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</button>
              <button type="submit" class="btn btn-primary"><i class='fas fa-check'></i> Approve</button>
            </div>
          </div>
        </div>
    </div>
  </form>