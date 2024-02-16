<div class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Messaggi dell'appartamento: <span id="apartment-name"></span></h5>
                <p>Address: <span id="apartment-address"></span></p>
                <button type="button" class="btn-close close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                      <tr id="header-table-row">
                        <th scope="col">Date</th>
                        <th scope="col">Sender</th>
                        <th scope="col">Message</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Email</th>
                      </tr>
                    </thead>
                    <tbody id="messages-container">
                      {{-- <tr id="message-row">
                        <th scope="row" id="message-date"></th>
                        <td id="sender"></td>
                        <td id="message"></td>
                        <td id="subject"></td>
                        <td id="email"></td>
                      </tr>
                    </tbody> --}}
                  </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<style>
    .modal-body {
        overflow-x: auto;
    }
    .message-cell {
        max-width: 100px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        cursor: pointer;
    }
    .message-cell:hover {
        text-decoration: aquamarine; 
    }
</style>

@push('scripts')
    <script src="{{ asset('js/messagesModal.js') }}"></script>
@endpush