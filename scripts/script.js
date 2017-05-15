//this code covers the interactivity described in DJ2, actually implemented, not pseudocode 
    //Dropdowns for items like faculty on the Classes & Faculty Page (it can be hidden to minimize distraction but once
    //clicked, all information is visible, similar to the dropdowns on https://aap.cornell.edu/academics/rome/admissions-and-tuition)
    //Using dropdowns will allow information to be hidden/seen dependent on the user’s preferences.
    //"topbutton" is the BACK TO TOP button we decided to implement after user testing, clicking on this button brings you to the top of the page (another feature to eliminate unnecessary scrolling and improve user experience)

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].onclick = function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  }
}

function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onhover = function(e) {
  if (!e.target.matches('.dropdownbutton')) {
    var myDropdown = document.getElementById("myDropdown");
      if (myDropdown.classList.contains('show')) {
        myDropdown.classList.remove('show');
      }
  }
}

window.onload = function(){
  document.getElementById('topbutton').onclick = function () {
    scrollTo(document.body, 0, 100);
  }

  function scrollTo(element, to, duration) {
    if (duration < 0) return;
        var difference = to - element.scrollTop;
        var perTick = difference / duration * 2;

    setTimeout(function() {
        element.scrollTop = element.scrollTop + perTick;
        scrollTo(element, to, duration - 2);
    }, 10);
  }
}
