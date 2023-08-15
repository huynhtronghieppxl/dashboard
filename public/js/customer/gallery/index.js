$(function () {
    loadData()
});



async function loadData() {
    let method = 'get',
        url = 'gallery-customer.data',
        params = null,
        data = null;
    let res = await axiosTemplate(method, url, params, data);
    await $('#scroll').html(res.data);
    myFunction();
}

function myFunction() {
    let elmnt = document.getElementById("myDIV");
    let x = elmnt.scrollLeft;
    let y = elmnt.scrollTop;
    document.getElementById ("demo").innerHTML = "Chiều ngang: " + x + "px<br>Chiều cao: " + y + "px";

    if(parseFloat(y) < parseFloat($('#content1').height())){
        console.log('Đã đến 1');
    } else if(parseFloat(y) < (parseFloat($('#content1').height()) + (parseFloat($('#content2').height())))){
        console.log('Đã đến 2');
    } else if((parseFloat($('#content1').height()) + (parseFloat($('#content2').height()))) < parseFloat(y) < (parseFloat($('#content1').height()) + (parseFloat($('#content2').height())) + (parseFloat($('#content3').height())))){
        console.log('Đã đến 3');
    }

    $('#number').on('input', function () {
        if ($(this).val() === '1'){
            let div1 = document.getElementById("content1");
            div1.scrollIntoView();
        } else if ($(this).val() === '2'){
            console.log(2)
            let div2 = document.getElementById("content2");
            div2.scrollIntoView();
        } else if ($(this).val() === '3'){
            console.log(3)
            let div3 = document.getElementById("content3");
            div3.scrollIntoView();
        }
    })
}

