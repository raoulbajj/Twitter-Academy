

$(".at").on("click",(e)=>{
    let id_user = e.target.nextElementSibling.value;
    
    window.location.href =  `http://localhost:8888/profile?id_user=${id_user}`;
   
})


