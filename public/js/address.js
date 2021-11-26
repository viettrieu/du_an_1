var xhrPool = [];

if ($(".select2").length > 0) {
  $(".select2").select2({
    placeholder: "Select a state",
    width: "100%",
  });
}
function GetDistrict() {
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
}
GetDistrict();
function GetWard() {
  $("select#district").change(function () {
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
          ward += `<option value="${data[key]}">${data[key]}</option>`;
        });
        $("#ward").empty().append(ward);
        $(".form-group.ward").removeClass("address_loading");
      },
    });
  });
}

function abortAll() {
  if (xhrPool.length > 0) {
    console.log(xhrPool);
    $.each(xhrPool, function (idx, jqXHR) {
      jqXHR.abort();
    });
    xhrPool = [];
  }
}
