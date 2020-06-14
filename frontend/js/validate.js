const forms = document.querySelectorAll(".validate");
for (let i = 0; i < forms.length; i++) {
    forms[i].setAttribute('novalidate', true);
}

allInputs = Array.from(document.querySelectorAll("input:not([type='submit']):not([type='radio']):not([type='checkbox'])"));


const domStrings = {
    error: "error",
    errorFor: "error-for-",
    errorMessageFor: ".error-message#error-for-",
    errorMessage: ".error-message",
    password: "password",
    confirmPassword: "confirm_password",
    errorDOB: "#dob-red",
    activeError: "err-active",
    goldText: "text-gold",
    formGroupInput: ".form-group p input",
    passCase: "#passCase",
    atLeast8: "#atleast8",
    soForm: "#so-form",
    dateYears: ".date-picker .bear-years",
    requiredInputs: "#so-form input:required",
    lastName: "last_name",
}


const hideError = function (field) {
    //check error-message class and delete it.
    if (field.parentElement.parentElement.classList.contains(domStrings.error) > -1) {
        field.parentElement.parentElement.classList.remove(domStrings.error);
    };

    let message = field.form.querySelector(domStrings.errorMessageFor + field.id);
    if (message) {
        message.remove();
    }

    if (field == document.querySelector(`${domStrings.dateYears}`)) {
        document.querySelector(domStrings.errorDOB).classList.remove(domStrings.activeError, domStrings.goldText);
    }

    if (field.type == domStrings.password) {
        if (document.querySelector(domStrings.errorMessageFor + domStrings.password)) {
            document.querySelector(domStrings.errorMessageFor + domStrings.password).remove();
        } else if (document.querySelector(domStrings.errorMessageFor + domStrings.confirmPassword)) {
            document.querySelector(domStrings.errorMessageFor + domStrings.confirmPassword).remove();
        }

        document.querySelectorAll(domStrings.formGroupInput).forEach((input) => {
            if (input.parentElement.parentElement.classList.contains(domStrings.error)) {
                input.parentElement.parentElement.classList.remove(domStrings.error);
            }
        })

        document.querySelector(domStrings.passCase).classList.remove(domStrings.activeError, domStrings.goldText);
        document.querySelector(domStrings.atLeast8).classList.remove(domStrings.activeError, domStrings.goldText);

    }

    if (field == document.querySelector(domStrings.dateYears)) {
        document.querySelector(domStrings.errorDOB).classList.remove(domStrings.activeError, domStrings.goldText);
    }

}

document.querySelector(domStrings.dateYears).addEventListener("click", function (evt) {
    if (new Date().getFullYear() - evt.target.value > 15) {
        hideError(evt.target);
    } else {
        showError(evt.target);
    }
})

allInputs.forEach((input) => {
    input.addEventListener("blur", function (evt) {
        let selects = document.querySelector(domStrings.dateYears);
        const checkErrors = hasError(evt.target);
    
        if (checkErrors && evt.target != selects) {
            showError(evt.target, checkErrors);
        }
    
        if (!checkErrors) {
            hideError(evt.target);
        }
    
    }, true);
})

console.log(allInputs);

// addEventListener("blur", function (evt) {
//     let selects = document.querySelector(domStrings.dateYears);
//     const checkErrors = hasError(evt.target);

//     if (checkErrors && evt.target != selects) {
//         showError(evt.target, checkErrors);
//     }

//     if (!checkErrors) {
//         hideError(evt.target);
//     }

// }, true);

