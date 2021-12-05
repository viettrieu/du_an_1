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
  document.querySelector(".subtotal").innerHTML = formatCash(subTotal);
  document.querySelector(".total").innerHTML = formatCash(total);
  $(".cart-subtotal").after(showCoupon(discount));
  if (cart.length == 0) {
    document.querySelector(".yproduct").style.display = "none";
    document.querySelector(".nproduct").style.display = "flex";
  }
}
let shipmentFee = [];
let subTotal = getSubTotal();
let discount = getDiscount(subTotal);
let ship = getshipmentFee();
let total = getTotal(subTotal, discount, ship);
displayCheckout();

// MAP
// document
//   .getElementById("current-position")
//   .addEventListener("click", getCurrentPosition);
// function getCurrentPosition() {
//   if (navigator.geolocation) {
//     navigator.geolocation.getCurrentPosition(setCurrentPosition);
//   } else {
//     alert("Geolocation is not supported by this browser.");
//   }
// }

// // get formatted address based on current position and set it to input
// function setCurrentPosition(pos) {
//   var geocoder = new google.maps.Geocoder();
//   var latlng = {
//     lat: parseFloat(pos.coords.latitude),
//     lng: parseFloat(pos.coords.longitude),
//   };
//   geocoder.geocode({ location: latlng }, function (responses) {
//     if (responses && responses.length > 0) {
//       document.getElementById("address").value = responses[1].formatted_address;
//       calculateAndDisplayRoute();
//       //    console.log(responses[1].formatted_address);
//     } else {
//       alert("Cannot determine address at this location.");
//     }
//   });
// }

// var map, directionsService, directionsDisplay;
// function initMap() {
//   const myLatLng = {
//     lat: 10.9520931,
//     lng: 107.0013796,
//   };
//   map = new google.maps.Map(document.getElementById("map"), {
//     center: myLatLng,
//     zoom: 9,
//   });
//   initAutocomplete();
//   initDirection();
// }
// var checkoutForm = document.getElementById("checkout-form");
// checkoutForm.addEventListener("keydown", function (event) {
//   if (event.keyCode === 13) {
//     event.preventDefault();
//   }
// });

// function initAutocomplete() {
//   // Create the autocomplete object, restricting the search to geographical
//   // location types.
//   autocomplete = new google.maps.places.Autocomplete(
//     /** @type {!HTMLInputElement} */
//     (document.getElementById("address")),
//     {
//       types: ["geocode"],
//     }
//   );
//   // When the user selects an address from the dropdown, populate the address
//   // fields in the form.
//   autocomplete.addListener("place_changed", calculateAndDisplayRoute);
// }
// function initDirection() {
//   directionsService = new google.maps.DirectionsService();
//   directionsDisplay = new google.maps.DirectionsRenderer();
//   directionsDisplay.setMap(map);
// }

// function calculateAndDisplayRoute() {
//   // document.querySelector(".loader-wrap").style.display = "block";
//   directionsService.route(
//     {
//       origin:
//         "Nhà văn hóa huyện Trảng Bom, Đường 29/04, Trảng Bom, Đồng Nai, Việt Nam",
//       destination: document.getElementById("address").value,
//       travelMode: "DRIVING",
//     },
//     function (response, status) {
//       // document.querySelector(".loader-wrap").style.display = "none";
//       if (status === "OK") {
//         directionsDisplay.setDirections(response);
//         let distance = response.routes[0].legs[0].distance.text;
//         let duration = response.routes[0].legs[0].duration.text;
//         document.querySelector(".shippingtime_box").style.display = "block";
//         document.querySelector(".distance").innerText = distance;
//         document.querySelector(".duration").innerText = duration;
//       } else {
//         window.alert("Directions request failed due to " + status);
//       }
//     }
//   );
// }
// SMS

