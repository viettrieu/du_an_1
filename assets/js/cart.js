function displayCart() {
  let output = "";
  for (let i in cart) {
    let sum = cart[i].price * cart[i].quantity;
    output += `<tr class="cart-item" data-id="${cart[i].id}">
    <td class="product-thumbnail">
    <a href="./index.php?action=san-pham&id=${cart[i].id}">
        <img width="90" height="90" src="${cart[i].thumbnail}" />
      </a>
    </td>
    <td class="product-name">
      <a href="./index.php?action=san-pham&id=${cart[i].id}">${
      cart[i].title
    }</a>
    </td>
    <td class="product-price" data-title="Giá" data-price="${cart[i].price}">
      <span class="price">
        <span> ${formatCash(cart[i].price)}</span>
        <sup>đ</sup>
      </span>
    </td>
    <td class="product-quantity" data-title="Số lượng">
      <div class="quantity">
        <button class="minus-btn" type="button" name="button" onclick="buttonMinusPlus(this, -1)">
          -
        </button>
        <input type="text" name="quantity" value="${
          cart[i].quantity
        }" onchange="changeQuantity(this)" />
        <button class="plus-btn" type="button" name="button" onclick="buttonMinusPlus(this, +1)">
          +
        </button>
      </div>
    </td>
    <td class="product-subtotal" data-price="${cart[i].price}">
      <span class="price" style=" margin-left: auto; ">
        <span>${formatCash(sum)}</span>
        <sup>đ</sup>
      </span>
    </td>
    <td class="product-remove">
      <i class="far fa-times-circle remove" onclick="removeItemFromCartAll(this)"></i>
    </td>
  </tr>`;
  }
  document.getElementById("show-cart").innerHTML = output;
  if (cart.length == 0) {
    document.querySelector(".yproduct").style.display = "none";
    document.querySelector(".nproduct").style.display = "flex";
  }
  subTotal();
}
displayCart();

function removeItemFromCartAll(e) {
  let wrapProduct = e.closest("tr");
  let productId = wrapProduct.getAttribute("data-id");
  let postForm = {
    action: "remove_the_cart",
    productId,
  };
  $.ajax({
    type: "POST",
    url: "./ajax.php",
    data: postForm,
    dataType: "json",
    success: function (data) {
      cart = data;
      wrapProduct.classList.add("remove");
      setTimeout(() => wrapProduct.remove(), 500);
      setTimeout(() => {
        if (cart.length == 0) {
          document.querySelector(".yproduct").style.display = "none";
          document.querySelector(".nproduct").style.display = "flex";
        }
      }, 500);
      subTotal();
      getCount();
    },
  });
}
function subTotal() {
  let sum = cart.reduce((sum, item) => sum + item.quantity * item.price, 0);
  document.querySelector(".subtotal").innerHTML = formatCash(sum);
  document.querySelector(".total").innerHTML = formatCash(sum);
}
function setCountForItem(name, count) {
  for (let i in cart) {
    if (cart[i].name === name) {
      cart[i].count = count;
      break;
    }
  }
}
function changeQuantity(e) {
  let wrapProduct = e.closest("tr");
  var input = wrapProduct.querySelector("input[name=quantity]");
  var value = parseInt(e.value);
  if (value < 1) {
    value = 1;
  } else if (value > 99) {
    value = 99;
  }
  e.value = value;
  var getPrice = wrapProduct
    .querySelector(".product-subtotal")
    .getAttribute("data-price");
  let productId = wrapProduct.getAttribute("data-id");
  let postForm = {
    action: "change_uantity",
    productId,
    quantity: value,
  };
  let setPrice = wrapProduct.querySelector(".product-subtotal .price span");
  $.ajax({
    type: "POST",
    url: "./ajax.php",
    data: postForm,
    dataType: "json",
    success: function (data) {
      cart = data;
      let sum = value * getPrice;
      setPrice.innerHTML = formatCash(String(sum));
      subTotal();
      getCount();
    },
  });
}
function buttonMinusPlus(e, number) {
  let wrapProduct = e.closest("tr");
  var button = e.closest("div").querySelectorAll("button");
  button[0].disabled = true;
  button[1].disabled = true;
  var input = e.closest("div").querySelector("input");
  var value = parseInt(input.value);
  if (value <= 1 && number == -1) {
    value = 1;
  } else if (value >= 99 && number == +1) {
    value = 99;
  } else {
    value += number;
  }
  input.value = value;
  var getPrice = wrapProduct
    .querySelector(".product-subtotal")
    .getAttribute("data-price");
  let productId = wrapProduct.getAttribute("data-id");
  let postForm = {
    action: "change_uantity",
    productId,
    quantity: value,
  };
  let setPrice = wrapProduct.querySelector(".product-subtotal .price span");
  $.ajax({
    type: "POST",
    url: "./ajax.php",
    data: postForm,
    dataType: "json",
    success: function (data) {
      cart = data;
      let sum = value * getPrice;
      setPrice.innerHTML = formatCash(String(sum));
      subTotal();
      getCount();
      button[0].disabled = false;
      button[1].disabled = false;
    },
  });
}
