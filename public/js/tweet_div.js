const profileDiv = document.querySelector('.profile');
console.log(profileDiv);
const tweetsDiv = document.querySelector('.tweets');
const windowHeight = window.innerHeight;
const profileHeight = profileDiv.offsetHeight;
const tweetHeight = `calc(${windowHeight}px - ${profileHeight}px)`;

tweetsDiv.style.minHeight = tweetHeight;
