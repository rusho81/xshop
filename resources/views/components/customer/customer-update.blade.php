<div class="modal" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Name</label>
                                <input type="text" class="form-control" id="customerNameUpdate">
                                <label class="form-label">Customer Email</label>
                                <input type="text" class="form-control" id="customerEmailUpdate">
                                <label class="form-label">Customer Phone</label>
                                <input type="text" class="form-control" id="customerPhoneUpdate">
                                <label class="form-label">Customer Address</label>
                                <input type="text" class="form-control" id="customerAddressUpdate">
                                <label class="form-label">Customer Preference</label>
                                <input type="text" class="form-control" id="customerPreferneceUpdate">
                                <input class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn btn-sm  btn-success" >Update</button>
            </div>
        </div>
    </div>
</div>

<script>

    async function FillUpUpdatedForm(id) {
        document.getElementById("updateID").value=id;
        showLoader();
        let res = await axios.post('/customer-by-id', {id:id});
        hideLoader();
        document.getElementById("customerNameUpdate").value=res.data['name'];
        document.getElementById("customerEmailUpdate").value=res.data['email'];
        document.getElementById("customerPhoneUpdate").value=res.data['phone'];
        document.getElementById("customerAddressUpdate").value=res.data['address'];
        document.getElementById("customerPreferneceUpdate").value=res.data['preference'];
    }
    async function Update() {
        var customerName = document.getElementById("customerNameUpdate").value;
        var customerEmail = document.getElementById("customerEmailUpdate").value;
        var customerPhone = document.getElementById("customerPhoneUpdate").value;
        var customerAddress = document.getElementById("customerAddressUpdate").value;
        var customerPreference = document.getElementById("customerPreferneceUpdate").value;
        var updateId = document.getElementById("updateID").value;

        if(customerName.length === 0){
            errorToast("Name Required!");
        }else if(customerEmail.length === 0){
            errorToast("Email Required!");
        }else if(customerPhone.length === 0){
            errorToast("Phone Required!");
        }else if(customerPreference.length === 0){
            errorToast("Preference Required!");
        }else if(customerAddress.length === 0){
            errorToast("Address Required!");
        }else {
            document.getElementById('update-modal-close').click();
            showLoader();
            let res = await axios.post('/update-customer', {
                name:customerName,
                email:customerEmail,
                phone:customerPhone,
                address:customerAddress,
                preference:customerPreference,
                id:updateId});
            hideLoader();

            if(res.status===200 && res.data===1){
                successToast("Update Successfull");
                await getList();
            }else{
                errorToast("Update Failed");
            }
        }
    }
</script>