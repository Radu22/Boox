function toMainPage(){
	window.location.href = '../MainPage.php';
}

var modal1 = document.getElementById('myModal1');
var modal2 = document.getElementById('myModal2');

var btn1 = document.getElementById("register");
var btn2 = document.getElementById("login");

var span = document.getElementsByClassName("close")[0];

btn1.onclick = function() {
    modal1.style.display = "block";
}

btn2.onclick = function() {
    modal2.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
    if(event.target == modal2){
    	modal2.style.display = "none";
    }
}