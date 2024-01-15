<!DOCTYPE html>
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
</html>