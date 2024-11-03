const following_div = document.querySelector(".following-content");
const followers_div = document.querySelector(".followers-content");

const following_btn = document.querySelector(".following-tab");
const followers_btn = document.querySelector(".followers-tab");


following_btn.addEventListener("click",e=>{
    followers_div.classList.add("hidden");
    following_div.classList.remove("hidden"); 
    console.log(followers_div);
})

followers_btn.addEventListener("click",e=>{
    followers_div.classList.remove("hidden");
    following_div.classList.add("hidden");
    console.log(e);
})