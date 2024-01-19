<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagination Example</title>
    <style>
        ul.pagination {
            display: flex;
            list-style: none;
            padding: 0;
        }

        ul.pagination li {
            margin-right: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div id="content"></div>
<ul class="pagination" id="pagination"></ul>

<script>
    // Sample data (you can replace this with your data)
    const data = Array.from({ length: 50 }, (_, i) => `Item ${i + 1}`);

    // Items per page
    const itemsPerPage = 10;

    // Calculate total number of pages
    const totalPages = Math.ceil(data.length / itemsPerPage);

    // Display the first page by default
    displayPage(1);

    // Generate pagination links
    const paginationElement = document.getElementById("pagination");
    for (let i = 1; i <= totalPages; i++) {
        const li = document.createElement("li");
        li.textContent = i;
        li.addEventListener("click", () => displayPage(i));
        paginationElement.appendChild(li);
    }

    function displayPage(pageNumber) {
        const contentElement = document.getElementById("content");

        // Calculate start and end indices for the current page
        const startIndex = (pageNumber - 1) * itemsPerPage;
        const endIndex = pageNumber * itemsPerPage;

        // Extract items for the current page
        const currentPageItems = data.slice(startIndex, endIndex);

        // Display items in the content element
        contentElement.innerHTML = currentPageItems.map(item => `<p>${item}</p>`).join("");

        // Highlight the current page in the pagination links
        const paginationLinks = document.querySelectorAll("#pagination li");
        paginationLinks.forEach((link, index) => {
            link.style.fontWeight = index + 1 === pageNumber ? "bold" : "normal";
        });
    }
</script>

</body>
</html> -->


<?php
if (isset($_POST["validate"])) {
    echo "efef";
    var_dump($_FILES);
}



$params['image'] = false;


var_dump( $params['image']);

?>


<h2>Paramètres de profil</h2>
  
  <div class="avatar-section">
    <div class="avatar">
      <!-- <img src="https://images.pexels.com/users/avatars/907968517/marius-mbl91-994.jpg?auto=compress&fit=crop&h=130&w=130&dpr=1" alt="marius. mbl91" id="previewImage"> -->
      <img src=""  alt="marius. mbl91" id="previewImage">
    </div>
    <label for="changeImage" class="avatar-button">

    <form action="" id="myForm" method="post" enctype="multipart/form-data">
      <input name="controller" value="utilisateur" hidden>
      <input name="action" value="change_image" hidden>
      <input type="file" id="changeImage" name="images" accept="image/jpg, image/jpeg, image/png" >
      <input type="submit" name="validate">
    </form>


    </label>
  </div>


