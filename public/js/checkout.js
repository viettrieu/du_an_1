function displayCheckout() {
  let output = "";
  for (let i in cart) {
    let sum = cart[i].price * cart[i].quantity;
    output += `
    <tr class="cart_item">
              <td class="product-name">
              ${cart[i].title}
                <strong class="product-quantity">× ${cart[i].quantity}</strong>
              </td>
              <td class="product-total">
              <span class="price">
                <span class="unit-price">${formatCash(sum)}</span>
                <sup>đ</sup>
              </span>
              </td>
            </tr>`;
  }
  document.getElementById("show-checkout").innerHTML = output;
  let subTotal = getSubTotal();
  let discount = getDiscount(subTotal);
  let total = getTotal(subTotal, discount);
  document.querySelector(".subtotal").innerHTML = formatCash(subTotal);
  document.querySelector(".total").innerHTML = formatCash(total);
  $(".cart-subtotal").after(showCoupon(discount));
  if (cart.length == 0) {
    document.querySelector(".yproduct").style.display = "none";
    document.querySelector(".nproduct").style.display = "flex";
  }
}
displayCheckout();
function getSubTotal() {
  let sum = cart.reduce((sum, item) => sum + item.quantity * item.price, 0);
  return sum;
}
function getDiscount(subTotal) {
  let sum = 0;
  if (coupon["code"]) {
    sum = (coupon["discount"] / 100) * subTotal;
  }
  return sum;
}
function showCoupon(discount) {
  let info = ``;
  if (coupon["code"]) {
    info = `<tr class="cart-discount">
    <th>Coupon: ${coupon["code"]}</th>
    <td>-<span class="discount">${formatCash(discount)}</span>
      <sup>đ</sup> <a href="" id="remove-coupon">[xóa]</a>
    </td>
  </tr>`;
  }
  return info;
}
function getTotal(subTotal, discount) {
  let sum = subTotal - discount;
  return sum;
}
document
  .getElementById("current-position")
  .addEventListener("click", getCurrentPosition);
function getCurrentPosition() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(setCurrentPosition);
  } else {
    alert("Geolocation is not supported by this browser.");
  }
}

// get formatted address based on current position and set it to input
function setCurrentPosition(pos) {
  var geocoder = new google.maps.Geocoder();
  var latlng = {
    lat: parseFloat(pos.coords.latitude),
    lng: parseFloat(pos.coords.longitude),
  };
  geocoder.geocode({ location: latlng }, function (responses) {
    if (responses && responses.length > 0) {
      document.getElementById("address").value = responses[1].formatted_address;
      calculateAndDisplayRoute();
      //    console.log(responses[1].formatted_address);
    } else {
      alert("Cannot determine address at this location.");
    }
  });
}

// MAP
var map, directionsService, directionsDisplay;
function initMap() {
  const myLatLng = {
    lat: 10.9520931,
    lng: 107.0013796,
  };
  map = new google.maps.Map(document.getElementById("map"), {
    center: myLatLng,
    zoom: 9,
  });
  initAutocomplete();
  initDirection();
}
var checkoutForm = document.getElementById("checkout-form");
checkoutForm.addEventListener("keydown", function (event) {
  if (event.keyCode === 13) {
    event.preventDefault();
  }
});

function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
    /** @type {!HTMLInputElement} */
    (document.getElementById("address")),
    {
      types: ["geocode"],
    }
  );
  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  autocomplete.addListener("place_changed", calculateAndDisplayRoute);
}
function initDirection() {
  directionsService = new google.maps.DirectionsService();
  directionsDisplay = new google.maps.DirectionsRenderer();
  directionsDisplay.setMap(map);
}

function calculateAndDisplayRoute() {
  // document.querySelector(".loader-wrap").style.display = "block";
  directionsService.route(
    {
      origin:
        "Nhà văn hóa huyện Trảng Bom, Đường 29/04, Trảng Bom, Đồng Nai, Việt Nam",
      destination: document.getElementById("address").value,
      travelMode: "DRIVING",
    },
    function (response, status) {
      // document.querySelector(".loader-wrap").style.display = "none";
      if (status === "OK") {
        directionsDisplay.setDirections(response);
        let distance = response.routes[0].legs[0].distance.text;
        let duration = response.routes[0].legs[0].duration.text;
        document.querySelector(".shippingtime_box").style.display = "block";
        document.querySelector(".distance").innerText = distance;
        document.querySelector(".duration").innerText = duration;
      } else {
        window.alert("Directions request failed due to " + status);
      }
    }
  );
}
// SMS

