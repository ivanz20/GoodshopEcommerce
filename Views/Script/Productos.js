$("#registrarproducto").submit (function (e){
    e.preventDefault();
      var formData = new FormData(document.getElementById("registrarproducto"));
      console.log(formData)

        $.ajax({
            type: "POST",
            url: "../Controller/ProductoController.php",
            data: formData,
            type: "POST",
            dataType: "HTML",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if(data){
                    alert("Se ha agregado el producto.");
                    window.location.href = "../Views/gestionproductos.php";
                }
            },
            error: function (data) {
                
                if(data){
                    alert(data.responseText);
                }
            }
        });

});