<div class="modal" id="email-customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send Email</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                
                                <label class="form-label">Email To</label>
                                <input type="text" disabled class="form-control" id="emailto">
                                <label class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject">
                                <label class="form-label">Message</label>
                                <textarea class="form-control" id="message" rows="3"></textarea>
                                <input class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Send()" id="update-btn" class="btn btn-sm  btn-success" >Send</button>
            </div>
        </div>
    </div>
</div>

<script>
        async function FillUpEmailForm(id) {
        document.getElementById("updateID").value=id;
        showLoader();
        let res = await axios.post('/customer-by-id', {id:id});
        hideLoader();
        document.getElementById("emailto").value=res.data['email'];
    }


</script>
