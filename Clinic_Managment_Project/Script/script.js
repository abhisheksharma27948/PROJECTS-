const title = document.getElementById("title");
const subtitle = document.getElementById("subtitle");

title.addEventListener("mouseover", function () {
    subtitle.textContent = "Click to learn more!";
});

title.addEventListener("mouseout", function () {
    subtitle.textContent = "Welcome to our clinic!";
});

title.addEventListener("click", function () {
    window.location.href = "https://www.example.com";
});
