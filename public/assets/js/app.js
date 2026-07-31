const menuToggle=document.getElementById("menuToggle");

const mobileMenu=document.getElementById("mobileMenu");

if(menuToggle){

menuToggle.addEventListener("click",function(){

mobileMenu.classList.toggle("active");

});

}

window.addEventListener("scroll",function(){

const header=document.getElementById("siteHeader");

if(window.scrollY>40){

header.classList.add("sticky");

}else{

header.classList.remove("sticky");

}

});