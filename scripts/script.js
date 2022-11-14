document.addEventListener("keyup", e=>{

    if(e.target.matches("#buscador")){
        document.querySelectorAll(".libuscar").forEach( listado=>{
            listado.textContent.toLowerCase().includes(e.target.value.toLowerCase())
            ?listado.classList.remove("filtro")
            :listado.classList.add("filtro")
        })
    }
})