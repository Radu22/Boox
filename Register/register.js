function toMainPage(){
	window.location.href = '../MainPage.php';
}

var img = document.getElementById('myImg');

var modal1 = document.getElementById('myModal1');
var modal2 = document.getElementById('myModal2');

var btn1 = document.getElementById("register");
var btn2 = document.getElementById("login");

var span1 = document.getElementsByClassName("close")[0];
var span2 = document.getElementsByClassName("close")[1];

btn1.onclick = function() {
    modal1.style.display = "block";
}

btn2.onclick = function() {
    modal2.style.display = "block";
}

span1.onclick = function() {
    modal1.style.display = "none";
}

span2.onclick = function() {
    modal2.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal1) {
        modal1.style.display = "none";
    }
    if(event.target == modal2){
    	modal2.style.display = "none";
    }
}

function register_visible(){
	img.style.opacity = 0.3;
	btn1.style.background = "rgb(230, 230, 255)";
}

function login_visible(){
	img.style.opacity = 0.3;
	btn2.style.background = "#4bc970";
}

function image_visible(){
	btn1.style.background = "#4bc970";
	btn2.style.background = "rgb(230, 230, 255)";
	img.style.opacity = 0.9;
}