function displayCart() {
  let output = "";
  for (let i in cart) {
    let sum = cart[i].price * cart[i].quantity;
    output += `<tr class="cart-item" data-id="${cart[i].id}">
    <td class="product-thumbnail">
    <a href="${SITE_URL}/store/product/${cart[i].id}">
        <img width="90" height="90" src="${SITE_URL}/${cart[i].thumbnail}" />
      </a>
    </td>
    <td class="product-name">
      <a href="${SITE_URL}/store/product/${cart[i].id}">${cart[i].title}</a>
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
  let subTotal = getSubTotal();
  let discount = getDiscount(subTotal);
  let total = getTotal(subTotal, discount);
  document.querySelector(".subtotal").innerHTML = formatCash(subTotal);
  document.querySelector(".total").innerHTML = formatCash(total);
  $(".cart-subtotal").after(showCoupon(discount));
}
displayCart();

function removeItemFromCartAll(e) {
  let wrapProduct = e.closest("tr");
  let productId = wrapProduct.getAttribute("data-id");
  let postForm = {
    productId,
  };
  $.ajax({
    type: "POST",
    url: SITE_URL + "/cart/removeTheCart",
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
      let subTotal = getSubTotal();
      let discount = getDiscount(subTotal);
      let total = getTotal(subTotal, discount);
      document.querySelector(".subtotal").innerHTML = formatCash(subTotal);
      document.querySelector(".total").innerHTML = formatCash(total);
      if ($(".discount").length > 0) {
        $(".discount").html(formatCash(discount));
      }
      getCount();
    },
  });
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
    url: SITE_URL + "/cart/changeQuantity",
    data: postForm,
    dataType: "json",
    success: function (data) {
      cart = data;
      let sum = value * getPrice;
      setPrice.innerHTML = formatCash(String(sum));
      let subTotal = getSubTotal();
      let discount = getDiscount(subTotal);
      let total = getTotal(subTotal, discount);
      document.querySelector(".subtotal").innerHTML = formatCash(subTotal);
      document.querySelector(".total").innerHTML = formatCash(total);
      if ($(".discount").length > 0) {
        $(".discount").html(formatCash(discount));
      }
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
    url: SITE_URL + "/cart/changeQuantity",
    data: postForm,
    dataType: "json",
    success: function (data) {
      cart = data;
      let sum = value * getPrice;
      setPrice.innerHTML = formatCash(String(sum));
      let subTotal = getSubTotal();
      let discount = getDiscount(subTotal);
      let total = getTotal(subTotal, discount);
      document.querySelector(".subtotal").innerHTML = formatCash(subTotal);
      document.querySelector(".total").innerHTML = formatCash(total);
      if ($(".discount").length > 0) {
        $(".discount").html(formatCash(discount));
      }
      getCount();
      button[0].disabled = false;
      button[1].disabled = false;
    },
  });
}
$("#add_coupon").submit(function (e) {
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
    url: SITE_URL + "/cart/checkcoupon",
    type: "POST",
    data: formData,
    dataType: "JSON",
    success: function (data) {
      console.log(data);
      $("#add_coupon")[0].reset();
      coupon = data["coupon"];
      let subTotal = getSubTotal();
      let discount = getDiscount(subTotal);
      let total = getTotal(subTotal, discount);
      let info = data["info"][0];
      let status = info["status"] == "ERROR" ? "alert-danger" : "alert-success";
      let alert = `<div class="alert ${status} alert-dismissible fade show" role="alert">
      ${info["message"]}
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">×</span>
     </button>
   </div>`;
      $("#info").html(alert);
      if (info["status"] == "OK") {
        $(".cart-subtotal").after(showCoupon(discount));
        document.querySelector(".total").innerHTML = formatCash(total);
      }
    },
    cache: false,
    contentType: false,
    processData: false,
  });
});
