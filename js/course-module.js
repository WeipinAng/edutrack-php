function validateModuleCode() {
    let input = document.getElementById("module_code").value;
    let regex = /^[A-Z]{3}\d{5}$/;

    if (!regex.test(input)) {
        alert(
            "Sorry, the module code should have 3 uppercase letters followed by 5 digits."
        );
        document.getElementById("module_code").value = "";
    }
}

function capitalizeModuleName() {
    let input = document.getElementById("module_name");
    let words = input.value.split(" ");
    let capitalizedFullName = [];

    for (let i = 0; i < words.length; i++) {
        let word = words[i];
        let capitalizedWord = word.charAt(0).toUpperCase() + word.slice(1);
        capitalizedFullName.push(capitalizedWord);
    }

    input.value = capitalizedFullName.join(" ");
}
