$(".f").on ("click", e=>{
    // let id_user = document.querySelector("#id_user").value;
    let data = e.target.dataset.f;
    console.log (e.target.dataset.f);
    window.location.href =`/follows?data=${data}`;
});