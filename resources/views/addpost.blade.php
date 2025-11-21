<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>All Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-8 bg-primary text-white mb-4">
                <h1>Create Post</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <form id="addForm">
                    @csrf
                    <input type="text" id="title" class="form-control mb-3" placeholder="Enter Title">
                    <textarea id="description" class="form-control mb-3" placeholder="Enter Description"></textarea>
                    <input type="file" id="image" class="form-control mb-3">
                    <input type="submit" class="btn btn-primary">
                    <a href="/allposts" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-1X5g3yA0YxeXZ2nGsxkk0aNVG8D5ExSRr" crossorigin="anonymous"></script>
    <script>
        var addForm = document.querySelector("#addForm");
        addForm.onsubmit = async (e) => {
            e.preventDefault();
            const token = localStorage.getItem('api_token');

            const title = document.querySelector("#title").value;
            const description = document.querySelector("#description").value;
            const image = document.querySelector("#image").files[0];

            var formData = new FormData();

            formData.append('title', title);
            formData.append('description', description);
            formData.append('image', image);

            let response = await fetch('/api/posts', {
                    method: 'POST',
                    body: formData,
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
