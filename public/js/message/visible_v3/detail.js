$(function () {
    $(document).on("click", "#list-employee-detail", function () {
        console.log("click", conversationId);
        employee(conversationId);
    });
});

async function employee(id) {
    console.log(id);
    const method = "get";
    const url = "visible-message.employee";
    const data = {};
    let params = {
        id: id,
        page: 1,
        limit: 20,
    };
    let res = await axiosTemplate(method, url, params, data);
    $('#data-member-about-visible-message').html(res[0]);
    console.log(res);
}
