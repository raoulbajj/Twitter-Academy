console.log("follow ionut");

$(".btn-ajax-follow").on("click",(e)=>{

   let content =  e.target.textContent;

   //recuperer l'id host  && l'id user

   let id_user = document.getElementById("id_user").value;
   let id_host =  document.getElementById("id_host").value;
   
//    console.log(id_user,id_host);
   
   $.post("http://localhost:8888/follow",{id_host:id_host,id_user:id_user},function(data){
    console.log(data);
    if(content === "Unfollow"){
        e.target.textContent = "Follow";
        e.target.previousElementSibling.classList.remove("fa-user-minus");
        e.target.previousElementSibling.classList.add("fa-user-plus");
        console.log(e.target.previousElementSibling);
    } else if(content === "Follow"){
        e.target.textContent = "Unfollow";
        e.target.previousElementSibling.classList.remove("fa-user-plus");
        e.target.previousElementSibling.classList.add("fa-user-minus");
        console.log(e.target.previousElementSibling);
    }
   
})
  
})