let checkUpdateSupplierData = 0,
  checkChangeUpdateSupplierData = 0;
let thisUpdateSupplierData = [],
  checkChangeStatusSupplierData = 0,
  oldDataUpdateSupplier;
$(function () {
  $("#input-picture-update-supplier-list-supplier").on(
    "change",
    async function () {
      url_image = URL.createObjectURL($(this).prop("files")[0]);
      $("#picture-update-supplier-list-supplier").attr(
        "src",
        URL.createObjectURL($(this).prop("files")[0])
      );
      let data = await uploadMediaTemplate($(this).prop("files")[0], 0);
      $("#picture-update-supplier-list-supplier").attr(
        "data-src",
        data.data[0]
      );
      $("#picture-update-supplier-list-supplier").attr(
        "data-url-thumb",
        data.data[1]
      );
      $(this).replaceWith($(this).val("").clone(true));
    }
  );
});

function openModalUpdateSupplierData(r) {
  $("#modal-update-supplier-data").modal("show");
  $("#modal-update-supplier-data").on("shown.bs.modal", function () {
    $("#cost-data-name-create").focus();
  });
  addLoading(
    "restaurant-supplier-data.data-update",
    "#loading-modal-update-supplier-data"
  );
  addLoading(
    "restaurant-supplier-data.update",
    "#loading-modal-update-supplier-data"
  );
  addLoading(
    "restaurant-supplier-data.change-status",
    "#loading-modal-update-supplier-data"
  );
  thisUpdateSupplierData = r;
  let id = r.data("id");
  shortcut.add("F4", function () {
    saveModalUpdateSupplierData();
  });
  shortcut.add("ESC", function () {
    closeModalUpdateSupplierData();
  });
  $("#table-contact-update-supplier-data tbody tr").remove();
  $(document).on(
    "input",
    "#modal-update-supplier-data input, #modal-update-supplier-data textarea",
    function () {
      checkChangeUpdateSupplierData = 1;
    }
  );

  checkUpdateSupplierData = 0;
  checkChangeUpdateSupplierData = 0;
  $("#id-update-supplier-data").text(id);
  dataUpdateSupplierData(id);
}

async function dataUpdateSupplierData(id) {
  let method = "get",
    url = "restaurant-supplier-data.data-update",
    params = { supplier: id },
    data = null;
  let res = await axiosTemplate(method, url, params, data, [
    $("#loading-modal-update-supplier-data"),
  ]);
  oldDataUpdateSupplier = res.data.data;
  $("#name-update-supplier-data").val(res.data.data.name);
  $("#prefix-update-supplier-data").val(res.data.data.prefix);
  $("#phone-update-supplier-data").val(res.data.data.phone);
  $("#address-update-supplier-data").val(res.data.data.address);
  $("#email-update-supplier-data").val(res.data.data.email);
  $("#tax-update-supplier-data").val(res.data.data.tax_code);
  $("#website-update-supplier-data").val(res.data.data.website);
  $("#note-update-supplier-data").val(res.data.data.description);
  $("#status-update-supplier-data").html(res.data.data.status_text);
  $("#status-id-update-supplier-data").text(res.data.data.status);
  $("#picture-update-supplier-list-supplier").attr(
    "src",
    res.data.data.avatar_supplier
  );
  $("#picture-update-supplier-list-supplier").attr(
    "data-src",
    res.data.data.avatar
  );
  countCharacterTextarea();
}

function addContactUpdateSupplierData() {
  checkChangeUpdateSupplierData = 1;
  $("#table-contact-update-supplier-data tbody").prepend(
    "<tr>\n" +
      '<td class="text-center"><input class="form-control"/></td>\n' +
      '<td class="text-center"><input class="form-control"/></td>\n' +
      '<td class="text-center"><input class="form-control"/></td>\n' +
      '<td class="text-center"><input class="form-control"/></td>\n' +
      '<td class="text-center"><div class="btn-group-sm"><button class="tabledit-delete-button btn btn-danger waves-effect waves-light" onclick="deleteContactUpdateSupplierData($(this))"><span class="icofont icofont-ui-delete"></span></button></div></td>\n' +
      "</tr>"
  );
}

