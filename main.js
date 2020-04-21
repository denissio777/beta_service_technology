let arr = [];
function getDaily() {
    for (let x = 0; x <= 31; x++) {
        Date.prototype.subtractDays = function (days) {
            let date = new Date(this.valueOf());
            date.setDate(date.getDate() - days);
            return date;
        };
        let date = new Date();
        let day = date.subtractDays(x).toLocaleDateString("en-GB");
        window.dayDynamicFrom = date.subtractDays(31).toLocaleDateString("en-GB");
        window.dayDynamicTo = date.toLocaleDateString("en-GB");
        let iso = date.subtractDays(x).toLocaleDateString("fr-CA");

        $.ajaxPrefilter(function (options) {
            if (options.crossDomain && jQuery.support.cors) {
                let http = (window.location.protocol === 'http:' ? 'http:' : 'https:');
                options.url = http + '//127.0.0.1:8080/' + options.url;
            }
        });

        $.get(
            'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' + day,
            function (response) {
                for (let y = 0; y <= 33; y++) {
                    let result = response.getElementsByTagName('Valute')[y];
                    let charCode = result.getElementsByTagName('CharCode')[0].innerHTML;
                    let numCode = result.getElementsByTagName('NumCode')[0].innerHTML;
                    let name = result.getElementsByTagName('Name')[0].innerHTML;
                    let value = result.getElementsByTagName('Value')[0].innerHTML;
                    let id = response.querySelectorAll('Valute')[y].attributes[0].value;
                    arr.push(id);
                    $.post("./model/db_daily.php",
                        {
                            valute_id: id,
                            num_code: numCode,
                            char_code: charCode,
                            name: name,
                            value: value,
                            date: iso,
                        });
                }

            });
    }
    $('#dynamic').css('display', '');
}

function getDynamic() {
    let _id = arr.slice(0, 33);
    for (let v = 0; v <= 32; v++) {
        let idd = _id.shift();
        $.get(
            'http://www.cbr.ru/scripts/XML_dynamic.asp?date_req1=' + window.dayDynamicFrom + '&date_req2=' + window.dayDynamicTo + '&VAL_NM_RQ=' + idd,
            function (data) {
                for (let z = 0; z <= 31; z++) {
                    let resultDyn = data.getElementsByTagName('Record');
                    let dateDyn = resultDyn[z].attributes[0].value;
                    let idDyn = resultDyn[z].attributes[1].value;
                    let valueDyn = resultDyn[z].children[1].innerHTML;
                    $.post("./model/db_dynamic.php",
                        {
                            valute_id: idd,
                            valute_id_dyn: idDyn,
                            value_dyn: valueDyn,
                            date_dyn: dateDyn,
                        });
                }
            });
    }
}

function request() {
    let valuteID = $('#valuteID').val();
    let dateTo = $('#dateTo').val();
    let dateFrom = $('#dateFrom').val();
    $.get('./model/the_best_db.php?valute_id=' + valuteID + '&date_to=' + dateTo + '&date_from=' + dateFrom,
        function (response) {
            $('#table').css('display', '');
            for (let n = 0; n <= 33; n++) {
                let resDate = (response[n].date);
                let resChar = (response[n].char_code);
                let resNum = (response[n].num_code);
                let resName = (response[n].name);
                let resValue = (response[n].value);

                let nodeForNum = document.createElement("p");
                let textNodeForNum = document.createTextNode(resNum);
                nodeForNum.appendChild(textNodeForNum);
                document.getElementById("forNum").appendChild(nodeForNum);

                let nodeForChar = document.createElement("p");
                let textNodeForChar = document.createTextNode(resChar);
                nodeForChar.appendChild(textNodeForChar);
                document.getElementById("forChar").appendChild(nodeForChar);

                let nodeForDate = document.createElement("p");
                let textNodeForDate = document.createTextNode(resDate);
                nodeForDate.appendChild(textNodeForDate);
                document.getElementById("forDate").appendChild(nodeForDate);

                let nodeForName = document.createElement("p");
                let textNodeForName = document.createTextNode(resName);
                nodeForName.appendChild(textNodeForName);
                document.getElementById("forName").appendChild(nodeForName);

                let nodeForValue = document.createElement("p");
                let textNodeForValue = document.createTextNode(resValue);
                nodeForValue.appendChild(textNodeForValue);
                document.getElementById("forValue").appendChild(nodeForValue);

            }
        });
}