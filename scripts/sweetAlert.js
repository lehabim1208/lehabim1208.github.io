
    document.getElementById("boton1").onclick=modal1;

    function modal1(){
        Swal.fire({
            title: '¿Estás en la facultad?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Si',
            denyButtonText: `No`,
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "pagina2.html";
            } else if (result.isDenied) {
                window.location.href = "pagina2.1.html";
            }
        })  
    }


    document.getElementById("boton2").onclick=modal2;

    function modal2(){
        Swal.fire({
            title: '¿Estás en la facultad?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Si',
            denyButtonText: `No`,
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "pagina2.html";
            } else if (result.isDenied) {
                window.location.href = "pagina2.1.html";
            }
        })  
    }


    document.getElementById("boton3").onclick=modal3;

    function modal3(){
        Swal.fire({
            title: '¿Estás en la facultad?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Si',
            denyButtonText: `No`,
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "pagina2.html";
            } else if (result.isDenied) {
                window.location.href = "pagina2.1.html";
            }
        })  
    }
