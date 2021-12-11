function removeItemFromWishlist(e) {
  let wrapProduct = e.closest("tr.cart-item");
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
      if (data["type"] == "warning") {
        document.location.href = SITE_URL + "/login";
        return;
      }
      if (data["type"] == "success") {
        wrapProduct.classList.add("remove");
        setTimeout(() => wrapProduct.remove(), 500);
        setTimeout(() => {
          if ($(".cart-item").length == 0) {
            document.querySelector(".yproduct").style.display = "none";
            document.querySelector(".nproduct").style.display = "block";
          }
        }, 500);
      }
      notification({
        duration: 3000,
        ...data,
      });
    },
  });
}
