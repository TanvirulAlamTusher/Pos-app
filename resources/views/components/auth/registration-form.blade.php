<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 center-screen">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>Sign Up</h4>
                    <hr/>
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input id="email" placeholder="User Email" class="form-control" type="email"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Last Name</label>
                                <input id="lastName" placeholder="Last Name" class="form-control" type="text"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Mobile Number</label>
                                <input id="mobile" placeholder="Mobile" class="form-control" type="number"/>
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password"/>
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onRegistration()" class="btn mt-3 w-100  btn-primary">Complete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
   async function onRegistration() { 
   
         let email = document.getElementById('email').value;
         let firstName = document.getElementById('firstName').value;
         let lastName = document.getElementById('lastName').value;
         let mobile = document.getElementById('mobile').value;
         let password = document.getElementById('password').value;

        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
       // let passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;

      
        if(email.length===0){
            errorToast('Email is Required');
        }
        else if(!emailRegex.test(email)){
             errorToast('Enter Valid Email');
        }
        else if(firstName.length===0){
            errorToast('First Name is Required');
        }
        else if(lastName.length===0){
             errorToast('Last Name is Required');
        }
        else if(mobile.length===0){
            errorToast('Mobile Number Required');
        }
        else if(password.length===0){
            errorToast('Password is Required');
        }
   
        // else if (!passwordRegex.test(password)) {
        //      errorToast('Password must be at least 8 characters long and contain both numbers and letters');
        //  }
         else{
          showLoader();
          let res = await axios.post("/user-register",{
           
            firstName: firstName,
            lastName:lastName,
            email: email,
            mobile:mobile,
            password:password
          })
        hideLoader();

          if(res.status===200 && res.data['status']==='success'){
            successToast(res.data['message']);
            setTimeout(function()  {
                window.location.href = "/userLogin";
            }, 2000);
          }
          else{
              errorToast(res.data['message']);
             }
         }
  }
</script>
