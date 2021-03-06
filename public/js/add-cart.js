let addCart = document.querySelectorAll(".add-the-cart a");

// for (let i = 0; i < addCart.length; i++) {
$("body").on("click", ".add-the-cart a", function (e) {
  setTimeout(
    () => document.querySelector(".cart-side").classList.add("active"),
    1200
  );
  let quantity = document.getElementsByName("quantity")[0];
  quantity = quantity ? quantity.value : 1;
  e.preventDefault();
  let idProduct = this.getAttribute("data-id")
    ? this.getAttribute("data-id")
    : id;
  var postForm = {
    productId: idProduct,
    quantity,
  };
  $.ajax({
    type: "POST",
    url: SITE_URL + "/cart/addTheCarts",
    data: postForm,
    dataType: "json",
    success: function (data) {
      console.log(data);
      cart = data;
      getCount();
      displayMiniCart();
    },
  });
});
// }

function changeQuantity(e) {
  var value = parseInt(e.value);
  if (value < 1) {
    value = 1;
  } else if (value > 99) {
    value = 99;
  }
  console.log(value);
  e.value = value;
}
function buttonMinusPlus(e, number) {
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
}

$("body").on("click", ".add-the-cart a", cartClick);
function cartClick() {
  let button = this;
  button.classList.add("clicked");
  setTimeout(() => button.classList.remove("clicked"), 1500);
}
