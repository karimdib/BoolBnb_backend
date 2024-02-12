<div class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete <span id="apartment-name"></span>?</h5>
          <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Address: <span id="apartment-address"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary close-modal" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" id="confirm-delete">Delete</button>
        </div>
      </div>
    </div>
  </div>
  
  @push('scripts')
    <script src="{{ asset('js/deleteModal.js') }}"></script>
  @endpush