const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
const currentTheme = localStorage.getItem('theme');

if (currentTheme) {
    document.documentElement.setAttribute('data-theme', currentTheme);

    if (currentTheme === 'dark') {
        toggleSwitch.checked = true;
    }
}

function switchTheme(e) {
    if (e.target.checked) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark');
    }
    else {
        document.documentElement.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light');
    }
}

toggleSwitch.addEventListener('change', switchTheme, false);

// $(function () {
//     $('.navbar-toggler').click(function () {
//         $('body').toggleClass('noscroll');
//     })
// });

$('.dropdownhover').hover(function () {
    $(this).trigger('click');
}, function () { });
// When the user scrolls down 20px from the top of the document, show the button

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
// hide navbar
var prevScrollpos = window.pageYOffset;
window.onscroll = function () {
    scrollFunction()
};
console.log('asd');
function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("movetop").style.display = "block";
    } else {
        document.getElementById("movetop").style.display = "none";
    }
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos || currentScrollPos == 0) {
        document.getElementsByClassName("w3l-header")[0].style.top = "0";
    } else {
        document.getElementsByClassName("w3l-header")[0].style.top = "-150px";
    }
    prevScrollpos = currentScrollPos;
}
  // -- hide navbar