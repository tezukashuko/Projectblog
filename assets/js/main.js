console.log('script loaded');
//let lated_posts = document.getElementById('lastedpost');
// async function display() {
//   let posts = await getPosts('date_create desc', '2', '0');
//   return posts;
// }
// console.log(display());


let offset = 0
let limit = 2
getPosts('date_create desc', limit, offset, "lastedpost");
document.getElementById('loadmore').addEventListener('click', function () {
  console.log("click");
  offset += limit;
  getPosts('date_create desc', limit, offset, "lastedpost");
})


function getPosts(orderby, limit, offset, id) {
  let xhr = new XMLHttpRequest();
  xhr.open("get", `./getpost.php?orderby=${orderby}&limit=${limit}&offset=${offset}&getposts=`, true);
  // to use the post method we must set the request headers
  // depending on the form data being sent
  //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.status == 200) {
      console.log(this.responseText);
      if (this.response == 0) {
        document.getElementById('loadmore').style.visibility = 'hidden';
        return;
      }

      let json = JSON.parse(this.response);


      output(json, id);
    }
  }

  xhr.send();
}
function output(posts, id) {
  let lated_posts = document.getElementById(id);
  console.log(posts);
  let lastedpost = '';
  posts.forEach(post => {
    lastedpost += `<div class="col-lg-6 col-md-6 my-md-3 mt-sm-4 mt-5 item">
    <div class="card h-100">
        <div class="card-header p-0 position-relative h-75">
            <a href="post.php?post_id=${post.id}">
                <img class="card-img-bottom d-block radius-image-full h-100 img_object" src="${post.post_img}" alt="./assets/post_img/post_default.png">
            </a>
        </div>
        <div class="card-body blog-details ">
            <a href="post.php?post_id=${post.id}" class="blog-desc">${post.title}
            </a>
            <p>${post.body.slice(0, 50) + '...'}</p>
            <div class="author align-items-center mt-3 mb-1">
                <img src="${post.author_img}" alt="" class="img-fluid rounded-circle" />
                <ul class="blog-meta">
                    <li>
                        <a href="author.php?user_id=${post.author_id}">${post.name}</a>
                    </li>
                    <li class="meta-item blog-lesson">
                        <span class="meta-value"> ${post.date_create} </span>. <span class="meta-value ml-2">
                    </li>
                </ul>
            </div> 
            <div  style="display: flex;  justify-content: space-evenly;"class='mb-5 mt-1'>
                    <button type="button" id="likebtn_${post.id}" class="btn btn-primary likebtn"><span class="pr-1" id="likec_${post.id}">${likecount(post.id)}</span><i class="fa fa-thumbs-up" aria-hidden="true"></i>
                        Like</button>
                    <a name="" class="btn btn-secondary" href="post.php?post_id=${post.id}" role="button"><i class="fa fa-comment" aria-hidden="true"></i>
                    Comment</a>
                </div>
        </div>
    </div>
    </div>`
  });
  lated_posts.innerHTML += lastedpost;
  addevent();
}




// likebtn.addEventListener('click', function () {
//   console.log('clicked like');
// })


// let lasted = new Promise(function (myResolve, myReject) {

//   let posts = getPosts('date_create desc', '2', '0');
//   myResolve(posts);
// });

// lasted.then(
//   function (posts) {
//     console.log(posts);
//     let lastedpost = '';
//     posts.forEach(post => {
//       lastedpost += `<div class="col-lg-6 col-md-6 my-md-3 my-sm-5 my-4 item">
//     <div class="card">
//         <div class="card-header p-0 position-relative">
//             <a href="post.php?post_id=${post.id}">
//                 <img class="card-img-bottom d-block radius-image-full" src="${post.post_img}" alt="./assets/post_img/post_default.png">
//             </a>
//         </div>
//         <div class="card-body blog-details">
//             <a href="post.php?post_id=${post.id}" class="blog-desc">${post.title}
//             </a>
//             <p>${post.body}</p>
//             <div class="author align-items-center mt-3 mb-1">
//                 <img src="${post.author_img}" alt="" class="img-fluid rounded-circle" />
//                 <ul class="blog-meta">
//                     <li>
//                         <a href="author.php?${post.author_id}">Charlotte mia</a> </a>
//                     </li>
//                     <li class="meta-item blog-lesson">
//                         <span class="meta-value"> ${post.date_create} </span>. <span class="meta-value ml-2"><span class="fa fa-clock-o"></span> 1
//                             min</span>
//                     </li>
//                 </ul>
//             </div>
//         </div>
//     </div>
//   </div>`
//     });

//     lated_posts.innerHTML(lastedpost);
//   },
//   function (error) { }
// );
// let posts = getPosts('date_create desc', '2', '0');
