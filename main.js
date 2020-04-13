for (let x = 0; x <= 31; x++) {
    Date.prototype.subtractDays = function (days) {
        let date = new Date(this.valueOf());
        date.setDate(date.getDate() - days);
        return date;
    };
    let date = new Date();
    let day = date.subtractDays(x).toLocaleDateString("en-GB");
    let dayDynamicFrom = date.subtractDays(31).toLocaleDateString("en-GB");
    let dayDynamicTo = date.toLocaleDateString("en-GB");
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
                window.id = response.querySelectorAll('Valute')[y].attributes[0].value;
                $.post("db.php",
                    {
                        valute_id: window.id,
                        num_code: numCode,
                        char_code: charCode,
                        name: name,
                        value: value,
                        date: iso,
                    });
            }
                $.get(
                    'http://www.cbr.ru/scripts/XML_dynamic.asp?date_req1=' + dayDynamicFrom + '&date_req2=' + dayDynamicTo + '&VAL_NM_RQ=' + window.id,
                    function (data) {
                        for (let z = 0; z <= 18; z++) {
                            let resultDyn = data.getElementsByTagName('Record');
                            let dateDyn = resultDyn[z].attributes[0].value;
                            let idDyn = resultDyn[z].attributes[1].value;
                            let valueDyn = resultDyn[z].children[1].innerHTML;
                            $.post("db.php",
                                {
                                    valute_id_dyn: idDyn,
                                    value_dyn: valueDyn,
                                    date_dyn: dateDyn,
                                });
                        }
                    });
        });
}

























// for (let x = 0; x <= 31; x++) {
//     Date.prototype.subtractDays = function (days) {
//         let date = new Date(this.valueOf());
//         date.setDate(date.getDate() - days);
//         return date;
//     };
//     let date = new Date();
//     let day = date.subtractDays(x).toLocaleDateString("en-GB");
//     let dayDynamicFrom = date.subtractDays(31).toLocaleDateString("en-GB");
//     let dayDynamicTo = date.toLocaleDateString("en-GB");
//     let iso = date.subtractDays(x).toLocaleDateString("fr-CA");
//
//     $.ajaxPrefilter(function (options) {
//         if (options.crossDomain && jQuery.support.cors) {
//             let http = (window.location.protocol === 'http:' ? 'http:' : 'https:');
//             options.url = http + '//127.0.0.1:8080/' + options.url;
//         }
//     });
//     $.get(
//         'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' + day,
//         function (response) {
//             for (let y = 0; y <= 33; y++) {
//                 let result = response.getElementsByTagName('Valute')[y];
//                 let charCode = result.getElementsByTagName('CharCode')[0].innerHTML;
//                 let numCode = result.getElementsByTagName('NumCode')[0].innerHTML;
//                 let name = result.getElementsByTagName('Name')[0].innerHTML;
//                 let value = result.getElementsByTagName('Value')[0].innerHTML;
//                 let id = response.querySelectorAll('Valute')[y].attributes[0].value;
//                 $.get(
//                     'http://www.cbr.ru/scripts/XML_dynamic.asp?date_req1=' + dayDynamicFrom + '&date_req2=' + dayDynamicTo + '&VAL_NM_RQ=' + id,
//                     function (data) {
//                         for (let z = 0; z <= 18; z++) {
//                             let resultDyn = data.getElementsByTagName('Record');
//                             let dateDyn = resultDyn[z].attributes[0].value;
//                             let idDyn = resultDyn[z].attributes[1].value;
//                             let valueDyn = resultDyn[z].children[1].innerHTML;
//                             $.post("db.php",
//                                 {
//                                     valute_id: id,
//                                     num_code: numCode,
//                                     char_code: charCode,
//                                     name: name,
//                                     value: value,
//                                     date: iso,
//                                     valute_id_dyn: idDyn,
//                                     value_dyn: valueDyn,
//                                     date_dyn: dateDyn,
//                                 });
//                         }
//                     });
//             }
//         });
// }