function datatable_init(base_url, url, columns) {
  var loader = base_url + "assets/images/ajax-loader_dark.gif";
  $("#dmstable").DataTable({
    bProcessing: true,
    responsive: true,
    fixedHeader: true,
    sAjaxSource: url,
    bJQueryUI: true,
    sScrollX: "100%",
    sPaginationType: "full_numbers",
    "iDisplayStart ": 200,
    //"order":true,
    // "ordering":isSorted,
    order: [],
    columns: columns,
    oLanguage: {
      sProcessing: "<img src=" + loader + ">",
    },

    fnServerData: function (sSource, aoData, fnCallback) {
      $.ajax({
        dataType: "json",
        type: "POST",
        url: sSource,
        data: aoData,
        success: fnCallback,
      });
    },
  });
}
