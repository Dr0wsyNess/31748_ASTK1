function dropdownFun(){
    var nav = document.getElementsById("myCatNav");
    if(nav.className === "catNav"){
        nav.className += "responsive";
    }
    else{
        nav.className = "catNav";
    }

}

// var dropdown = document.getElementsByClassName("dropdown-btn");
// for (i = 0; i < dropdown.length; i++) {
//     dropdown[i].addEventListener("click", function () {
//         this.classList.toggle("active");
//         var dropdownContent = this.nextElementSibling;
//         if (dropdownContent.style.display === "block") {
//             dropdownContent.style.display = "none";
//         } else {
//             dropdownContent.style.display = "block";
//         }
//     });
// }