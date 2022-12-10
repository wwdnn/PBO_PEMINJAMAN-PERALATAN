// let arrow = document.querySelectorAll(".arrow");
// for (var i = 0; i < arrow.length; i++) {
//   arrow[i].addEventListener("click", (e)=>{
//  let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
//  arrowParent.classList.toggle("showMenu");
//   });
// }

// let sidebar = document.querySelector(".sidebar");
// let sidebarBtn = document.querySelector(".bx-menu");
// console.log(sidebarBtn);
// sidebarBtn.addEventListener("click", ()=>{
//   sidebar.classList.toggle("close");
// });

$('.produk').slick({
  dots: true,
  speed: 500,
  autoplay: true,
});

function openNav() {
  document.getElementById("mySidenav").style.width = "200px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}


// $(document).ready(function () {
//     $('.decrease_').click(function () {
//         decreaseValue(this);
//     });
//     $('.increase_').click(function () {
//         increaseValue(this);
//     });
//     function increaseValue(_this) {
//         var value = parseInt($(_this).siblings('input#number').val(), 10);
//         value = isNaN(value) ? 0 : value;
//         value++;
//         $(_this).siblings('input#number').val(value);
//     }

//     function decreaseValue(_this) {
//         var value = parseInt($(_this).siblings('input#number').val(), 10);
//         value = isNaN(value) ? 0 : value;
//         value < 1 ? value = 1 : '';
//         value--;
//         $(_this).siblings('input#number').val(value);
//     }
// });