const hasError = function (field) {
    //get validity
    var validity = field.validity;
    console.log(validity);

    if (field.id == domStrings.lastName && !field.value.trim().length && !field.value.trim()) {
        return;
    }

    //if valid, leave the function.
    if (validity.valueMissing) return "Please fill out the required field."

    //check if passwords match
    let second = document.querySelector(`#${domStrings.confirmPassword}`);
    let first = document.querySelector(`#${domStrings.password}`);

    if (validity.tooShort) {
        if (field.type == domStrings.password)
            document.querySelector(domStrings.atLeast8).classList.add(domStrings.activeError, domStrings.goldText);
        else {
            return `This field needs a mininum length of ${field.getAttribute("minlength")} characters.`;
        }
    } else {
        document.querySelector(domStrings.atLeast8).classList.remove(domStrings.activeError, domStrings.goldText);
    }
    if (validity.tooLong) return `This field cannot exceed the maximum length of ${field.getAttribute("maxlength")}.`;
    if (validity.badInput) return "This field must only contain numbers."
    if (validity.rangeUnderflow) return `This field must have at least ${field.getAttribute('min')} characters.`
    if (validity.rangeOverflow) return `This field must at most ${field.getAttribute('max')} characters.`
    if (validity.patternMismatch) {
        return field.getAttribute('title');
    }

    if (validity.typeMismatch) {
        return field.getAttribute('title');
    }

    if (!checkForProfanity(field) && field.type != domStrings.password) {
        return "Field contains words/phrases that have been identified as profanity."
    }

    if (field == document.querySelector(domStrings.dateYears)) {
        if (new Date().getFullYear() - field.value < 16) {
            document.querySelector(domStrings.errorDOB).classList.add(domStrings.activeError, domStrings.goldText);
            return "You must be at least 16 years old to create an account."
        }
    }

    //check if password contains a LC, UC and a number.
    if (field.type == domStrings.password) {
        let passwordCheck = [false, false, false];
        for (let i = 0; i < field.value.length; i++) {
            if (passwordCheck[0] + passwordCheck[1] + passwordCheck[2] == 3) {
                return;
            }

            let ascii = field.value.charCodeAt(i);
            if (ascii >= 65 && ascii <= 90) {
                passwordCheck[0] = true;
            } else if (ascii >= 97 && ascii <= 122) {
                passwordCheck[1] = true;
            } else if (ascii >= 48 && ascii <= 57) {
                passwordCheck[2] = true;
            }
        }
        if (passwordCheck[0] + passwordCheck[1] + passwordCheck[2] != 3) {
            document.querySelector(domStrings.passCase).classList.add(domStrings.activeError, domStrings.goldText);
            return "Your password must contain one upper case letter, lower case letter and a number";
        }
    }

    if (field.type == domStrings.password) {
        if (field == second) {
            if (second.value != first.value) {
                return "Passwords do not match.";
            } else {
                return;
            }
        } else {
            if (field == first) {
                if (second.value.trim().length && second.value) {
                    if (first.value != second.value) {
                        return "Passwords do not match";
                    } else {
                        return;
                    }
                }
            }
        }
    }

    if (validity.valid) return;
}

const showError = function (field, errorMSG) {
    if (field != document.querySelector(domStrings.dateYears)) {
        if (field.parentElement.parentElement.classList.contains(domStrings.error) > -1) {
            field.parentElement.parentElement.classList.add(domStrings.error);
        };

        let message = field.form.querySelector(domStrings.errorMessageFor + field.id);
        //check if we have a message present already
        if (!message) {
            //create a message, since it doesn't exist.
            message = document.createElement("p");
            message.className = domStrings.errorMessage.replace(".", "");
            message.id = domStrings.errorFor + field.id;
            message.textContent = errorMSG;
            field.parentElement.nextElementSibling.appendChild(message);
        } else {
            //update msg
            message.textContent = errorMSG;
        }
    } else {
        document.querySelector(domStrings.errorDOB).classList.add(domStrings.activeError, domStrings.goldText);
    }
}

const checkForProfanity = function (field) {
    let badWords = `nigger|nigga|niggah|fuck|pussy|kill|white power|black power|wank|wetback|vagina|penis|twink|twat|tranny|towelhead|taste my|suck my|suck it|taste it|tight white|swastika|suck|sucks|legs|semen|cum|raging boner|raghead|porn|pubes|pole smoker|shit|cunt|paki|pedo|paedophile|anal|anus|ball licking|ball sucking|ball sack|barely|legal|blowjob|blow job|boner|kkk|load|rape|darkie|blackie|dildo|penetration|doggie|fag|faggot|fellatio|cunnilingus|finger|bang|fuck|tard|ejaculation|busting|incest|hump|jail|bait|jiga|jigga|jizz|lolita|masturbate|missionary`
    badWords = badWords.split("|");
    let user = field.value.toLowerCase().trim();
    user = user.replace(/[ '-]/g, " ");
    if (user.indexOf(" ") > -1) {
        user = user.split(" ");
        if (badWords.indexOf(user[0]) > -1 || badWords.indexOf(user[1]) > -1) {
            return false;
        } else {
            return true;
        }
    } else {
        return (
            badWords.every((word) => {
                return user.indexOf(word) < 0;
            }))
    }
}


function checkAllInputs() {
    let validateInputs = [Array.from(document.querySelectorAll(domStrings.requiredInputs)).reduce((acc, curr) => { return acc.concat(curr) }, []),
    document.querySelector(domStrings.dateYears)].reduce((acc, curr) => { return acc.concat(curr) }, [])

    let allTestsPassed = true;
    for (let i = 0; i < validateInputs.length; i++) {
        let test = hasError(validateInputs[i]);
        if (test) {
            showError(validateInputs[i], test)
            allTestsPassed = false;
        }
    }
    return allTestsPassed;
}

