function removeItemFromWishlist(e) {
  let wrapProduct = e.closest("tr");
  let productId = wrapProduct.getAttribute("data-id");
  let postForm = {
    productId,
  };
  console.log(productId);
  $.ajax({
    type: "POST",
    url: SITE_URL + "/wishlist/remove",
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
    },
  });
}

function removeItemFromWishlist(e) {
  let wrapProduct = e.closest("tr");
  let productId = wrapProduct.getAttribute("data-id");
  let postForm = {
    productId,
  };
  console.log(productId);
  $.ajax({
    type: "POST",
    url: SITE_URL + "/wishlist/remove",
    data: postForm,
    dataType: "json",
    success: function (data) {
      wrapProduct.classList.add("remove");
      setTimeout(() => wrapProduct.remove(), 500);
      setTimeout(() => {
        if ($(".cart-item").length == 0) {
          document.querySelector(".yproduct").style.display = "none";
          document.querySelector(".nproduct").style.display = "flex";
        }
      }, 500);
    },
  });
}
