// 获取导航栏和表单容器
let navbar = document.getElementById("navbar");
let formContainers = document.getElementsByClassName("form-container");

// 给导航栏中的每个链接添加点击事件
navbar.addEventListener("click", function (event) {
  if (event.target.tagName === "A") {
    // 获取点击的链接
    let activeLink = event.target;
    // 获取点击的链接的锚点
    let anchor = activeLink.getAttribute("href");
    // 获取对应的表单容器
    let activeContainer = document.querySelector(anchor);

    // 隐藏所有表单容器
    for (let i = 0; i < formContainers.length; i++) {
      formContainers[i].classList.remove("active");
    }
    // 显示点击的表单容器
    activeContainer.classList.add("active");

    // 移除导航栏中的所有活动状态
    let activeLinks = navbar.getElementsByClassName("active");
    for (let i = 0; i < activeLinks.length; i++) {
      activeLinks[i].classList.remove("active");
    }
    // 为点击的链接添加活动状态
    activeLink.classList.add("active");
  }
});
