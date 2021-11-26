<?php
$listProvince = $data['Province'];
?>

<div class="form-control">
  <label for="province">
    Tỉnh/Thành phố <span class="required">*</span>
  </label>
  <select id="province">
  </select>
</div>
<div class="form-control">
  <label for="district">
    Quận/Huyện <span class="required">*</span>
  </label>
  <select id="district">
  </select>
</div>
<div class="form-control">
  <label for="ward">
    Xã/Phường/Thị trấn <span class="required">*</span>
  </label>
  <select id="ward">
  </select>
</div>
<script>
$(document).ready(function() {
  $.getJSON(`${SITE_URL}/public/JSON/tinh_tp.json`,
    function(data) {
      let province = ``;
      Object.keys(data).forEach(function(key) {
        province += `<option value = "${key}" >${data[key]['name']}</option>`;
      });
      $("#province").empty().append(province);

    })
  $("select#province").change(function() {



    let _province_id = $("#province :selected").val();
    $.ajax({
      url: `${SITE_URL}/address/district/${_province_id}`,
      dataType: "JSON",
      beforeSend: function() {
        $("#district")
          .empty()
          .append('<option value = "-1" > -- -- - Loading-- -- - </option>');
      },
      success: function(data) {
        let district = ``;
        Object.keys(data).forEach(function(key) {
          district += `<option value = "${key}" >${data[key]['name_with_type']}</option>`;
        });
        $("#district").empty().append(district);
      },
    });
  });
  $("select#district").change(function() {
    let _district_id = $("#district :selected").val();
    $.ajax({
      url: `${SITE_URL}/address/ward/${_district_id}`,
      dataType: "JSON",
      beforeSend: function() {
        $("#ward")
          .empty()
          .append('<option value="-1">-----Loading-----</option>');
      },
      success: function(data) {
        console.log(data);
        let ward = ``;
        Object.keys(data).forEach(function(key) {
          ward += `<option value = "${key}" >${data[key]['name_with_type']}</option>`;
        });
        $("#ward").empty().append(ward);
      },
    });
  });
});
</script>