function authsmscode() {
  document.querySelector(".form-control.otp").classList.add("active");
  var code = document.getElementById("vericode").value;
  if (!code) {
    alert("Thông báo\nBạn hãy nhập số xác minh từ tin nhắn điện thoại");
    return;
  }
  var confirmationResult = window.confirmationResult;
  confirmationResult
    .confirm(code)
    .then(function (result) {
      // User signed in successfully.
      var phoneNumber = result.user.phoneNumber;
      console.log(result);
      firebase
        .auth()
        .currentUser.getIdToken(/* forceRefresh */ true)
        .then(function (idToken) {
          // console.log(idToken);
          // placeOrderEx(idToken);
          // alert("Số điện thoại " + phoneNumber + " đã được xác minh");
          document.querySelector(".form-control.otp").classList.add("none");
          document
            .querySelector(".form-control.phone")
            .classList.add("confirm");
          document.getElementById("btnsubmit").innerText = "Đã xác minh";
        })
        .catch(function (error) {
          // Handle error
          console.log(error.message);
          alert("Thông báo Lỗi không xác định!");
        });
    })
    .catch(function (error) {
      // User couldn't sign in (bad verification code?)
      console.log(error.message);
      alert("Thông báo Bạn nhập sai số xác minh từ điện thoại");
    });
}
function onPhoneSignin(phone) {
  var appVerifier = window.recaptchaVerifier;
  firebase
    .auth()
    .signInWithPhoneNumber(phone, appVerifier)
    .then(function (confirmationResult) {
      /* SMS sent. Prompt user to type the code from the message */
      window.confirmationResult = confirmationResult;
      document.querySelector(".form-control.phone").classList.remove("active");
      document.querySelector(".form-control.phone").classList.add("none");
      document.querySelector(".form-control.otp").classList.remove("none");
    })
    .catch(function (error) {
      document.querySelector(".form-control.phone").classList.remove("active");
      alert(error.message);
    });
}
window.onload = () => {
  firebase.auth().languageCode = "vi";
  window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier("rcccont", {
    size: "invisible",
    callback: function (response) {
      // reCAPTCHA solved, allow signInWithPhoneNumber.
    },
  });
};
function onPhoneAuth() {
  document.querySelector(".form-control.phone").classList.add("active");
  document.getElementById("authsmsbtn").addEventListener("click", authsmscode);
  var phone = document.getElementById("mobile").value;
  while (phone.charAt(0) === "0") {
    //remove 0 from begin:
    phone = phone.substr(1);
  }
  phone = "+84" + phone;
  onPhoneSignin(phone);
  recaptchaVerifier.render().then(function (widgetId) {
    window.recaptchaWidgetId = widgetId;
  });
}

// $("#checkout-form").submit(function (e) {
//   e.preventDefault();
//   let transaction = document.getElementsByName("payment_method");
//   for (let index = 0; index < transaction.length; index++) {
//     if (transaction[index].checked == true) {
//       transaction = transaction[index].value;
//       break;
//     }
//   }
//   var postForm = new FormData(this);
//   postForm.append("action", "checkout");
//   $.ajax({
//     type: "POST",
//     url: SITE_URL + "/checkout/insertorder",
//     data: postForm,
//     dataType: "json",
//     cache: false,
//     contentType: false,
//     processData: false,
//     success: function (data) {
//       cart = [];
//       if (data[0] == "cod")
//         location.href = SITE_URL + "/checkout/OrderReceived/" + data[1];
//       else location.href = data["data"];
//     },
//   });
// });

(function ($) {
  $("input[name=transaction]").click(function (j) {
    var dropDown = $(this).closest("li").find("div");
    $(this).closest(".checkout-payment").find("div").not(dropDown).slideUp();
    dropDown.stop(false, true).slideToggle();
  });
})(jQuery);