// function authsmscode() {
//   document.querySelector(".form-control.otp").classList.add("active");
//   var code = document.getElementById("vericode").value;
//   if (!code) {
//     alert("Thông báo\nBạn hãy nhập số xác minh từ tin nhắn điện thoại");
//     return;
//   }
//   var confirmationResult = window.confirmationResult;
//   confirmationResult
//     .confirm(code)
//     .then(function (result) {
//       // User signed in successfully.
//       var phoneNumber = result.user.phoneNumber;
//       console.log(result);
//       firebase
//         .auth()
//         .currentUser.getIdToken(/* forceRefresh */ true)
//         .then(function (idToken) {
//           // console.log(idToken);
//           // placeOrderEx(idToken);
//           // alert("Số điện thoại " + phoneNumber + " đã được xác minh");
//           document.querySelector(".form-control.otp").classList.add("none");
//           document
//             .querySelector(".form-control.phone")
//             .classList.add("confirm");
//           document.getElementById("btnsubmit").innerText = "Đã xác minh";
//         })
//         .catch(function (error) {
//           // Handle error
//           console.log(error.message);
//           alert("Thông báo Lỗi không xác định!");
//         });
//     })
//     .catch(function (error) {
//       // User couldn't sign in (bad verification code?)
//       console.log(error.message);
//       alert("Thông báo Bạn nhập sai số xác minh từ điện thoại");
//     });
// }
// function onPhoneSignin(phone) {
//   var appVerifier = window.recaptchaVerifier;
//   firebase
//     .auth()
//     .signInWithPhoneNumber(phone, appVerifier)
//     .then(function (confirmationResult) {
//       /* SMS sent. Prompt user to type the code from the message */
//       window.confirmationResult = confirmationResult;
//       document.querySelector(".form-control.phone").classList.remove("active");
//       document.querySelector(".form-control.phone").classList.add("none");
//       document.querySelector(".form-control.otp").classList.remove("none");
//     })
//     .catch(function (error) {
//       document.querySelector(".form-control.phone").classList.remove("active");
//       alert(error.message);
//     });
// }
// window.onload = () => {
//   firebase.auth().languageCode = "vi";
//   window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier("rcccont", {
//     size: "invisible",
//     callback: function (response) {
//       // reCAPTCHA solved, allow signInWithPhoneNumber.
//     },
//   });
// };
// function onPhoneAuth() {
//   document.querySelector(".form-control.phone").classList.add("active");
//   document.getElementById("authsmsbtn").addEventListener("click", authsmscode);
//   var phone = document.getElementById("mobile").value;
//   while (phone.charAt(0) === "0") {
//     //remove 0 from begin:
//     phone = phone.substr(1);
//   }
//   phone = "+84" + phone;
//   onPhoneSignin(phone);
//   recaptchaVerifier.render().then(function (widgetId) {
//     window.recaptchaWidgetId = widgetId;
//   });
// }

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

$(document).ready(function () {
  var xhrPool = [];
  if ($(".select2").length > 0) {
    $(".select2").select2({
      placeholder: "Select a state",
      width: "100%",
    });
  }
  $("body").on("change", "#transport input", function () {
    abortAll();
    let transport = $(this).val();
    $.ajax({
      url: `${SITE_URL}/transport/Fee`,
      dataType: "JSON",
      type: "POST",
      data: { transport },
      beforeSend: function (jqXHR) {
        xhrPool.push(jqXHR);
        $(".cart-totals").addClass("address_loading");
      },
      success: function (data) {
        console.log(data);
        ship = data["fee"];
        total = getTotal(subTotal, discount, ship);
        document.querySelector(".total").innerHTML = formatCash(total);
        $(".cart-totals").removeClass("address_loading");
      },
    });
  });
  $("select#province").change(function () {
    abortAll();
    let _province_id = $("#province :selected").data("province");
    $.ajax({
      url: `${SITE_URL}/transport/district/${_province_id}`,
      dataType: "JSON",
      beforeSend: function (jqXHR) {
        xhrPool.push(jqXHR);
        $(".form-group.district").addClass("address_loading");
      },
      success: function (data) {
        let district = `<option value=""></option>`;
        Object.keys(data).forEach(function (key) {
          district += `<option data-district="${key}" value="${data[key]}">${data[key]}</option>`;
        });
        $("#district").empty().append(district);
        $(".form-group.district").removeClass("address_loading");
        $("#ward").empty().append(`<option value=""></option>`);
      },
    });
  });
  $("select#district").change(function () {
    abortAll();
    let _district_id = $("#district :selected").data("district");
    $.ajax({
      url: `${SITE_URL}/transport/ward/${_district_id}`,
      dataType: "JSON",
      beforeSend: function (jqXHR) {
        xhrPool.push(jqXHR);
        $(".form-group.ward").addClass("address_loading");
      },
      success: function (data) {
        let ward = `<option value=""></option>`;
        Object.keys(data).forEach(function (key) {
          ward += `<option data-ward="${key}" value="${data[key]}">${data[key]}</option>`;
        });
        $("#ward").empty().append(ward);
        $(".form-group.ward").removeClass("address_loading");
      },
    });
    shipFee();
  });

  if (
    $("#province :selected").val() != "" &&
    $("#district :selected").val() != ""
  ) {
    shipFee();
  }

  function shipFee() {
    $.ajax({
      url: `${SITE_URL}/transport/shipmentFee`,
      dataType: "JSON",
      type: "POST",
      data: {
        province: $("#province :selected").val(),
        district: $("#district :selected").val(),
      },
      beforeSend: function (jqXHR) {
        xhrPool.push(jqXHR);
        $(".cart-totals").addClass("address_loading");
      },
      success: function (data) {
        shipmentFee = data;
        ship = getshipmentFee();
        total = getTotal(subTotal, discount, ship);
        document.querySelector(".total").innerHTML = formatCash(total);
        let shipping = ``;
        Object.keys(data).forEach(function (key, index) {
          shipping += `<label for="${data[key]["transport"]}">
            <input type="radio" id="${
              data[key]["transport"]
            }" name="shipping" value="${data[key]["transport"]}" ${
            index == 0 ? "checked" : ""
          }>
            <strong>
            ${formatCash(data[key]["fee"])}<sup>đ</sup>
            </strong>(${data[key]["text"]})
            </label>`;
        });
        $("#transport").empty().append(shipping);
        $(".cart-totals").removeClass("address_loading");
      },
    });
  }
  function abortAll() {
    if (xhrPool.length > 0) {
      $.each(xhrPool, function (idx, jqXHR) {
        jqXHR.abort();
      });
      xhrPool = [];
    }
  }
});
