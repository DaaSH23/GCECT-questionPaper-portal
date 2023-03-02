
var IDname = "GCECT";
var Pass = "Btech";

function Redirect() {
    window.location = "admin-panel.html";
 }

var name = document.getElementById("floatingInput").value;

var form = document.getElementById("kol");
form.addEventListener('submit', function(cutg){
    cutg.preventDefault()

    var name = document.getElementById("floatingInput").value;
    var pas = document.getElementById("floatingPassword").value;

    console.log(name);
    console.log(pas);
    if (name == IDname && Pass == pas) {
        Redirect();
    }
})

