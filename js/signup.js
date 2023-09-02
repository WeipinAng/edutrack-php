window.addEventListener("DOMContentLoaded", function () {
    let onlyStudentField = document.querySelectorAll(".student-only");

    for (let i = 0; i < onlyStudentField.length; i++) {
        onlyStudentField[i].style.visibility = "hidden";
    }
});

function capitalizeFullName() {
    let input = document.getElementById("full_name");
    let words = input.value.split(" ");
    let capitalizedFullName = [];

    for (let i = 0; i < words.length; i++) {
        let word = words[i];
        let capitalizedWord = word.charAt(0).toUpperCase() + word.slice(1);
        capitalizedFullName.push(capitalizedWord);
    }

    input.value = capitalizedFullName.join(" ");
}

function checkICLength(identitycardnumber) {
    if (identitycardnumber.value.length != 12) {
        alert("Sorry, your NRIC should have exactly 12 digits.");
        document.getElementById("nric").value = "";
    }
}

//  make age show up automatically after the user finishes inputting their birth year
function calcAge(birthInput) {
    let birthDate = new Date(birthInput.value);
    let currentYear = new Date().getFullYear();

    if (!isNaN(birthDate.getTime())) {
        let age = currentYear - birthDate.getFullYear();
        document.getElementById("age").value = age;
    }
}

let select = document.getElementById("role");
let onlyStudentField = document.querySelectorAll(".student-only");

select.addEventListener("change", function () {
    for (let i = 0; i < onlyStudentField.length; i++) {
        if (select.value === "teacher") {
            onlyStudentField[i].style.visibility = "hidden";
        } else {
            onlyStudentField[i].style.visibility = "visible";
        }
    }
});
