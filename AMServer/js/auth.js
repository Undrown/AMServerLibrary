/*Âñ¸, ÷òî ñâÿçàíî ñ àâòîðèçàöèåé*/
$(document).ready(function() {
    // Âûòàñêèâàåì èç õðàíèëèùà phone è uid ïðè çàãðóçêå...
    phone = window.localStorage.getItem("phone");
    uid = window.localStorage.getItem("uid");
    if(phone){
        //...è åñëè òàì óæå åñòü ëîãèí òî àâòîðèçóåìñÿ íà ñåðâåðå...
        $.getJSON(api_php, {action: 'login', phone: phone})
        .done(function (json, textStatus, jqXHR) {
            //... è âûñòàâëÿåì êíîïêó ñ èìåíåì âìåñòî êíîïêè Login
            $("#user_b").html(json.name);
            $("#user_b").css('display', 'inline');
            $("#login_b").css('display', 'none');
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            window.localStorage.removeItem("uid");
            window.localStorage.removeItem("phone");
            alert("Error: "+errorThrown);
        });
    }
});

function login() {
    phone=prompt("phone", 111);
    $.getJSON(api_php, {action: 'login', phone: phone})
    .done(function (json, textStatus, jqXHR) {
        window.localStorage.setItem("uid", json.id);
        window.localStorage.setItem("phone", json.phone);
        document.location.reload();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        window.localStorage.removeItem("uid");
        window.localStorage.removeItem("phone");
        alert("Error: "+errorThrown);
    })
}

function logout() {
    window.localStorage.removeItem("uid");
    window.localStorage.removeItem("phone");
    document.location.reload();
}