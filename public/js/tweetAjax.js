console.log("Unlimited tweets");

const tweetBtn = document.getElementById('tweet-btn');
const editModal = document.getElementById('editModal');
const modalContent = document.querySelector('.modal-content');
const closeBtn = document.querySelector('.close');
const imp = document.querySelector("#import");

let is_activated_tweet = false;


tweetBtn.addEventListener("click",(e)=>{
    // event listener for the tweet button
    console.log("hello1")
    
    if(is_activated == false){
    let id_user = document.querySelector("#id_user").value;
    
    document.querySelector("#saveButton").addEventListener("click",tweet);
    
      // Close the modal
    closeBtn.addEventListener('click', () => {
      editModal.style.display = 'none';
      //remove event listener from the save button
      editModal.setAttribute("placeholder", "");
      //empty the input field
      document.querySelector("#editInput").value = "";
      //reset the span counter
      document.querySelector("#counter").textContent = "140 characters left";
    });

     // Close the modal when user clicks outside of modal
     window.addEventListener('click', (event) => {
      if (event.target === editModal) {
        editModal.style.display = 'none';
        //remove event listener from the save button
       
        document.querySelector("#editInput").value = "";
        document.querySelector("#counter").textContent = "140 characters left";
        editModal.setAttribute("placeholder", "");
      }
    });


   function tweet(e){
      console.log("ok",id_user);
      let message = e.target.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.value

      if(message.length < 1){
          //ecriture d'un message d'erreur dans le placeholder
          console.log("0",e.target.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling)
          e.target.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.setAttribute("placeholder", "You can't tweet an empty message");
          return;
      } else {
        console.log("1",e.target.previousElementSibling.previousElementSibling)
          //suppression du message d'erreur dans le placeholder
          e.target.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.setAttribute("placeholder", "");
      }

      $.post("http://localhost:8888/tweets",{ id_user: id_user,message: message}, function(data){
          console.log(data)
          //refresh the page
          location.reload();

      })
    } 
    is_activated_tweet = true;
    }else{
      console.log("c'est bon")
  }
},{once:true});
    
    // To open the modal
    tweetBtn.addEventListener('click', () => {
      editModal.style.display = 'block';
    });

//add an event listener to the input field
//when the user types in the input field, the event listener will be triggered
//the event listener will call a function that will regulate the span counter
//the function will check the length of the input field
//the function will update the span counter

//ADD EVENT LISTENER on keyup 
$("#editInput").on("keyup", function(e){
    //get the value of the input field
    let tweet = $(this).val();
    //get the length of the input field
    let tweetLength = tweet.length;
    //update the span counter
    $("#counter").text(140 - tweetLength);
    //if the length of the input field is greater than 280
    if(tweetLength >= 140){
        //change the color of the span counter to red
        $("#counter").css("color", "red");
    } else {
        //change the color of the span counter to black
        $("#counter").css("color", "aliceblue");
    }
    //update the span counter
    e.target.nextElementSibling.textContent = `${140 - tweetLength} characters left`;
});


imp.addEventListener("click",()=>{
  //recupere l'url de l'image et met le dans l'imput sous forme de img src
  
  let url = document.querySelector("#url").value;
  console.log(url);
  //si le compteur moins l'url est inferieur a 0 alors on ne peut pas poster
  let tweetLength = url.length;
  let tweet = document.querySelector("#editInput").value;
  let tweetLength2 = tweet.length;
  if(tweetLength + tweetLength2 > 140){
    alert("Url too long");
    document.querySelector("#counter").textContent = "140 characters left";
    return;
  }
  document.querySelector("#editInput").value += url;
 
  //met a jour le compteur de caractere en fonction de la longueur de l'url
  document.querySelector("#counter").textContent = `${140 - (tweetLength + tweetLength2)} characters left`;
})