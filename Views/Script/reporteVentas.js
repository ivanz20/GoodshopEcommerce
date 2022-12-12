function ShowCombo(selectObject){
    const selectDates = document.querySelector("#Dates");
    const selectCategories = document.querySelector("#category-report");

    if(selectObject.value == 'Por Rango De Fechas'){
        selectDates.style.display = 'block';
        selectCategories.style.display = 'none';
    }

    if(selectObject.value == 'Por categoría'){
        selectDates.style.display = 'none';
        selectCategories.style.display = 'block';
    }
}

// const form = document.querySelector(".form-filtro");
// const btnFiltro = form.querySelector("#btn-filtro");

// form.onsubmit = (e) =>{
//     e.preventDefault();
// }

// btnFiltro.onclick = () => {
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST","reporteventas.php",true);
//     xhr.onload = () => {
//          if(xhr.status === 200){
             
//          }
//     }
//     let formData = new FormData(form);
//     xhr.send(formData);
 
//  }

// setInterval(()=>{
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST","FiltroBusquedaVendor.php");
//     xhr.onload = () =>{
//         if(xhr.readyState === XMLHttpRequest.DONE){
//             if(xhr.status === 200){
//                 let data = xhr.response;
//                 console.log(data);
//                 chatBox.innerHTML = data;
//             }
//         }
//     }
//     let formData = new FormData(form);
//    xhr.send(formData);
// },500);