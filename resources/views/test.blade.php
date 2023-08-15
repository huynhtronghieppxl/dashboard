<li class="set-interval-message" data-time="2022-10-07 11:42:00">a</li>
{{--<li class="set-interval-message" data-time="2022-10-07 17:39:00">a</li>--}}
{{--<li class="set-interval-message" data-time="2022-10-07 17:38:00">a</li>--}}
<button>Nhấn cập nhật thời gian</button>


@include('layouts.script')
<script>
    // $(function () {
    //     previewLink('http://staging.dashboard.techres.vn/');
    // })
    //
    // function previewLink(link) {
    //     axios({
    //         method: 'get',
    //         url: link,
    //     }).then(function (res) {
    //         console.log(res.data.match(/<title>(.*?)<\/title>/));
    //     })
    // }

    $(function () {
        setInterval(setIntervalMessage, 1000);
        $('button').on('click', function () {
            $('li:eq(0)').data('time', moment().format('YYYY-MM-DD HH:mm:ss'))
        })
    })

    function setIntervalMessage() {
        $('.set-interval-message').each(function (i, v) {
            $(v).text(updateTimeTextTemplate(moment($(v).data('time')).format('x')));
        })
    }
</script>
