console.log("retweet");

console.log("hello");

$(".retweet-svg").on("click",(e)=>{
    console.log(e.target.parentNode.parentNode.nextElementSibling.value);
    console.log(document.querySelector("#id_user").value);

    let id_tweet = e.target.parentNode.parentNode.nextElementSibling.value;
    let id_user = document.querySelector("#id_user").value;

    console.log(id_tweet,id_user)

    $.post( "http://localhost:8888/retweet", { id_user: id_user, id_tweet: id_tweet }, function(data){
        console.log(data);
       
        // e.target.classList.remove("fa-heart");
        // e.target.classList.remove("far");
        // e.target.classList.add("fa-solid");
        // e.target.classList.add("fa-heart");
        // e.target.textContent = decoded_data[0].likes;
    } );
})