function deleteContactUpdateSupplierData(r) {
  checkChangeUpdateSupplierData = 1;
  $("#table-contact-update-supplier-data tbody tr")
    .eq(r.parents("tr").index())
    .remove();
  let text = "Xóa liên hệ thành công !";
  SuccessNotify(text);
}

async function saveModalUpdateSupplierData() {
  if (checkUpdateSupplierData !== 0) {
    return false;
  }
  if (!checkValidateSave($("#modal-update-supplier-data"))) return false;
  let name = $("#name-update-supplier-data").val();
  let phone = $("#phone-update-supplier-data").val();
  let address = $("#address-update-supplier-data").val();
  let tax = $("#tax-update-supplier-data").val();
  let email = $("#email-update-supplier-data").val();
  let website = $("#website-update-supplier-data").val();
  let note = $("#note-update-supplier-data").val();
  let status = $("#status-id-update-supplier-data").text();
  let id = $("#id-update-supplier-data").text();
  let contact = [];
  $("#table-contact-update-supplier-data tbody tr").each(function (row, tr) {
    contact[row] = {
      name: $(tr).find("td").eq(0).find("input").val(),
      phone: $(tr).find("td").eq(1).find("input").val(),
      email: $(tr).find("td").eq(2).find("input").val(),
      role_name: $(tr).find("td").eq(3).find("input").val(),
    };
  });
  checkUpdateSupplierData = 1;
  let method = "post",
    url = "restaurant-supplier-data.update",
    params = null,
    data = {
      name: name,
      phone: phone,
      address: address,
      tax: tax,
      email: email,
      website: website,
      des: note,
      status: status,
      contact: contact,
      supplier: id,
      avatar: $("#picture-update-supplier-list-supplier").attr("data-src"),
    };
  let text = $("#success-update-data-to-server").text();
  if (
    data.address == oldDataUpdateSupplier.address &&
    data.avatar == oldDataUpdateSupplier.avatar &&
    data.des == oldDataUpdateSupplier.description &&
    data.email == oldDataUpdateSupplier.email &&
    data.name == oldDataUpdateSupplier.name &&
    data.phone == oldDataUpdateSupplier.phone &&
    data.status == oldDataUpdateSupplier.status &&
    data.tax == oldDataUpdateSupplier.tax_code &&
    data.website == oldDataUpdateSupplier.website
  ) {
    SuccessNotify(text);
    checkUpdateSupplierData = 0;
    closeModalUpdateSupplierData();
    return;
  }
  let res = await axiosTemplate(method, url, params, data, [
    $("#loading-modal-update-supplier-data"),
  ]);
  checkUpdateSupplierData = 0;
  switch (res.data.status) {
    case 200:
      SuccessNotify(text);
      thisUpdateSupplierData
        .parents("tr")
        .find("td:eq(1)")
        .html(res.data.data.name);
      thisUpdateSupplierData
        .parents("tr")
        .find("td:eq(2)")
        .html(res.data.data.phone);
      thisUpdateSupplierData
        .parents("tr")
        .find("td:eq(3)")
        .html(res.data.data.action);
      thisUpdateSupplierData
        .parents("tr")
        .find("td:eq(4)")
        .html(res.data.data.keysearch);
      closeModalUpdateSupplierData();
      break;
    case 500:
      ErrorNotify($("#error-post-data-to-server").text());
      break;
    default:
      WarningNotify(res.data.message);
  }
}

function closeModalUpdateSupplierData() {
  $("#modal-update-supplier-data").modal("hide");
  reloadModalUpdateSupplierData();
  shortcut.remove("ESC");
  shortcut.remove("F4");
}

