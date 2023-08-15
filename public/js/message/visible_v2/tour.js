let intro = introJs().setOptions({
        hidePrev: true,
        hideNext: true,
        exitOnOverlayClick: false,
        exitOnEsc: false,
        nextLabel: 'Tiếp theo',
        prevLabel: 'Quay lại',
        skipLabel: 'Bỏ qua',
        doneLabel: 'Đóng',
        showStepNumbers: false,
        steps: [
            {
                title: 'Xin chào bạn',
                intro: 'Mình sẽ hướng dẫn bạn cách sử dụng tính năng chat',
            },
            {
                element: document.querySelector("#layout-left-visible-message"),
                intro: "Đây là nơi hiển thị danh sách cuộc trò chuyện của bạn",
            },
            {
                element: document.querySelector(".header-filter"),
                intro: "Đây là nơi để tìm kiếm cuộc trò chuyện",
            },
            {
                element: document.querySelectorAll(".filter-left")[0],
                intro: "Đây là danh sách các cuộc trò chuyện bao gồm: nhóm công việc, nhóm cá nhân và cá nhân",
            },
            {
                element: document.querySelectorAll(".filter-left")[1],
                intro: "Đây là danh sách các cuộc trò chuyện với các nhà cung cấp",
            },
            {
                element: document.querySelectorAll(".filter-left")[2],
                intro: "Đây là cuộc trò chuyện với quản trị viên",
            },
            {
                element: document.querySelector(".dropdown-create-a-work-chat-group"),
                intro: "Bấm vào đây để tạo nhóm trò chuyện",
            },
            {
                element: document.querySelector("#open-modal-employee-filter-visible-message"),
                intro: "Bấm vào đây để tạo nhóm trò chuyện cá nhân",
            },
            // {
            //     element: document.querySelectorAll(".item-conversation-visible-message")[0],
            //     intro: "<p>This is a button that needs a good clicking</p>" + '<video src="https://media.giphy.com/media/l41YbDNR4q8BZJ7tm/giphy.mp4" autoplay loop />',
            //     tooltipClass: "wideo",
            // },
        ],
    }).oncomplete(() => (document.cookie = "intro-complete=true"));
var start = () => intro.start();
// window.addEventListener("load", () =>
//     document.querySelector("body").addEventListener("click", (e) => {
//         e.preventDefault();
//         document.cookie = "intro-complete=false";
//     })
// );
if (document.cookie.split(";").indexOf("intro-complete=true") < 0){
    window.setTimeout(start, 1000);
} else {
    console.log("Intro already completed");
}
