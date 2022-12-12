$(document).ready(function() {
    var numItems = $('.inicio-cards').length;
    $('#productos-inicio').css('width', numItems * 240);
});



const RecienLlegados = document.querySelector("#btn-recien");
const Populares = document.querySelector("#btn-popu");
const Vendidos = document.querySelector("#btn-vendidos");
const Recomendados = document.querySelector("#btn-recomendados");

const data = document.querySelector("#group-recien");
const data1 = document.querySelector("#group-populares");
const data2 = document.querySelector("#group-masvendidos");
const data3 = document.querySelector("#group-recomendados");

RecienLlegados.onclick = () => {
    data1.style.display = 'none';
    data.style.display = 'block';
    data2.style.display = 'none';
    data3.style.display = 'none';  

}

Populares.onclick = () => {
   data1.style.display = 'block';
   data.style.display = 'none';
   data2.style.display = 'none';
   data3.style.display = 'none';

}

Vendidos.onclick = () => {
    data1.style.display = 'none';
    data.style.display = 'none';
    data2.style.display = 'block';
    data3.style.display = 'none';
 
 }
 
 Recomendados.onclick = () => {
    data1.style.display = 'none';
    data.style.display = 'none';
    data2.style.display = 'none';
    data3.style.display = 'block';
 
 }