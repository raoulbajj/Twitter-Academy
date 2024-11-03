// ===================================================================================================================================
// Loader

const loader = document.querySelector('.loader');

window.addEventListener('load', function () {
  loader.classList.add("fade-out");
  this.setInterval(function () {
    loader.style.zIndex = "-1";
  }, 500);

});
