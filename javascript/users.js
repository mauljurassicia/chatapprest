const searchBar = document.querySelector(".users .search input");
const searchBtn = document.querySelector(".users .search button");
const addBtn = document.querySelector(".users .add-user .add");
const modalBack = document.querySelector(".users .modal-background");
const formModal = document.querySelector(".users .add-modal");
const form = document.querySelector(".add-form form");
const Btnsearch = document.querySelector(".add-form form button");
const imgSearch = document.querySelector(".user-found .content img");
const userFound = document.querySelector(".add-modal .user-found");
const userDoenstexist = document.querySelector(".add-modal .user-notfound");
const invalidInput = document.querySelector(".add-modal .input-invalid");
const Userfoundname = document.querySelector(".user-found .content span");
const addNewUser = document.querySelector(".users .add-user-btn button");
const userList = document.querySelector(".users .users-list");



let addedEmail = '';


form.addEventListener('submit', (e) => {
    e.preventDefault();
})

Btnsearch.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/getuser.php", true);
    let formData = new FormData(form);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var contentType = xhr.getResponseHeader('Content-Type');
                if (contentType && contentType.includes('application/json')) {
                    try {
                        var parsedData = JSON.parse(xhr.response);
                        userFound.classList.add("active");
                        invalidInput.classList.remove("active");
                        userDoenstexist.classList.remove("active");
                        // Access properties of the parsed object
                        imgSearch.setAttribute("src", `php/images/${parsedData.img}`);
                        Userfoundname.textContent = parsedData.name;
                        addedEmail = parsedData.email;
                        if (parsedData.saved) {
                            addNewUser.classList.add("saved");
                            addNewUser.innerHTML = '<i class="fas fa-check"></i>'
                        } else {
                            addNewUser.classList.remove('saved');
                            addNewUser.innerHTML = '<i class="fas fa-plus"></i>'
                        }
                    } catch (error) {
                        userFound.classList.remove('active');
                        userDoenstexist.classList.remove('active');
                        invalidInput.classList.add('active');
                        invalidInput.innerHTML = `<span>${error}</span>`
                    }
                } else {
                    userFound.classList.remove('active');
                    const data = xhr.response;
                    if (data == "User doesn't exist") {
                        invalidInput.classList.remove('active');
                        userDoenstexist.classList.add('active');
                    } else {
                        userDoenstexist.classList.remove('active');
                        invalidInput.classList.add('active');
                        invalidInput.innerHTML = `<span>${data}</span>`;
                    }
                }
            }
        }
    }

    xhr.send(formData);
}


addBtn.onclick = () => {
    modalBack.classList.add("active");
    formModal.classList.add("active");
    invalidInput.classList.remove("active");
    userDoenstexist.classList.remove('active');
    userFound.classList.remove("active");
}

modalBack.onclick = (event) => {
    if (!event.target.closest('.users .add-modal')) {
        formModal.classList.remove("active");
        setTimeout(() => modalBack.classList.remove("active"), 500);
    }
}
searchBtn.onclick = () => {
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active")
}

addNewUser.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", 'php/adduser.php');
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                if (xhr.response === 'success') {
                    addNewUser.classList.add("saved");
                    addNewUser.innerHTML = '<i class="fas fa-check"></i>'
                } else {
                    userFound.classList.remove('active');
                    userDoenstexist.classList.remove('active');
                    invalidInput.classList.add('active');
                    invalidInput.innerHTML = `<span>${xhr.response}</span>`;
                }
            }
        }
    }
    xhr.send("value=" + encodeURIComponent(addedEmail));
}



setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/users.php", true);

    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let listUser = "";
                var contentType = xhr.getResponseHeader('Content-Type');
                if (contentType && contentType.includes('application/json')) {
                    try {
                        const parsedUserArray = JSON.parse(xhr.response);
                        parsedUserArray.forEach(user => {

                            if(searchBar.value !== undefined && user.name.includes(searchBar.value)){

                                if(user.msg !== null){
                                    listUser += `<a href="chat.php?user_id=${user.unique_id}">
                                        <div class="content">
                                            <img src="php/images/${user.img}" alt="">
                                            <div class="details">
                                                <span>${user.name}</span>
                                                <p>${user.msg}</p>
                                            </div>
                                        </div>
                                        <div class="status-dot ${user.status !== 'Active now' ? 'offline' : ''}"><i class="fas fa-circle"></i></div>
                                    </a>`
                                } else {
                                    listUser += `<a href="chat.php?user_id=${user.unique_id}">
                                        <div class="content">
                                            <img src="php/images/${user.img}" alt="">
                                            <div class="details">
                                                <span>${user.name}</span>
                                                <p class="taller"></p>
                                            </div>
                                        </div>
                                        <div class="status-dot ${user.status !== 'Active now' ? 'offline' : ''}"><i class="fas fa-circle"></i></div>
                                    </a>`

                                }
                            }
                        });

                    } catch (error) {
                        listUser = '<div class="user-notavailable"><span>User is not available</span></div>'
                    }
                } else {
                    listUser = `<div class="user-notavailable"><span>User is not available</span></div>`
                }

                if(userList.innerHTML !== listUser){
                    userList.innerHTML = listUser;
                }
            }
        }
    }

    xhr.send();
}, 500);