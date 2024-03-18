document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form');
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const password2 = document.getElementById('password2');
    const profilePicture = document.getElementById('profilePicture');

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        checkInputs();
    });

    function checkInputs(){
        const username_value = username.value.trim()
        const email_value = email.value.trim()
        const password_value = password.value.trim()
        const password2_value = password2.value.trim()
        const profilePictureValue = profilePicture.value.trim();
   
        if(username_value === ''){
           setErrorFor(username , 'Username cannot be blank');
        } else{
           setSuccessFor(username)
        }
        if(email_value === '') {
            setErrorFor(email, 'Email cannot be blank');
        } else if (!isEmail(email_value)) {
            setErrorFor(email, 'Not a valid email');
        } else {
            setSuccessFor(email);
        }
        
        if(password_value === '') {
            setErrorFor(password, 'Password cannot be blank');
        } else {
            setSuccessFor(password);
        }
        
        if(password2_value === '') {
            setErrorFor(password2, 'Password cannot be blank');
        } else if(password_value !== password2_value) {
            setErrorFor(password2, 'Passwords do not match');
        } else{
            setSuccessFor(password2);
        }

        if (profilePictureValue === '') {
            setErrorFor(profilePicture, 'Please select a profile picture');
        } else {
            setSuccessFor(profilePicture);
        }
   }
   
   
   function setErrorFor(input , message){
       const formControl = input.parentElement;
       const small = formControl.querySelector('small');
       small.innerText = message;
   
       formControl.className = 'form-control error';
   }
   
   function setSuccessFor(input){
       const formControl = input.parentElement;
   
       formControl.className = 'form-control success';
   }

   function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

});