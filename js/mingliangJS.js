
// credit: https://alvarotrigo.com/blog/css-animations-scroll/ (doc citation later)
// CSS Animations on Scroll
// by Oscar Jite
function revealOnScroll() {
    var reveal_elements = document.querySelectorAll(".scroll-reveal");
    for (var i = 0; i < reveal_elements.length; i++) {
        // go thru every section
        var element = reveal_elements[i];
        // get the height of the viewport
        var windowHeight = window.innerHeight;
        // get distance from the top of the viewport
        var elementTop = element.getBoundingClientRect().top; // returns the size of an element and its position relative to the viewport
        var elementVisible = 150;
        if (elementTop < windowHeight - elementVisible) {
            element.classList.add("active");
        } else {
            element.classList.remove("active");
        }
    }
}

window.addEventListener("scroll", revealOnScroll);

// check scroll position on page load
revealOnScroll();


// Registration page
// Page function is used to switch pages and do validation when the page is switched
function page(part, validation) {
    // Validation process
    if (validation == true) {
        var number = part-1;
        var area = document.getElementById("part"+number);
        // console.log(area);
        var inputNodes = area.getElementsByTagName('input');
        for (var x=0; x < inputNodes.length; x++) {
            var inputNode = inputNodes[x];
            // console.log(inputNode); 
            if(!inputNode.checkValidity()){
                var divElementId = "part"+number+"-msg";
                var toast = document.getElementById(divElementId);
                toast.innerHTML = '<div class="toast" style="opacity:1;" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><img src="img/logo_small_no_text.png" class="rounded me-2" alt="logo" style="width:30px;"><strong class="me-auto">Information</strong><small>notification</small><button type="button" class="btn-close" onclick="closeToast(\''+divElementId+'\')"></button></div><div class="toast-body">Please make sure your input is valid</div></div>';
                toast.style.opacity="1";
                return;
            }
            else {
                continue;
            }
        }
        
        if (number == 1 || number == 3) {
            console.log("here is" +number)
            var selectNode = area.querySelector('.form-select');
            console.log(selectNode); 
            if(!selectNode.checkValidity()){
                var divElementId = "part"+number+"-msg";
                var toast = document.getElementById(divElementId);
                toast.innerHTML = '<div class="toast" style="opacity:1;" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><img src="img/logo_small_no_text.png" class="rounded me-2" alt="logo" style="width:30px;"><strong class="me-auto">Information</strong><small>notification</small><button type="button" class="btn-close" onclick="closeToast(\''+divElementId+'\')"></button></div><div class="toast-body">Please make sure your input is valid</div></div>';
                toast.style.opacity="1";
                return;
            }
            else {
                validation = false;
            }
        }
        else {
            validation = false;
        }
    }

    // Page switching
    if (validation == false) {
        if (part == 1) {
            document.getElementById("part1").style.display = "block";
            document.getElementById("part2").style.display = "none";
            document.getElementById("part3").style.display = "none";
            document.getElementById("part4").style.display = "none";
            document.getElementById("part5").style.display = "none";
        }
        else if (part == 2) {
            document.getElementById("part1").style.display = "none";
            document.getElementById("part2").style.display = "block";
            document.getElementById("part3").style.display = "none";
            document.getElementById("part4").style.display = "none";
            document.getElementById("part5").style.display = "none";
        }
        else if (part == 3) {
            document.getElementById("part1").style.display = "none";
            document.getElementById("part2").style.display = "none";
            document.getElementById("part3").style.display = "block";
            document.getElementById("part4").style.display = "none";
            document.getElementById("part5").style.display = "none";
            handleInputCreateElement("mod-floatingInput", "option", "module-selection");
        }
        else if (part == 4) {
            document.getElementById("part1").style.display = "none";
            document.getElementById("part2").style.display = "none";
            document.getElementById("part3").style.display = "none";
            document.getElementById("part4").style.display = "block";
            document.getElementById("part5").style.display = "none";
            handleInputCreateElement("cls-floatingInput","option","class-selection")
        }
    
        else if (part == 5) {
            document.getElementById("part1").style.display = "none";
            document.getElementById("part2").style.display = "none";
            document.getElementById("part3").style.display = "none";
            document.getElementById("part4").style.display = "none";
            document.getElementById("part5").style.display = "block";
            handleInputCreateElement("cls-floatingInput","option","class-selection-stu")
        }
    }
}

// this function is used for the registration, take input and make it become selection for another page
// eg. class name entered (form hvnt submit), but in student page need assign which class by select from the drop down box,
// so it takes the class name entered and append it into the drop down box
function handleInputCreateElement(getid, element, finalid) {
    var firstElement = document.getElementById(getid);
    var getValue = firstElement.value;
    
    var finalElement = document.getElementById(finalid);
    if (element == "option") {
        var numOfChild = finalElement.children.length;
        console.log(numOfChild)
    }

    // check if the value module is empty or the value of module == to selection value, then return
    if (getValue == "") {
        return;
    }

    if (numOfChild > 1) {
        var optionList = [];
        for (var num =1 ; num < numOfChild; num++) {
            var option = finalElement[num];
            optionList.push(option);
            // console.log("pushing",option)
        }
        console.log("finish pushing");
        console.log(optionList)

        for (var child = 0; child < optionList.length; child++) {
            console.log("checking")
            if (getValue == optionList[child].value) {
                // console.log("same!")
                return;
            }
            else {
                // console.log("notsame!")
                var removeThis = finalElement[child+1]
                finalElement.removeChild(removeThis);
            }
        }
    }
    var newElement = document.createElement(element);
    newElement.value = getValue;
    newElement.text = getValue;
    finalElement.appendChild(newElement);
}

function closeToast(divElementId) {
    var toastDiv = document.getElementById(divElementId);
    toastDiv.removeChild(toastDiv.firstElementChild);
}

// function formResponseHandler(formid, namechecking, successMsg, destinationAfterSuccess) {
//     const form = document.getElementById(formid);
//     form.noValidate = true;
//     form.addEventListener("submit",function(event){
//         event.preventDefault();
//         if (!this.checkValidity()) {
//             Swal.fire({
//                 title: "Oops...input invalid.",
//                 icon: "error",
//                 text: "There is invalid or empty input, please make sure every input is valid."
//             }) 
//             return;
//         }
//         if (namechecking == true) {
//             var checkCompanyName = document.getElementById("notavailable");
//             console.log(checkCompanyName)
//             if(checkCompanyName != null){
//                 Swal.fire({
//                     title: "Oops...Company name exist.",
//                     icon: "error",
//                     text: "The company name exist, please try again."
//                 }) 
//                 return;
//             }
//         }
//         const form_data = Object.fromEntries(new FormData(event.target).entries());
//         fetch ("guest_registration_backend.php", {
//             method: "POST",
//             headers: {
//                 'Content-Type': 'application/json',
//             },
//             body: JSON.stringify(form_data)
//         })
//         .then(function(res) {
//             return res.json()
//         })
//         .then(function(response) {
//             if(!response.error) {
//                 Swal.fire({
//                     title: "Completed",
//                     icon: "success",
//                     text: successMsg
//                 }).then(function() {
//                     window.location.href = destinationAfterSuccess;
//                 })
//             }
//             else {
//                 Swal.fire({
//                     title: "Oops...Process failed.",
//                     icon: "error",
//                     text: response.error
//                 })
//                 return;
//             }
//         })
//     });
// }