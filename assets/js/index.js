// 获取轮播图的所有图片
const images = document.querySelectorAll("#carousel img");

// 定义当前激活的图片的索引
let currentIndex = 0;

// 定义轮播图的定时器
let timer;

// 启动轮播图
startCarousel();

// 开始轮播图
function startCarousel() {
  // 清除之前的定时器
  clearInterval(timer);

  // 设置新的定时器
  timer = setInterval(() => {
    // 将当前激活的图片的类名移除
    images[currentIndex].classList.remove("active");

    // 更新当前激活的图片的索引
    currentIndex = (currentIndex + 1) % images.length;

    // 将新的图片设为激活状态
    images[currentIndex].classList.add("active");
  }, 3000);
}

// 获取翻页按钮
const prevButton = document.querySelector("#prev-page");
const nextButton = document.querySelector("#next-page");

// 获取当前的页码
let currentPage = 1;

function sendRequest(page) {
  // 发送AJAX请求，获取下一页的内容
  fetch(`api/promotion-page.php?page=${page}`)
    .then((response) => response.json())
    .then((data) => {
      // 更新页面
      updatePage(data);
    });
}

// 给翻页按钮添加点击事件
prevButton.addEventListener("click", () => {
  sendRequest(currentPage - 1);
});

nextButton.addEventListener("click", () => {
  sendRequest(currentPage + 1);
});

// 更新页面
function updatePage(data) {
  // 更新页码
  currentPage = data.page;

  // 更新优惠公告列表
  const promotionsList = document.querySelector("#promotions ul");
  promotionsList.innerHTML = "";
  data.promotions.forEach((promotion) => {
    const li = document.createElement("li");
    li.innerHTML = `
      <h3>${promotion.title}</h3>
      <p>${promotion.description}</p>
      <p>${promotion.start_date}</p>
    `;
    promotionsList.appendChild(li);
  });

  // 更新翻页按钮的状态
  prevButton.disabled = currentPage === 1;
  nextButton.disabled = currentPage === data.totalPages;
}

sendRequest(1);
