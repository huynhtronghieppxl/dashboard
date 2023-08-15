$(function (){
    loadData()

    $("#search").keyup(function () {
        var search_value = $(this).val();
        let keywords = search_value.toLowerCase();
        $(".chat-item").each(function (i, value) {
            let data_name = $(this).data("search");
            if (data_name.includes(keywords)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
})
async function loadData(){
    let method = 'get',
        url = 'test-chat.data',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    drawDataGroup(res.data[0])
    drawDataPersion(res.data[1])
    drawDataSuplier(res.data[2])
}
async function drawDataGroup(data){
    let htmls = data.map(item => {
        let name = item.name.toLowerCase();
        return `
            <li class="chat-item" data-id="${item.id}" data-search="${name}">
          <span class="chat-item-avatar-wrapper has-message">
            <img
                src="${item.image}"
                alt="avatar"
                class="chat-item-avatar"
            />
          </span>
                <span class="chat-item-name">${item.name}</span>
                <span class="chat-item-status"></span>

            </li>
        `
    })
    $('.group').html(htmls);
}
async function drawDataPersion(data){
    let htmls = data.map(item => {
        let name = item.name.toLowerCase();
        return `
            <li class="chat-item" data-id="${item.id}" data-search="${name}">
          <span class="chat-item-avatar-wrapper has-message">
            <img
                src="${item.image}"
                alt="avatar"
                class="chat-item-avatar"
            />
          </span>
                <span class="chat-item-name">${item.name}</span>
                <span class="chat-item-status"></span>
                <!-- popup -->
                <div class="popup-card">
                    <div class="contain">
                        <div class="card">
                            <div class="firstinfo">
                                <img src="https://wallpaperaccess.com/full/2148421.jpg" />
                                <div class="profileinfo">
                                    <h1>${item.name}</h1>
                                    <h3>PHP intern</h3>
                                    <p class="bio">Lovely, love my life</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end -->

            </li>
        `
    })
    $('.persion').html(htmls);
}

async function drawDataSuplier(data){
    let htmls = data.map(item => {
        let name = item.name.toLowerCase();
        return `
            <li class="chat-item" data-id="${item.id}" data-search="${name}">
          <span class="chat-item-avatar-wrapper has-message">
            <img
                src="${item.image}"
                alt="avatar"
                class="chat-item-avatar"
            />
          </span>
                <span class="chat-item-name">${item.name}</span>
                <span class="chat-item-status"></span>

            </li>
        `
    })
    $('.suplier').html(htmls);
}

