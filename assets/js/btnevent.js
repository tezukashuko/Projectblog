function addevent() {

    //tìm class để lấy id từng thằng, tiện để update qua nhiều post cùng 1 page
    let likebtns = document.getElementsByClassName('likebtn');
    for (const btn of likebtns) {
        console.log(btn.id);
        let likebtn = document.getElementById(btn.id);
        likebtn.addEventListener('click', function () {
            let str = this.id.split('_');
            likequery(parseInt(str[1]));
        })

    }

    let dltbtns = document.getElementsByClassName('dltbtn');
    for (const btn of dltbtns) {
        console.log(btn.id);
        let dltbtn = document.getElementById(btn.id);
        dltbtn.addEventListener('click', function () {
            console.log('delete');
            let str = this.id.split('_');
            let img_path = document.getElementById('img_' + str[1]).src;
            dltquery(parseInt(str[1]), img_path);
        })
    }
    let edtbtns = document.getElementsByClassName('edtbtn');
    for (const btn of edtbtns) {
        console.log(btn.id);
        let str = btn.id.split('_');
        let eltbtn = document.getElementById(btn.id);
        eltbtn.addEventListener('click', function () {
            console.log('edtbtn');
            document.getElementById("edtfrm_" + str[1]).style.display = "block";
            document.getElementById("body_" + str[1]).style.display = "none";
        })
        let cancelbtn = document.getElementById("cancel_" + str[1]);
        cancelbtn.addEventListener('click', function (event) {
            event.preventDefault();
            document.getElementById("edtfrm_" + str[1]).style.display = "none";
            document.getElementById("body_" + str[1]).style.display = "unset";
        })
    }

    let edtform = document.getElementsByClassName('edtform');
    for (const form of edtform) {
        console.log(form.id);
        let formedit = document.getElementById(form.id);
        formedit.addEventListener('submit', function (event) {
            event.preventDefault();
            console.log('submit');
            let str = this.id.split('_');

            let file = document.querySelector('[name=p-img]').files;
            let previousimg = document.getElementById('img_' + str[1]).src.split('/');
            $title = document.querySelector('[name=ptitle]').value
            if ($title == '') {
                document.getElementById('errortitle').innerText = 'Your post title is empty'
            }
            else {
                document.getElementById('errortitle').innerText = ''
                let formdata = new FormData();
                if (file.length != 0) {
                    formdata.append('p-img', file[0])
                }
                else {
                    formdata.append('p-img', file)
                }
                formdata.append('editing', '');
                formdata.append('ptitle', $title);
                formdata.append('img_previous', previousimg[previousimg.length - 1]);
                formdata.append('pbody', document.querySelector('[name=pbody]').value);
                formdata.append('post_id', parseInt(str[1]));
                console.log(formdata);

                //console.log(file);

                editPost(formdata, document.querySelector('[name=ptitle]').value, document.querySelector('[name=pbody]').value);
            }

        })
    }

    let commentform = document.getElementsByClassName('commentform');
    for (const form of commentform) {
        console.log(form.id);
        let formcomm = document.getElementById(form.id);
        formcomm.addEventListener('submit', function (event) {
            event.preventDefault();
            console.log('comment');
            let str = this.id.split('_');
            console.log(str[1]);
            let comment = document.querySelector('[name=comment]');
            if (comment.value == '') {
                document.getElementById('errorcomment').innerText = 'Your comment is empty'
            }
            else {
                document.getElementById('errorcomment').innerText = '';
                addComment(comment.value, str[1]);
                comment.value= '';
            }
        })
    }

    //chưa tối ưu cho nhiều post 1 page
    document.getElementById('commentbtn').addEventListener("click",function () { 
        let cmtform = document.getElementsByClassName('commentform')[0];
        if (cmtform.style.display == 'none'){
            cmtform.style.display = 'block';
            cmtform.style.opacity = 1;
        }else{
            cmtform.style.display = 'none'
            cmtform.style.opacity = 0;
        }
    })
}


