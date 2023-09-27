const form = document.querySelector(".typing-area");
const buttonSend = document.querySelector(".typing-area button");
const inputMsg = form.querySelector("input");
const incoming = document.getElementById("incoming");
const outcoming = document.getElementById("outcoming");
const profileImg = document.querySelector("header img");
const chatBox = document.querySelector(".chat-box");


form.addEventListener('submit', (e) => {
    e.preventDefault();
})

inputMsg.onkeyup = () => {
    if (inputMsg.value != undefined && inputMsg.value.trim() !== "") {
        buttonSend.classList.remove("not-send");
    } else {
        buttonSend.classList.add("not-send");
    }
}

buttonSend.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert_chat.php", true);
    let formData = new FormData(form);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {

            if (xhr.status === 200) {

                if (xhr.response === 'success') {
                    inputMsg.value = '';
                    buttonSend.classList.add("not-send");
                }
            }
        }
    }
    formData.append('incoming', incoming.innerText);
    formData.append('outcoming', outcoming.innerText);


    xhr.send(formData);

}

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", `php/get_chat.php?outcoming=${outcoming.innerText}&incoming=${incoming.innerText}`, true);

    

    xhr.onload = () => {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            
            if (xhr.status == 200) {
                let listChat = "";
                
                if (xhr.getResponseHeader('Content-Type') && xhr.getResponseHeader('Content-Type').includes('application/json')) {
                    try {
                        const parsedUserArray = JSON.parse(xhr.response);
                        parsedUserArray.forEach(user => {
                            if(user.inout == "outcoming"){
                                listChat += `<div class="chat outgoing">
                                <div class="details">
                                    <p>${user.msg}</p>
                                </div>
                            </div>`
                            } else {
                                listChat += `<div class="chat incoming">
                                <img src="${profileImg.getAttribute('src')}" alt="">
                                <div class="details">
                                    <p>${user.msg}</p>
                                </div>
                            </div>`
                            }
                        })
                    } catch { 
                        return
                    }
                }
                if(chatBox.innerHTML != listChat){
                    chatBox.innerHTML = listChat;
                }

            }
        }
        
    }

    xhr.send();
}, 500)
