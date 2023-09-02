let n = new Date();

let day = n.getDay();
let dayArr = [
    "Sunday",
    "Monday",
    "Tuesday",
    "Wednesday ",
    "Thursday",
    "Friday",
    "Saturday",
];
day = dayArr[day];

let year = n.getFullYear();

let month = n.getMonth();
let monthArr = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
];
month = monthArr[month];

let date = n.getDate();

document.querySelector(
    ".hero__date"
).innerHTML = `${day}, ${date} ${month} ${year}`;
