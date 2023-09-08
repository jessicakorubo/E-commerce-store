// Add hamburger menu 

const bar = document.getElementById('bar');
const nav = document.getElementById('navbar');

const close = document.getElementById('close')

if (bar) {
    bar.addEventListener('click', ()=> {
        nav.classList.add('active')
    })
}

if (close) {
    close.addEventListener('click', ()=> {
        nav.classList.remove('active')
    })
}
 var MainImg = document.getElementById('MainImg');

var smallimg = document.getElementsByClassName('small-img');

var smallImages = [].slice.call(smallimg);

console.log(smallImages);

smallImages.forEach(small => {
    small.onclick = function() {
    MainImg.src = small.src;
    }
});

// FOR THE ACORDION IN THE CATEGORIES VIEW PAGE

var accordion = document.getElementsByClassName('acc-icon')


var accordion2 = document.querySelector('.acc-icon')
var category_card2 = document.querySelector('.cat');
var cat_description2 = document.querySelector('cat-description');

// accordion2.addEventListener('click', ()=>{

//         for (var r=0; r<cat_description.length; r++){
//             category_card[r].classList.toggle('active');
//         }
//         for (var j=0; j< cat_description.length; j++){
//             if(cat_description[j].style.maxHeight) {
//                 cat_description[j].style.maxHeight = null;
//             }
//             else {
//                 cat_description[j].style.maxHeight = cat_description[j].scrollHeight + "rem";
//             }
//         } 
//     })

// for (var i=0; i<accordion.length; i++){

//     accordion[i].addEventListener('click', ()=>{
//         console.log(i, "icon");

//         // category_card.classList.toggle('active');

//         var cat_description = this.nextElementSibling;

//         console.log(cat_description);
//         console.log(this, "this");

//         if(cat_description.style.maxHeight) {
//             // cat_description.style.maxHeight = cat_description.scrollHeight + "px";
//             console.log("Working 3");
//         }
//     })    
// }


// for (var i=0; i< accordion.length; i++){
//     accordion[i].addEventListener('click', ()=>{

//         var cat_desc = cat_description[i];


//         for (var r=0; r< cat_description.length; r++){
//             category_card[r].classList.toggle('active');
//         }
//         for (var j=0; j< cat_description.length; j++){
//             if(cat_description[i].style.maxHeight) {
//                 cat_description[j].style.maxHeight = null;
//             }
//             else {
//                 cat_description[j].style.maxHeight = cat_description[j].scrollHeight + "rem";
//             }
//         } 
//     })
// }
if (accordion) {
console.log(accordion, 'accordion');
}
else {
    console.log('there is no accordion');
}
var acArray = [].slice.call(accordion);
console.log(acArray, 'array from accordion');

acArray.forEach((arr) =>{
    arr.addEventListener('click',  (e)=> {
        const description = e.target.nextElementSibling;
        const category_card = e.target.parentElement;
        console.log(category_card);
        const mydesc = category_card.parentElement.lastElementChild;
        console.log(mydesc);
        mydesc.classList.toggle('active');

    })
})