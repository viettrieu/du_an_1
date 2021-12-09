$(document).on("click", "#sea", function (e) {
  $("#modal-7").addClass("md-show");
  setTimeout(() => {
    document.querySelector("#modal-7 .search-field").focus();
  }, 30);
});
