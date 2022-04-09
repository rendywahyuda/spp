// Sticky NavBar 
// let nav = document.querySelector("nav");
// window.onscroll = function() {
//     if (document.documentElement.scrollTop > 50) {
//         nav.classList.add("sticky");
//     } else {
//         nav.classList.remove("sticky");
//     }
// }

// Notification
// var box = document.getElementById('box');
// var down = false;

// function toggleNotifi() {
//     if (down) {
//         box.style.height = '0px';
//         box.style.opacity = 0;
//         down = false;
//     } else {
//         box.style.height = '300px';
//         box.style.opacity = 1;
//         down = true;
//     }
// }

// Image Slider
// var counter = 1;
// setInterval(function() {
//     document.getElementById('radio' + counter).checked = true;
//     counter++;
//     if (counter > 2) {
//         counter = 1;
//     }
// }, 7500);

// SIDEBAR
let sidebar = document.querySelector(".sidebar");
let closeBtn = document.querySelector("#btn");
let searchBtn = document.querySelector(".bx-search");
let arrow = document.querySelectorAll(".arrow");
        for (var i = 0; i < arrow.length; i++) {
            arrow[i].addEventListener("click", (e) => {
                let arrowParent = e.target.parentElement.parentElement;
                arrowParent.classList.toggle("showMenu");
            });
        }

closeBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("open");
    menuBtnChange();
});

// searchBtn.addEventListener("click", ()=>{ 
//     sidebar.classList.toggle("open");
//     menuBtnChange();
// });

function menuBtnChange() {
    if(sidebar.classList.contains("open")){
    closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
    }else {
    closeBtn.classList.replace("bx-menu-alt-right","bx-menu");
    }
}

// DATE TIME
function updateClock() {
    var now = new Date();
    var dname = now.getDay(),
        mo = now.getMonth(),
        dnum = now.getDate(),
        yr = now.getFullYear(),
        hou = now.getHours(),
        min = now.getMinutes(),
        sec = now.getSeconds(),
        pe = "AM";

    if (hou >= 12) {
        pe = "PM";
    }
    if (hou == 0) {
        hou = 12;
    }
    if (hou > 12) {
        hou = hou - 12;
    }

    Number.prototype.pad = function(digits) {
        for (var n = this.toString(); n.length < digits; n = 0 + n);
        return n;
    }

    var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember"];
    var week = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
    var ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds", "period"];
    var values = [week[dname], months[mo], dnum.pad(2), yr, hou.pad(2), min.pad(2), sec.pad(2), pe];
    for (var i = 0; i < ids.length; i++)
        document.getElementById(ids[i]).firstChild.nodeValue = values[i];
}

function initClock() {
    updateClock();
    window.setInterval("updateClock()", 1);
}