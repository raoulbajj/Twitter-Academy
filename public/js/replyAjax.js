console.log("reply");

let is_activated = false;
let is_the_same;


$(".comment-svg").on("click", (e) => {

   if(is_the_same == +e.target.parentNode.parentNode.nextElementSibling.value && is_activated == true){
      //CLEANING THE COMM before displaying new ones
      document.querySelectorAll(".comment-container").forEach(com=>{
        com.remove();
    })
    is_activated = false;
    return;
   }

   is_activated = true;
    console.log(e.target.parentNode.parentNode.nextElementSibling.value);
    let parent = e.target.parentNode.parentNode.parentNode;
   
    //CLEANING THE COMM before displaying new ones
    document.querySelectorAll(".comment-container").forEach(com=>{
        com.remove();
    })

        //recuperer l'identifiant du tweed
    let id_tweet = e.target.parentNode.parentNode.nextElementSibling.value;
    //recuperer l'id de celui qui va commenter 
    let id_user = document.querySelector("#id_user").value;

    $.post("http://localhost:8888/reply", { id_tweet: id_tweet }, function (data) {
        /* let decoded_data = JSON.parse(data);
        console.log(e.target.textContent) */
        console.log(data)
        let replies = JSON.parse(data);

        let div_containers_comments = document.createElement("div");
        div_containers_comments.setAttribute("class","comment-container");
        let reply_button_container = document.createElement("div");
        let reply_button_icon = document.createElement("i");
        reply_button_icon.classList.add("fa-duotone", "fa-reply");
        reply_button_container.classList.add("reply-container");
        reply_button = document.createElement("button");
        reply_button.setAttribute("id", "reply-btn");
        reply_button.textContent = "Reply";
        reply_button.insertBefore(reply_button_icon, reply_button.firstChild);
        reply_button.addEventListener("click", () => {
            //creer une div avec un input text area 
            let textArea = document.createElement("textarea");
            textArea.setAttribute("id", "reply-message");
            // creer un button 
            let send_button = document.createElement("button");
            let send_button_icon = document.createElement("i");
            send_button_icon.classList.add("fa-duotone", "fa-paper-plane");
            send_button.setAttribute("id", "send-reply");
            send_button.textContent = "Send";
            send_button.insertBefore(send_button_icon, send_button.firstChild);
            // creer l'evenement pour le button 
            send_button.addEventListener("click", (e) => {
                let message = e.target.previousElementSibling.value;
                console.log("message",message);
                // envoyer les donné & recupere les comms
                $.post("http://localhost:8888/reply", { id_tweet: id_tweet, id_user: id_user, message: message }, function (data) {
                    console.log(data)
                    console.log(id_tweet,id_user,message)
                    replies = JSON.parse(data);
                    generateComments();

                })

            },{once:true})

            //ajouter au dom 
            reply_button_container.appendChild(textArea);
            reply_button_container.appendChild(send_button);

            // supprime le reply_button
            reply_button.remove();
        })



        //genere les comments 

        generateComments();

        //change flow control 
         is_activated = true;


        //function qui genere les div avec les reponses (utilisé 2 foix )
        function generateComments() {
            console.log("wow")
            div_containers_comments.innerHTML = "";
            reply_button_container.innerHTML = "";
            reply_button_container.appendChild(reply_button);
            div_containers_comments.appendChild(reply_button_container);
            // parent.appendChild(div_containers_comments);
            if (replies.length > 0) {
                replies.forEach(cmt => {
                    let div_comment = document.createElement("div");
                    div_comment.classList.add("comment");
                    div_comment.innerHTML = `
                    <div class='tweet_container'>
                        <div class='info_container'>
                            <div class="flex">
                                <div class='img-circle avatar'>
                                    <img class='tweets-pp' src=${cmt.avatar} alt='Les Muskets.Inc'>
                                </div>
                                <div class="name-username-container">
                                    <p class="tweet-name">${cmt.name}</p>
                                    <p class="at">@${cmt.username}</p>
                                </div>
                            </div>
                            <p>${cmt.date_send}</p>
                        </div>
                        <div class='tweet-content'>${cmt.message}</div>

                        <div class="icon_container">
                        </div>
                        <input class="tweets_id" type="hidden" value=${cmt.id}>
                    </div>
                    `;
                    div_containers_comments.appendChild(div_comment);
                    parent.appendChild(div_containers_comments);
                });
            } else {
                div_containers_comments.appendChild(reply_button_container);
                parent.appendChild(div_containers_comments);
            }

        }

        is_the_same = +e.target.parentNode.parentNode.nextElementSibling.value;



    });
    

    
})
