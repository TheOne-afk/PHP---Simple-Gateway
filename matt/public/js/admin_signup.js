/* Input Fields */
const passwordField = document.querySelector("#admin-password")
const usernameField = document.querySelector("#admin-username")
const emailField = document.querySelector("#admin-email")
const confirmPasswordField = document.querySelector("#admin-confirm-password")
const adminCode = document.querySelector("#admin-code")

/* Field Containers */
const passwordContainer = document.querySelector("#admin-password-container")
const usernameContainer = document.querySelector("#admin-username-container")
const emailContainer = document.querySelector("#admin-email-container")
const confirmPasswordContainer = document.querySelector("#admin-confirm-password-container")
const adminCodeContainer = document.querySelector("#admin-code-container")

/* Validation Variables */
const minLength = 8;
const lowercase = /[a-z]/
const uppercase = /[A-Z]/
const digitRegex = /\d/
const symbolRegex = /\W/
const usernameValid = /^[a-zA-Z]+\.[a-zA-Z]+$/
const emailRegex = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*\.\w{2,}$/;

/* Sign in redirect method */
function handleSignInRedirect (){
    location.href = "signin.php"
}

/* field color user interface */
function onInputChange(){
    /* Ids of validation messages */
    const passExist = document.querySelector('#passValid')
    const userExist = document.querySelector('#userValid')
    const userTaken = document.querySelector("#userTaken")
    const emailExist = document.querySelector("#emailValid")
    const confirmPassExist = document.querySelector("#confirmPassValid")
    const requiredExist = document.querySelector("#requriedValid")
    
    /* implementing the if statement if the span is exist the perform this if is not dont perform anything */
    /* empty fields display and color interface */
    if(requiredExist){
        if(requiredExist.innerText){
            if(!usernameField.value || !emailField.value || !passwordField.value || !confirmPasswordField.value){
                requiredExist.style.color = "indianred"

            }
            else{
                requiredExist.remove();
            }
        }
    }

    /* password validations color interface */
    if(passExist){
        const validationChange = document.querySelectorAll('#passValid') 
    validationChange.forEach((item)=>{
        switch(item.innerText){

            case "Password must be at least 8 characters long.":
                if(passwordField.value.length < minLength){
                    item.style.color = "indianred"
                }
                else{
                    item.style.color = "green"
                }
            break;
            case "Password must contain at least one lowercase letter.":
                if(!lowercase.test(passwordField.value)){
                    item.style.color = "indianred"
                }
                else{
                    item.style.color = "green"
                }
            break;
            case "Password must contain at least one uppercase letter.":
                if(!uppercase.test(passwordField.value)){
                    item.style.color = "indianred"
                }
                else{
                    item.style.color = "green"
                }
            break;
            case "Password must contain at least one digit.":
                if(!digitRegex.test(passwordField.value)){
                    item.style.color = "indianred"
                }
                else{
                    item.style.color = "green"
                }
            break;
            case "Password must contain at least one special symbol.":
                if(!symbolRegex.test(passwordField.value)){
                    item.style.color = "indianred"
                }
                else{
                    item.style.color = "green"
                }
            break;
        }
    })
    }

    /* user color interface */
    if(userExist){

        if(userExist.innerText){
            if(!usernameValid.test(usernameField.value)){
                userExist.style.color = "indianred"
            }
            else{
                userExist.style.color = "green"
            }
        }
    }
    if(userTaken){
        if(userTaken.innerText){
            if(usernameField.value){
                userTaken.remove();
            }
        }
    }
    /* email color interface */
    if(emailExist){
        if(emailExist){
            if(!emailRegex.test(emailField.value)){
                emailExist.style.color = "indianred"
            }
            else{
                emailExist.style.color = "green"
            }
        }
    }
    /* confirm color interface */
    if(confirmPassExist){
        if(confirmPassExist.innerText){
            if(confirmPasswordField.value){
                confirmPassExist.remove();
            }
        }
    }
}