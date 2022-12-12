const form = document.querySelector(".form-mensaje");
const inputField = form.querySelector(".input-mensaje");
const sendBtn = form.querySelector(".btn-send");
const chatBox =  document.querySelector(".chat-active");
const inputUser = form.querySelector(".input-mensaje");

form.onsubmit = (e) =>{
    e.preventDefault();
}

sendBtn.onclick = () => {
   let xhr = new XMLHttpRequest();
   xhr.open("POST","../Model/insert-chat.php",true);
   xhr.onload = () => {
        if(xhr.status === 200){
            inputField.value = "";
        }
   }
   let formData = new FormData(form);
   xhr.send(formData);

}

setInterval(()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST","../Model/get-chats.php");
    xhr.onload = () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
                chatBox.innerHTML = data;
            }
        }
    }
    let formData = new FormData(form);
   xhr.send(formData);
},500);