function googleTranslateElementInit(){
    new google.translate.TranslateElement({pageLanguage:'vi', includedLanguages: 'en,vi', autoDisplay:false},'google_translate_element');
}
function GTranslateGetCurrentLang() {
    var keyValue = document['cookie'].match('(^|;) ?googtrans=([^;]*)(;|$)');
    return keyValue ? keyValue[2].split('/')[2] : null;
}
function GTranslateFireEvent(element, event) {
    try {
        if (document.createEventObject) {
            var evt = document.createEventObject();
            element.fireEvent('on' + event, evt)
        } else {
            var evt = document.createEvent('HTMLEvents');
            evt.initEvent(event, true, true);
            element.dispatchEvent(evt)
        }
    } catch (e) {}
}
function doGTranslate(lang_pair) {
    if (lang_pair.value) lang_pair = lang_pair.value;
    if (lang_pair == '') return;
    var lang = lang_pair.split('|')[1];
    if (GTranslateGetCurrentLang() == null && lang == lang_pair.split('|')[0]) return;
    var teCombo;
    var sel = document.getElementsByTagName('select');
    for (var i = 0; i < sel.length; i++)
        if (/goog-te-combo/.test(sel[i].className)) {
            teCombo = sel[i];
            break;
        }
        if (document.getElementById('google_translate_element') == null || document.getElementById('google_translate_element').innerHTML.length == 0 || teCombo.length == 0 || teCombo.innerHTML.length == 0) {
            setTimeout(function() {
                doGTranslate(lang_pair)
            }, 500)
        } else {
            teCombo.value = lang;
            GTranslateFireEvent(teCombo, 'change');
            GTranslateFireEvent(teCombo, 'change')
        }
    }