/* Input Fields */
const passwordField = document.querySelector("#password")
const usernameField = document.querySelector("#username")
const emailField = document.querySelector("#email")
const confirmPasswordField = document.querySelector("#confirm-password")

/* Field Containers */
const passwordContainer = document.querySelector("#password-container")
const usernameContainer = document.querySelector("#username-container")
const emailContainer = document.querySelector("#email-container")
const confirmPasswordContainer = document.querySelector("#confirm-password-container")

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

document.querySelector('form').addEventListener('submit',(e)=>{
      const message = document.querySelector(".message")
      
})

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