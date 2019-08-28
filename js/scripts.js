$(document).ready(function() {
  var menu = document.getElementById("primary-menu");
  var links = menu.getElementsByTagName("a");

  for (i = 0; i < links.length; i++) {
    links[i].addEventListener(
      "click",
      function(event) {
        for (j = 0; j < links.length; j++) {
          links[j].parentNode.classList.remove("li-active");
        }
        links[i].parentNode.classList.add("li-active");
        console.log("handler is working...");
      },
      false
    );
  }
});

function toggleBtn(){
  this.innerHTML = "Clicked";
}

//$('.dropdown-toggle').dropdown();
