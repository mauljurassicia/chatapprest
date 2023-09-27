const form = document.querySelector(".signup form"),
continueBtn = document.querySelector(".button input"),
errorText = document.querySelector(".form form .error-txt");

//Prevent form from submiting when it's button its trigerred
form.addEventListener("submit", (e) => {
    e.preventDefault();
})

continueBtn.onclick = () => {
    //let's start an ajx request
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/signup.php", true);
    
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                const data = xhr.response;
                if(data == "success"){
                    location.href = "users.php";
                } else {
                    errorText.textContent = data;
                    errorText.style.display = "block";
                    
                }
            }
        }
    }

    // Sending the form data through ajax request
    let formData = new FormData(form);
    xhr.send(formData); // we must to do this to send through ajax because the xhr dont know what data have to sent



}