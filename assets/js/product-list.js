const categories = document.querySelector(".categories");
const itemsDiv = document.querySelector(".items ul");

categories.addEventListener("click", (event) => {
  const target = event.target;
  if (target.tagName !== "LI") {
    return;
  }
  target.parentNode.childNodes.forEach((li) => {
    li.classList = "";
  });
  target.classList = "active";
  const categoryId = target.dataset.categoryId;
  updateItems(categoryId);
});

function updateItems(categoryId) {
  fetch(`api/update-category.php?category_id=${categoryId}`)
    .then((response) => response.json())
    .then((data) => {
      // 更新商品列表
      renderItems(data);
    });
}

function renderItems(items) {
  const html = items
    .map((item) => {
      return `
      <li>
				<a href="product.php?id=${item.id}">
					<img src="${item.image_path}" alt="${item.name}" />
					<h3>${item.name}</h3>
					<p class="price">¥${item.price}</p>
				</a>
      </li>
    `;
    })
    .join("");
  itemsDiv.innerHTML = html;
}

// 加载第一个分类的商品
document.querySelector(".categories li").classList = "active";
updateItems(1);
