console.log("hello");

$(".heart-svg").on("click",(e)=>{
    console.log(e.target.parentNode.parentNode.nextElementSibling.value);
    console.log(document.querySelector("#id_user").value);

    let id_tweet = e.target.parentNode.parentNode.nextElementSibling.value;
    let id_user = document.querySelector("#id_user").value;
    console.log(id_tweet, id_user);
    $.post( "http://localhost:8888/likes", { id_user: id_user, id_tweet: id_tweet }, function(data){
        let decoded_data = JSON.parse(data);
        console.log(decoded_data);
        if(e.target.dataset.liked == "no"){
            e.target.dataset.liked = "yes"
            e.target.nextElementSibling.textContent = decoded_data[0].likes;
            e.target.querySelector("path").setAttribute("d", `M21.4,6.5c-0.9-1.8-2.6-2.9-4.6-3c-1.7-0.1-3.4,0.6-4.8,2c-1.4-1.4-3.1-2.1-4.8-2c-2,0.1-3.7,1.2-4.6,3
            c-0.9,1.8-0.9,4.2,0.5,6.7c1.4,2.5,4,5.2,8.4,7.7l0.5,0.3l0.5-0.3c4.4-2.6,7-5.2,8.4-7.7C22.2,10.7,22.3,8.3,21.4,6.5z`);
        } else {
            e.target.dataset.liked = "no"
            e.target.nextElementSibling.textContent -= 1;
            e.target.querySelector("path").setAttribute("d", `M16.7,5.5C15.5,5.4,14,6,12.8,7.7L12,8.8l-0.8-1.1C10,6,8.5,5.4,7.3,5.5S5,6.3,4.4,7.4s-0.6,2.8,0.5,4.8s3.3,4.3,7.1,6.6
            c3.9-2.3,6.1-4.6,7.1-6.6c1.1-2,1-3.7,0.5-4.8C19,6.3,17.9,5.6,16.7,5.5z M20.9,13.2c-1.4,2.5-4,5.1-8.4,7.7L12,21.2l-0.5-0.3
            c-4.4-2.5-7-5.2-8.4-7.7S1.7,8.3,2.6,6.5s2.6-2.9,4.6-3c1.7-0.1,3.4,0.6,4.8,2c1.4-1.4,3.1-2.1,4.8-2c2,0.1,3.7,1.2,4.6,3
            C22.3,8.3,22.2,10.7,20.9,13.2z`);
        }
    });
})