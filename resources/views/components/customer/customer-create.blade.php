<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>
                </div>
                <div class="modal-body">
                    <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="customerName">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" id="customerEmail">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" id="customerPhone">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" id="customerAddress">
                                <label class="form-label">Preferance</label>
                                <input type="text" class="form-control" id="customerPreference">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button onclick="Save()" id="save-btn" class="btn btn-sm  btn-success" >Save</button>
                </div>
            </div>
    </div>
</div>

<script>
    async function Save() {
        let customerName = document.getElementById('customerName').value;
        let customerEmail = document.getElementById('customerEmail').value;
        let customerPhone = document.getElementById('customerPhone').value;
        let customerAddress = document.getElementById('customerAddress').value;
        let customerPreference = document.getElementById('customerPreference').value;

        if(customerName.length === 0){
            errorToast("Name Required!");
        }else if(customerEmail.length === 0){
            errorToast("Email Required!");
        }else if(customerPhone.length === 0){
            errorToast("Phpne Required!");
        }else if(customerAddress.length === 0){
            errorToast("Address Required!");
        }else if(customerPreference.length === 0){
            errorToast("Preference Required!");
        }
        else {
            document.getElementById('modal-close').click();
            showLoader();
            let res = await axios.post('/create-customer', {
                name:customerName,
                email:customerEmail,
                phone:customerPhone,
                address:customerAddress,
                preference:customerPreference
            });
            hideLoader();

            if(res.status===201) {
                successToast('Request completed!');
                document.getElementById('save-form').reset();
                await getList();
            }else {
                errorToast("Request fail");
            }
        }
    }
</script>
