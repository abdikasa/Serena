let allInputs = Array.from(document.querySelectorAll("input:not([type='submit']):not([type='radio']):not([type='checkbox'])"));
console.log(allInputs);
document.querySelector("html").style.zoom = "0.987";
document.querySelector("html").style.zoom = "1";
// document.querySelector("html").style.zoom = "0.94";


allInputs.forEach((input) => {
    input.addEventListener("blur", onblurr);
    input.addEventListener("focus", focus);
    input.addEventListener('keydown', onblurrHelper);
    input.addEventListener('input', onfocusHelper);
})



function onblurrHelper(event) {
    const key = event.key; // const {key} = event; ES6+
    if (event.target.value.trim().length < 1) {
        if (key === "Backspace" || key === "Delete") {
            onblurr(event);
        }
    }
}

function onfocusHelper(event) {
    if (event.target.value.trim().length > 0) {
        focus(event);
    }
}


function focus(evt) {
    let mp = evt.target.parentElement.nextElementSibling;
    evt.target.placeholder = "";
    evt.target.style.zIndex = "0";
    //evt.target.parentElement.parentElement.style.borderBottom="1px solid #0275d8";
    mp.classList.add("tester-2");
    mp.firstElementChild.classList.add("tester", "text-gold");
}

function onblurr(evt) {

    if (evt.target.value.trim().length > 0) {
        return;
    }

    let mp = evt.target.parentElement.nextElementSibling;
    mp.classList.remove("tester-2");
    mp.firstElementChild.classList.remove("tester", "text-gold");
    //evt.target.parentElement.parentElement.style.borderBottom="1px solid #000";

    let placeholder = (evt.target.id.replace(/_/g, " ")) || evt.target.id;
    placeholder = placeholder.charAt(0).toUpperCase() + placeholder.substring(1);

    evt.target.placeholder = `${placeholder}`;
}

//get all the icons
const showHide = Array.from(document.querySelectorAll(".form-group .show_icon"));
showHide.forEach((icon) => {
    icon.addEventListener("click", function (e) {
        if(e.target.classList.contains("fa-eye-slash")){
            e.target.classList.remove("fa-eye-slash");
            e.target.classList.add("fa-eye");
            e.target.nextElementSibling.firstElementChild.type="text";
        }else{
            e.target.classList.remove("fa-eye");
            e.target.classList.add("fa-eye-slash");
            e.target.nextElementSibling.firstElementChild.type="password";
        }
    })
})
//