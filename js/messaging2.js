google.load("jquery", "1.3.2");
google.load("jqueryui", "1.7.2");


function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}

//-- No use time. It is a javaScript effect.
// function insertMsg(who, text, dateTimeJSON){
function insertMsg(who, text) {
    var control = "";
    // var date = JSON.stringify(formatAMPM(dateTimeJSON=='null'?new Date():new Date(Date.parse(JSON.parse(dateTimeJSON)['date']))));//dateTimeJSON JSON.parse() //formatAMPM
    //console.log(dateTimeJSON, date);
    if (who == sessionStorage.getItem('username')) {
        control = '<li style="width:100%;">' +
            '<div class="msj-rta macro">' +
            '<div class="text text-r">' +
            '<p>' + text + '</p>' +
            '<p>' + '</p>' +
            '</div>' +
            '<div class="avatar" style="padding:0px 0px 0px 10px !important">' +
            '<p><small>' + "me" + '</small></p>' +
            // '<p><small>'+date+'</small></p>' +
            '</div>' +
            '</li>';

    } else {
        control = '<li style="width:100%;">' +
            '<div class="msj macro">' +
            '<div class="text text-l">' +
            '<p>' + text + '</p>' +
            '<p>' + '</p>' +
            '</div>' +
            '<div class="avatar">' + //style="padding:0px 0px 0px 10px !important"
            '<p><small>' + who + '</small></p>' +
            // '<p><small>'+date+'</small></p>' +
            '</div>' +
            '</li>';

    }
    $("#messages").append(control);
}

function resetChat() {
    $("#messages").empty();
}

function sendMsg() {
    var msg = $("#msg_to_send").val();
    $.ajax({
        type: "POST",
        url: "include/send_msg.php",
        data: "msg=" + msg,
        success: function (html) {
            $("#msg_to_send").val('');
            console.log('Send msg success: ' + msg);
        },
        error: function (er1, er2, er3) {
            console.log(er1.responseText, er2, er3); //er1.responseText,er2,er3
        }
    });
}

function loadMsgs() {
    $.ajax({
        type: "POST",
        url: "include/load_msgs.php",
        timeout: 1000,
        data: "req=ok",
        // print php returned
        
        success: function (json) {
            $("#messages").empty();
            
            var response = JSON.parse(json);
            // var response = jQuery.parseJSON(json);
            //console.log(json, response);          
            for (var i in response) {
                insertMsg(response[i]['username'], response[i]['message'], response[i]['dateTimeJSON']);
                //console.log(i);
            }
            //$("#messages").scrollTop(90000);
            console.log('Load msgs success');
        },
        error: function (er1, er2, er3) {
            console.log(er1.responseText, er2, er3);
        }
    });
}

function askUsernameAndUpdate() {
    $.ajax({
        type: "POST",
        url: "include/ask_server.php",
        data: "req=ok",
        success: function (json) {
            sessionStorage.setItem('username', json);
            console.log("Username update success: ", json);
        },
        error: function (er1, er2, er3) {
            console.log(er1.responseText, er2, er3);
        }
    });
}

function setCaretPosition(elemId, caretPos) {
    var elem = document.getElementById(elemId);

    if (elem != null) {
        if (elem.createTextRange) {
            var range = elem.createTextRange();
            range.move('character', caretPos);
            range.select();
        }
        else {
            if (elem.selectionStart) {
                elem.focus();
                elem.setSelectionRange(caretPos, caretPos);
            }
            else
                elem.focus();
        }
    }
}

function enterHandler(e) {
    var text = $(this).val();
    if ((e.which == 13) && text.trim()) {
        sendMsg();
        askUsernameAndUpdate();
        insertMsg(sessionStorage.getItem('username'), text, JSON.stringify(new Date()));
        $(this).val('');
    }
}

function sendIconClickHandler(e) {
    console.log($(this).val());
    var text = $("#msg_to_send").val();
    if (text.trim()) {
        sendMsg();
        askUsernameAndUpdate();
        // insertMsg(sessionStorage.getItem('username'), text, JSON.stringify(new Date()));              
        insertMsg(sessionStorage.getItem('username'), text);

        $("#msg_to_send").val('');
    }
}

$("#msg_to_send").on("keyup", enterHandler);
$("#send_msg").on("click", sendIconClickHandler);

//console.log('dok is refreshed');
setCaretPosition('msg_to_send', 0);
setTimeout(askUsernameAndUpdate, 1000);
resetChat();
setTimeout(loadMsgs, 1000);//does not work. Function Call too fast? google.load is too slow so wait it termination first
setInterval(loadMsgs, 3000);//cyclic refresh messages //but this works
