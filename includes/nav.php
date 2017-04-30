<div class="nav-bar"></div>
  <div class="nav-bar-content">
    <img class="nav-image" src="../images/IMG_7357.jpg" />
    <img class="nav-image" src="../images/IMG_7347.jpg" />
    <img class="nav-image" src="../images/DSC_5798.jpg" />
    <img class="nav-image" src="../images/IMG_7377.jpg" />
    <img class="nav-image" src="../images/IMG_7268.jpg" />
    <img class="nav-image" src="../images/IMG_7294.jpg" />
    <br>

    <div class="dropdown">
      <a href="../pages/index.php">Home</a>
    </div>
    
    <div class="dropdown">
         <button class="dropbtn">Admissions and Tuition</button>
        <div class="dropdown-content">
            <a href="../pages/application.php">Application</a>
            <a href="../pages/expenses.php">Cost and Expenses</a>
            <a href="../pages/travelprep.php">Travel Preparation</a>
            <a href="../pages/funding.php">Financial Aid</a>
        </div>
    </div>
    
    <div class="dropdown">
      <a href="../pages/facilities.php">Facilities and Housing</a>
    </div>
  
    
    <div class="dropdown">
         <button class="dropbtn">Classes and Faculty</button>
        <div class="dropdown-content">
            <a href="../pages/asian3360.php">ASIAN 3360</a>
            <a href="../pages/faculty.php">Faculty</a>
            <a href="../pages/fieldtrips.php">Field Trips</a>
            <a href="../pages/calendar.php">Sample Calendar</a>
        </div>
    </div>

    <div class="dropdown">
      <a href="../pages/opportunities.php">Other Opportunities</a>
    </div>

     <div class="dropdown">
         <button class="dropbtn">Blog Archive</button>
        <div class="dropdown-content">
            <a href="../pages/winter2017.php">Winter 2017</a>
        </div>
    </div>
</div>

<script>

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
</script>

