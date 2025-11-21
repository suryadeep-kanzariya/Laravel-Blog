<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>All Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-light bg-primary p-3">
        <span class="navbar-brand mb-0 h1 text-white">All Posts</span>
        <a id="logoutbutton" class="btn btn-danger">Logout</a>
    </nav>

    <div class="container mt-4">

        <div class="d-flex justify-content-end mb-3">
            <a href="/addpost" class="btn btn-primary">Add New</a>
        </div>
        <div id="postContainer">

        </div>

    </div>

    <!--singlePostModal -->
    <div class="modal fade" id="singlePostModal" tabindex="-1" aria-labelledby="singlePostLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="singlePostLabel">Single Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!--Update PostModal -->
    <div class="modal fade" id="updatePostModal" tabindex="-1" aria-labelledby="updatePostLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="updatePostLabel">Update Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateform">
                    <div class="modal-body">
                        <input type="hidden" id="postid" class="form-control" value="">
                        <b>Title</b><input type="text" id="posttitle" class="form-control" value="">
                        <b>Description</b><input type="text" id="postdescription" class="form-control"
                            value="">
                        <img id="previewimage" width="150px">
                        <p>Upload Image</p><input type="file" id="imageinput" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" value="Save" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        document.querySelector("#logoutbutton").addEventListener('click', function() {
            const token = localStorage.getItem('api_token');

            fetch('/api/logout', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    window.location.href = "/login";
                });
        });

        function loadData() {
            const token = localStorage.getItem('api_token');


            fetch('/api/posts', {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                })
                .then(response => response.json())
                .then(data => {
                   // console.log(data.data.posts);
                    var allpost = data.data.posts;
                    const postContainer = document.querySelector("#postContainer");
                    var tabledata = `<table class="table table-bordered text-center">
                
                    <tr class="table-dark">
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>View</th>
                        <th>Update</th>
                        <th>Delete</th>
                    </tr>`;

                    allpost.forEach(post => {
                        tabledata += `<tr>
                              <td><img src="/uploads/${post.image}" width="100px" /></td>
    <td>
        <h6>${post.title}</h6>
    </td>
    <td>
        <p>
            ${post.description}
        </p>
    </td>

    
       <td><button type="button" class="btn btn-sm btn-primary" data-bs-postid="${post.id}" data-bs-toggle="modal" data-bs-target="#singlePostModal"> View</button></td>    
       <td><button type="button" class="btn btn-sm btn-success" data-bs-postid="${post.id}" data-bs-toggle="modal" data-bs-target="#updatePostModal">Update</button></td>
       <td><button  onclick="deletePost(${post.id})"  class="btn btn-sm btn-danger" >Delete</button></td>
         </tr>`
                    });
                    tabledata += `</table>`;

                    postContainer.innerHTML = tabledata;

                });
        }
        loadData();

        var singlemodel = document.querySelector("#singlePostModal")
        if (singlemodel) {
            singlemodel.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget
                const id = button.getAttribute('data-bs-postid')
                const token = localStorage.getItem('api_token');
                fetch(`/api/posts/${id}`, {
                        method: 'GET',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        const post = data.data.post[0];
                        const modalBody = document.querySelector("#singlePostModal .modal-body");

                        modalBody.innerHTML = "";

                        modalBody.innerHTML =

                            `<div class="card border-0 shadow-sm p-3">
                            <div class="text-center mb-3">
                                <img src="http://localhost:8000/uploads/${post.image}" alt="Post Image"style="width: 200px; border-radius: 12px;">
                            </div>

                            <h4 class="fw-bold text-dark mb-2 text-center">
                               ${post.title}
                            </h4>

                            <p class="text-muted text-center" style="font-size: 15px;">
                               ${post.description}
                            </p>
                        </div> `;

                    });

            })
        }
        //update modal post
        var updatemodel = document.querySelector("#updatePostModal")
        if (updatemodel) {
            updatemodel.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget
                const id = button.getAttribute('data-bs-postid')
                const token = localStorage.getItem('api_token');
                fetch(`/api/posts/${id}`, {
                        method: 'GET',
                        headers: {
                            'Authorization': `Bearer ${token}`,
                            'content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        const post = data.data.post[0];

                        document.querySelector("#postid").value = post.id;
                        document.querySelector("#posttitle").value = post.title;
                        document.querySelector("#postdescription").value = post.description;
                        document.querySelector("#previewimage").src = `/uploads/${post.image}`;

                    });

            })
        }

        //update post
        var updateform = document.querySelector("#updateform");
        updateform.onsubmit = async (e) => {
            e.preventDefault();
            const token = localStorage.getItem('api_token');

            const postid = document.querySelector("#postid").value;
            const title = document.querySelector("#posttitle").value;
            const description = document.querySelector("#postdescription").value;



            var formData = new FormData();

            formData.append('id', postid);
            formData.append('title', title);
            formData.append('description', description);

            if (document.querySelector("#imageinput").files[0]) {

                const image = document.querySelector("#imageinput").files[0];
                formData.append('image', image);
            }

            let response = await fetch(`/api/posts/${postid}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'X-HTTP-Method-Override': 'PUT'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                   window.location.href = "/allposts";
                   
                });
        }

        //Delete Post

        async function deletePost(postid) {
            const token = localStorage.getItem('api_token');

            let response = await fetch(`/api/posts/${postid}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    window.location.href = "/allposts";
                });
        }
    </script>
</body>

</html>
