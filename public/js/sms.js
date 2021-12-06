function authsmscode(action) {
  var confirmationResult = window.confirmationResult;
  var code = document.getElementById("token").value;
  if (!code) {
    alert("Thông báo\nBạn hãy nhập số xác minh từ tin nhắn điện thoại");
    return;
  }
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
          CheckToken(action);
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
      showCheck("Mã xác nhận đã được gửi thành công", "send_mobile");
    })
    .catch(function (error) {
      // document.querySelector(".form-control.phone").classList.remove("active");
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
function onPhoneAuth(mobile) {
  // document.getElementById("authsmsbtn").addEventListener("click", authsmscode);
  var phone = String(mobile);
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

$("#recovery-form").submit(function (e) {
  e.preventDefault();
  var recoveryform = $(this);
  $("#recovery-form button").prepend(`<i class="fas fa-spinner fa-spin"></i>`);
  $.ajax({
    url: SITE_URL + "/forgot/checkExistAccount",
    type: "POST",
    data: recoveryform.serialize(),
    dataType: "JSON",
    success: function (data) {
      if (data.error["status"] == "OK") {
        let method = data.method;
        let recoverMethod = `<form action="" method="post" id="send_token">
      <input type="hidden" name="account" value="${data.account}" disabled>`;
        Object.keys(method).forEach((key) => {
          let title = key == "email" ? "Gửi mã qua email" : "Gửi mã qua SMS";
          recoverMethod += `
      <label>
        <div class=""><input type="radio" id="send_${key}" name="recover_method" value="send_${key}" ${
            data.check == key ? "checked" : ""
          } data-method="${method[key]}">
          <label for="send_${key}" class="">
            <div class="">
              <div class="">${title}</div>
              <div class="">
                <div>${method[key]}</div>
              </div>
            </div>
          </label>
        </div>
      </label>`;
        });
        recoverMethod += `
        <div class="text-center" style="margin-top: 1rem">
          <button type="submit" form="send_token" value="Submit" name="send_token" class="button primary">
            Lấy Lại Mật Khẩu
          </button>
        </div>
      </form>`;
        $("#recover_method").html(recoverMethod);
        $("#recovery-form").remove();
      } else {
        let status =
          data.error.status == "ERROR" ? "alert-danger" : "alert-success";
        let alert = `<div class="alert ${status} alert-dismissible fade show" role="alert">
        ${data.error.message}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>`;

        $("#recovery-form .errors").html(alert);
      }
      $("#recovery-form .fas").remove();
    },
  });
  return false;
});
$(document).on("submit", "#send_token", function (e) {
  e.preventDefault();
  let action = $("input[name=recover_method]:checked", "#send_token").val();
  let account = $("input[name=account]", "#send_token").val();
  $("#send_token button").prepend(`<i class="fas fa-spinner fa-spin"></i>`);
  $.ajax({
    url: SITE_URL + "/forgot/sendtoken",
    type: "POST",
    data: {
      action,
      account,
    },
    dataType: "JSON",
    success: function (data) {
      if (action == "send_mobile") {
        onPhoneAuth(data.mobile);
      }
      if (data.error["status"] == "OK") {
        showCheck(data.error["message"], "send_email");
      } else {
        console.log("đã có lối");
      }
    },
  });

  return false;
});

function showCheck(message, method) {
  let cc = `<form action="" method="post" id="check_token" class="needs-validation" novalidate
  data-method="${method}">
  <div class="errors">
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  ${message}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>
  </div>
  <div class="form-group">
    <input class="form-control" id="token" name="token" type="text" value="" required
      placeholder="Nhập vào mã xác nhận">
  </div>
  <div class="text-center" style="margin-top: 1rem">
    <button type="submit" form="check_token" value="Submit" name="check_token" class="button primary">
      Xác nhận
    </button>
  </div>
</form>`;
  $("#recover_method").html(cc);
}

$(document).on("submit", "#check_token", function (e) {
  e.preventDefault();
  let action = $(this).data("method");
  if (action == "send_mobile") {
    authsmscode(action);
    return;
  }
  CheckToken(action);
});
function CheckToken(action) {
  $.ajax({
    url: SITE_URL + "/forgot/checktoken",
    type: "POST",
    data: {
      action,
      token: $("#token").val(),
    },
    dataType: "JSON",
    success: function (data) {
      if (data.error["status"] == "OK") {
        window.location = data.link;
      }
    },
  });
}
