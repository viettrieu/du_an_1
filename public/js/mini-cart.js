let miniCartTotal = document.querySelector(".mini-cart-total");
let noProduct = `<li class="mini-cart-item" style=" color: var(--primary-color); ">Không có sản phẩm nào trong giỏ</li>`;
function displayMiniCart() {
  let output = "";
  for (let i in cart) {
    output += `
    <li class="mini-cart-item" data-id="${cart[i].id}">
      <i class="far fa-times-circle remove" onclick="removeItem(this)" data-id="${
        cart[i].id
      }"></i>
      <a href="${SITE_URL}/store/product/${
      cart[i].id
    }" class="product-thumbnail">
        <img src="${SITE_URL + cart[i].thumbnail}" />
      </a>
      <div class="text">
        <a href="${SITE_URL}/store/product/${cart[i].id}" class="product-name">
          ${cart[i].title}
        </a>
        <p>
          <strong class="product-quantity">${cart[i].quantity} ×</strong>
          <span class="price-mini-cart">
            <span class="unit-price">${formatCash(cart[i].price)}</span>
            <sup>đ</sup>
          </span>
        </p>
      </div>
  </li>
  `;
  }
  if (cart.length == 0) {
    output = noProduct;
    miniCartTotal.style.display = "none";
  } else {
    miniCartTotal.style.display = "block";
  }
  document.getElementById("mini-cart").innerHTML = output;
  subTotalMiniCart();
}
displayMiniCart();
function subTotalMiniCart() {
  let sum = cart.reduce((sum, item) => sum + item.quantity * item.price, 0);
  document.querySelector(".cart-side .total").innerHTML = formatCash(sum);
}
function removeItem(e) {
  let wrapProduct = e.closest("li");
  let productId = wrapProduct.getAttribute("data-id");
  var postForm = {
    productId,
  };
  $.ajax({
    //Process the form using $.ajax()
    type: "POST", //Method type
    url: SITE_URL + "/cart/removeTheCart", //Your form processing file URL
    data: postForm, //Forms name
    dataType: "json",
    success: function (data) {
      cart = data;
      console.table(cart);
      wrapProduct.classList.add("remove");
      setTimeout(() => wrapProduct.remove(), 500);
      if (cart.length == 0) {
        setTimeout(() => {
          document.getElementById("mini-cart").innerHTML = noProduct;
          miniCartTotal.style.display = "none";
        }, 500);
      }
      subTotalMiniCart();
      getCount();
    },
  });
}

let cartSide = document.querySelector(".cart-side");
document.querySelector(".mini-cart").addEventListener("click", function (e) {
  e.preventDefault();
  cartSide.classList.add("active");
});
function closeCartSide() {
  cartSide.classList.remove("active");
}
document
  .querySelector(".close-cart-side")
  .addEventListener("click", closeCartSide);
document
  .querySelector(".cart-side-overlay")
  .addEventListener("click", closeCartSide);
