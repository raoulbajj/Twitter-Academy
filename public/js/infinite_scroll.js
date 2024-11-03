
const tweetsContainer = document.querySelector('.content');
const tweets = document.querySelectorAll('.tweet_container');
let numDisplayed = 10;

for (let i = 0; i < tweets.length; i++) {
    tweets[i].style.display = 'none';
}

for (let i = 0; i < numDisplayed && i < tweets.length; i++) {
    tweets[i].style.display = 'flex';
}

tweetsContainer.addEventListener('scroll', function () {
    if (tweetsContainer.scrollTop + tweetsContainer.clientHeight >= tweetsContainer.scrollHeight) {
        let i = 10;
        numDisplayed += 10;
        console.log(i, numDisplayed);

        for (i = 0; i < numDisplayed && i < tweets.length; i++) {
            tweets[i].style.display = 'flex';
        }
    }
});

// =================================================================================================

const hashtag_container = document.querySelector('.trends-content-container');
const hashtag = document.querySelectorAll('.trend');

for (let i = 0; i < hashtag.length; i++) {
    hashtag[i].style.display = 'none';
}

for (let i = 0; i < numDisplayed && i < hashtag.length; i++) {
    hashtag[i].style.display = 'flex';
}

hashtag_container.addEventListener('scroll', function () {
    if (hashtag_container.scrollTop + hashtag_container.clientHeight >= hashtag_container.scrollHeight) {
        let i = 10;
        numDisplayed += 10;
        console.log(i, numDisplayed);

        for (i = 0; i < numDisplayed && i < hashtag.length; i++) {
            hashtag[i].style.display = 'flex';
        }
    }
});