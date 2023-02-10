// 加载模块
function loadModule(name) {
  // 发送AJAX请求
  fetch(`${name}.php`)
    .then((response) => response.text())
    .then((html) => {
      // 更新右侧的内容
      document.querySelector(".module").innerHTML = html;
      name === "orders" ? order_init() : product_init();
    });
}

document.querySelector(".sidebar").addEventListener("click", (e) => {
  if (e.target.tagName === "A") {
    e.target.parentElement.parentElement.querySelector(".active").className =
      "";
    e.target.className = "active";
    loadModule(e.target.dataset.module);
  }
});

// 默认加载商品管理模块
loadModule("products");

function order_init() {
  let select_list = document.querySelectorAll("select");
  for (let index = 0; index < select_list.length; index++) {
    const select = select_list[index];
    let status = select.dataset.status;
    select.querySelector(`[value='${status}']`).selected = true;
    select.addEventListener("change", function () {
      let o_id = this.dataset.id;
      let s_id = this.value;
      fetch(`api/update-order.php?o_id=${o_id}&s_id=${s_id}`);
    });
  }
}

function product_init() {
  // 在每个编辑按钮上监听点击事件
  document.querySelectorAll(".edit-button").forEach((button) => {
    button.addEventListener("click", (event) => {
      // 获取编辑按钮的父元素
      const parent = event.target.parentNode;
      // 获取表单
      const form = parent.querySelector("form");
      let display = form.style.display;
      form.style.display = display === "block" ? "none" : "block";
    });
  });
}