function changeStatusSupplierData(r) {
  if (checkChangeStatusSupplierData === 1) return false;
  if (r.data("status") === 0) {
    let title = `Chuyển trạng thái NCC [${r.data("name")}] sang hoạt động ?`,
      content = "",
      icon = "question";
    sweetAlertComponent(title, content, icon).then(async (result) => {
      if (result.value) {
        checkChangeStatusSupplierData = 1;
        let method = "post",
          url = "restaurant-supplier-data.change-status",
          params = null,
          data = { id: r.data("id") };
        let res = await axiosTemplate(method, url, params, data);
        checkChangeStatusSupplierData = 0;
        switch (res.data.status) {
          case 200:
            SuccessNotify($("#success-status-data-to-server").text());
            loadData();
            break;
          case 500:
            ErrorNotify($("#error-post-data-to-server").text());
            break;
          default:
            WarningNotify(res.data.message);
        }
      }
    });
  } else {
    let title = `Chuyển trạng thái NCC [${r.data("name")}] sang tạm ngưng ?`,
      content = "",
      icon = "question";
    sweetAlertComponent(title, content, icon).then(async (result) => {
      if (result.value) {
        let method = "post",
          url = "restaurant-supplier-data.change-status",
          params = null,
          data = { id: r.data("id") };
        let res = await axiosTemplate(method, url, params, data);
        checkChangeStatusSupplierData = 0;
        switch (res.data.status) {
          case 200:
            SuccessNotify($("#success-status-data-to-server").text());
            loadData();
            break;
          case 205:
            const swalWithBootstrapButtons = Swal.mixin({
              customClass: {
                container: "popup-swal-205",
                cancelButton:
                  "swal2-cancel btn btn-grd-disabled btn-sweet-alert swal-button--cancel",
              },
              buttonsStyling: false,
            });
            swalWithBootstrapButtons
              .fire({
                title: "Đơn hàng chưa hoàn tất",
                icon: "warning",
                html: `<h5 class="f-w-600 col-form-label-fz-15"> ${res.data.message} </h5>
                                <div class="card-block px-0 seemt-main-content" >
                                    <div class="table-responsive new-table">
                                        <table id="table-order-not-complete" class="table" >
                                            <thead>
                                                <tr>
                                                    <th class="text-center">STT </th>
                                                    <th class="text-center">Mã đơn hàng</th>
                                                    <th></th>
                                                    <th class="d-none"></th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>`,
                showCancelButton: true,
                showConfirmButton: false,
                cancelButtonText: $("#button-btn-cancel-component").text(),
                reverseButtons: true,
                focusConfirm: true,
              })
              .then(async (result) => {
                if (result.value) {
                  let method = "post",
                    url = "restaurant-supplier-data.change-status",
                    params = null,
                    data = { id: id };
                  let res = await axiosTemplate(method, url, params, data);
                  if (res.status === 200) {
                    SuccessNotify($("#success-update-data-to-server").text());
                  }
                }
              });
            dataTableUnAssignSupplier(res);
            break;
          case 500:
            ErrorNotify($("#error-post-data-to-server").text());
            break;
          default:
            WarningNotify(res.data.message);
        }
      }
    });
  }
}

async function dataTableUnAssignSupplier(data) {
  let table_un_assign = $("#table-order-not-complete"),
    scroll_Y = "300px",
    fixed_left = 0,
    fixed_right = 0,
    column = [
      {
        data: "DT_RowIndex",
        name: "DT_RowIndex",
        className: "text-center",
        width: "5%",
      },
      { data: "code", name: "code", className: "text-center" },
      {
        data: "action",
        name: "action",
        className: "text-center",
        width: "10%",
      },
      { data: "keysearch", className: "d-none" },
    ];
  await DatatableTemplateNew(
    table_un_assign,
    data.data.data.original.data,
    column,
    scroll_Y,
    fixed_left,
    fixed_right,
    []
  );
}

function reloadModalUpdateSupplierData() {
  removeAllValidate();
  $(
    "#modal-update-supplier-data input, #modal-update-supplier-data textarea"
  ).val("");
  $("#picture-update-supplier-list-supplier").attr(
    "src",
    "http://127.0.0.1:8000/images/tms/default.jpeg"
  );
}
