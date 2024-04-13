document.addEventListener("DOMContentLoaded", function() {
    var images = document.querySelectorAll(".homeImage");
    var index = 0;

    function showImage() {
        images[index].style.display = "block";
        images[index].classList.add("fade-in");

        setTimeout(hideImage, 10000); 
    }

    function hideImage() {
        images[index].classList.remove("fade-in");
        images[index].style.display = "none";

        index = (index + 1) % images.length;
        showImage();
    }

    showImage();
});
