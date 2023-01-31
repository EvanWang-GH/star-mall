const totalPriceElement = document.querySelector("#total-price");

// 获取页面中的所有数量输入框
const quantityInputs = document.querySelectorAll(".quantity input");

// 为每个数量输入框添加change事件
quantityInputs.forEach((input) => {
  input.addEventListener("change", updateQuantity);
});

function updateQuantity(event) {
  // 获取当前输入框
  const input = event.target;
  // 获取当前输入框的值
  const quantity = input.value;
  // 获取当前输入框的父元素的父元素（tr）
  const parent = input.parentElement.parentElement;
  // 获取当前输入框对应的商品id
  const itemId = parent.dataset.itemId;

  // 发送AJAX请求，更新购物车数量
  fetch(`api/user/update-cart.php?itemId=${itemId}&quantity=${quantity}`)
    .then((response) => response.json())
    .then((data) => {
      // 更新小计和总价
      updateTotalPrice(data);
    });
}

function updateTotalPrice(data) {
  // 遍历每个商品，计算小计
  data.forEach((item) => {
    const parent = document.querySelector(`[data-item-id="${item.id}"]`);
    const subtotalElement = parent.querySelector(".subtotal");
    const subtotal = item.price * item.quantity;
    subtotalElement.textContent = `¥${ceil(subtotal)}`;
  });

  // 计算总价
  let totalPrice = 0;
  data.forEach((item) => {
    totalPrice += item.price * item.quantity;
  });
  totalPriceElement.textContent = ceil(totalPrice);
}

function ceil(n) {
  return Math.ceil(n * 100) / 100;
}

// 获取页面中的所有删除按钮
const delButtons = document.querySelectorAll(".delete");

// 为每个删除按钮添加click事件
delButtons.forEach((btn) => {
  btn.addEventListener("click", deleteItem);
});

function deleteItem() {
  // 获取当前输入框的父元素的父元素（tr）
  const parent = this.parentElement.parentElement;
  // 获取当前删除按钮对应的商品id
  const itemId = parent.dataset.itemId;
  fetch(`api/user/delete-from-cart.php?itemId=${itemId}`)
    .then((response) => response.json())
    .then((data) => {
      this.parentElement.parentElement.remove();
      totalPriceElement.textContent = data[0];
    });
}
