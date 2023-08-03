<div class="modal" id="email-customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Send Email</h5>
            </div>
            <div class="modal-body">
                <form id="email-form">
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
                <button id="mail-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
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

    async function Send() {
        var emailTo = document.getElementById("emailto").value;
        var subjectTo = document.getElementById("subject").value;
        var mailMessage = document.getElementById("message").value;

        if(emailTo.length === 0){
            errorToast("Mail Required!");
        }else if(subjectTo.length === 0){
            errorToast("Subject Required!");
        }else if(mailMessage.length === 0){
            errorToast("Message Required!");
        }else {
            document.getElementById('mail-modal-close').click();
            showLoader();
            let res = await axios.post('/send-mail', {
                email:emailTo,
                subject:subjectTo,
                message:mailMessage});
            hideLoader();

            if(res.status===200 && res.data['status']==='success'){
                successToast("Message Send");
                document.getElementById("email-form").reset(); 
            }else{
                errorToast("Message sending failed!");
            }
        }
    }

</script>