function editPost(formdata, title, body) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./func/post_edit.php", true);
    // to use the post method we must set the request headers
    // depending on the form data being sent
    xhr.onload = function () {
        if (this.status == 200) {
            console.log(this.responseText);
            if (this.responseText == '') editPostwithoutImg(title, body);
            location.reload()
        }
    }
    xhr.send(formdata);
}
function editPostwithoutImg(title, body) {
    console.log('withoutimg');
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./func/post_edit.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (this.status == 200) {
            console.log(this.responseText);
            location.reload();
            //location.reload()
        }
    }
    xhr.send(`ptitle=${title}&pbody=${body}`);
}
function likecount(id) {
    let xhr = new XMLHttpRequest();

    xhr.open("get", `./getpost.php?likec=&post_id=${id}`, true);
    // to use the post method we must set the request headers
    // depending on the form data being sent
    //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (this.status == 200) {
            console.log(this.responseText);
            let likec = document.getElementById('likec_' + id);
            likec.innerText = this.responseText;

        }
    }

    xhr.send();
}

function likequery(id) {
    let xhr = new XMLHttpRequest();

    xhr.open("get", `./getpost.php?like=&post_id=${id}`, true);
    // to use the post method we must set the request headers
    // depending on the form data being sent
    //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (this.status == 200) {
            console.log(this.responseText);
            let likec = document.getElementById('likec_' + id);
            likec.innerText = this.responseText;

        }
    }

    xhr.send();
}

function dltquery(id, path) {
    let xhr = new XMLHttpRequest();

    xhr.open("get", `./getpost.php?dlt=&post_id=${id}&path=${path}`, true);
    // to use the post method we must set the request headers
    // depending on the form data being sent
    //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (this.status == 200) {
            console.log(this.responseText);
            location.reload();
        }
    }

    xhr.send();
}
function addComment(comment, postid) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./getpost.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // to use the post method we must set the request headers
    // depending on the form data being sent
    xhr.onload = function () {
        if (this.status == 200) {
            // console.log(this.responseText);
            let arr = JSON.parse(this.response)
            console.log(arr);
            outputComment(arr, postid);
        }
    }
    xhr.send(`addcomment=&content=${comment}&post_id=${postid}`);
}

function processCMT() {
    let commentdiv = document.getElementsByClassName('comment');
    let id = document.getElementsByClassName('comment')[0].id.split('_')[1];
    let xhr = new XMLHttpRequest();
    xhr.open("get", `./getpost.php?getcmt=&post_id=${id}`, true);
    // to use the post method we must set the request headers
    // depending on the form data being sent
    //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (this.status == 200) {
            if (this.responseText == '0') {
                return;
            }
            else {
                let arr = JSON.parse(this.response)
                console.log(arr);
                outputComment(arr, id);

            }
        }
    }

    xhr.send();

}
function outputComment(arr, post_id) {
    arr.forEach(comm => {
        console.log(comm);
        let div = document.getElementById('commentdiv_' + post_id);
        let deletebtncmt = '';
        if (comm.themself == 1) {
            deletebtncmt = ` <i class="fa fa-2x fa-times-circle mx-2 my-1" id="commbtn_${comm.com_id}" aria-hidden="true"></i>`;
        }
        let cmtcard = `<div class="card my-3 transitioncmt border border-primary" id="comm_${comm.com_id}" style="left: -100px;">
                    <span class="d-flex justify-content-between align-items-center">
                        <h5 class="card-header py-1">${comm.name}</h5> `
            + deletebtncmt +
            ` 
                    </span>
                    <div class="card-body py-1">
                        <p class="card-text">${comm.body}</p>
                    </div>
                    <div class="card-footer py-0">
                    <span>${comm.date_com}</span>
                    </div>
                </div>`
        div.insertAdjacentHTML('afterbegin', cmtcard);
        let cmtdiv = document.getElementById('comm_' + comm.com_id);
        cmtdiv.style.left = '0px';
        if (comm.themself == 1) {
            processDLTcmt(comm.com_id);
        }
    });
}
function processDLTcmt(com_id) {
    let dltbtn = document.getElementById('commbtn_' + com_id);
    console.log(dltbtn);
    dltbtn.addEventListener('click', function () {
        let cmtdiv = document.getElementById('comm_' + com_id);
        cmtdiv.style.opacity = '0';
        setTimeout(() => {
            cmtdiv.remove();
        }, 500);
        dltCMT(com_id);
    })
}
function dltCMT(com_id) {
    let xhr = new XMLHttpRequest();
    xhr.open("get", `./getpost.php?dltcmt=&com_id=${com_id}`, true);
    // to use the post method we must set the request headers
    // depending on the form data being sent
    //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
        if (this.status == 200) {
            console.log("delete comment");
        }
    }
    xhr.send();
}
