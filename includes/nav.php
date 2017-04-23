<div class="navigation">
    <a href="../pages/index.php">Home</a>
    
    <div class="dropdown">
         <button class="dropbtn">Admissions and Tuition</button>
        <div class="dropdown-content">
            <a href="../pages/application.php">Application</a>
            <a href="../pages/expenses.php">Cost and Expenses</a>
            <a href="../pages/travelprep.php">Travel Preparation</a>
            <a href="../pages/funding.php">Financial Aid</a>
        </div>
    </div>
    
    <a href="../pages/facilities.php">Facilities and Housing</a>
  
    
    <div class="dropdown">
         <button class="dropbtn">Classes and Faculty</button>
        <div class="dropdown-content">
            <a href="../pages/asian3360.php">ASIAN 3360</a>
            <a href="../pages/faculty.php">Faculty</a>
            <a href="../pages/fieldtrips.php">Field Trips</a>
            <a href="../pages/calendar.php">Sample Calendar</a>
        </div>
    </div>
    <a href="../pages/opportunities.php">Other Opportunities</a>

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

