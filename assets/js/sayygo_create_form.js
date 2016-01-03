var login_or_new_acnt = $('input[name="login_or_new_acnt"]');

login_clicked = function(){
    login_or_new_acnt.val('1');
    $('#active_form_as_guest').submit();
};
create_acnt_clicked = function(){
    login_or_new_acnt.val('0');
    $('#active_form_as_guest').submit();

};

var cf = {};
cf.re = /#([A-Za-z0-9_\s\']+)#/g;
cf.keywords = {};

cf.getKeywords = function (url, re) {
    var match = {}, keywords = [];
    while (match = re.exec(url)) {
        keywords.push(match[1]);
    }
    return keywords;
};

var disable_btn = function (id) {
    var selector = $('#' + id);
    selector.attr('disable', true).addClass('disabled').removeClass('btn-success');
};
var enable_btn = function (id) {
    var selector = $('#' + id);
    selector.attr('disable', false).removeClass('disabled').addClass('btn-success');
};

//Watch #sayygo-full_text Enable the "Create" btn only when there is at least 1 keyword in this field #sayygo-full_text
var sft = $('#sayygo-full_text');
sft.on('keyup', function () {
    cf.keywords = cf.getKeywords($(this).val(), cf.re);
    var keywordsHtml = $('<div>');
    _.each(cf.keywords, function (e, i, l) {
        keywordsHtml.append($('<li>').addClass('select2-selection__choice').attr('title',e).html(e));
    });
    $('div.field-sayygo-keywordids ul.select2-selection__rendered').html(keywordsHtml.html());
    if (cf.keywords.length > 0){
        enable_btn('create_save_btn');
    }
});

$(document).ready(function () {
    var numOfPartners = $('div.field-sayygo-num_of_partner');
    var selectNumPartnerPref = $('#sayygo-partner_num_preference');
    setTimeout(function(){sft.trigger('keyup');},500);
    disable_btn('create_save_btn');
    selectNumPartnerPref.on('change',function(e){
        if (e.target.value === "2 to 10"){
            numOfPartners.removeClass('hidden');
        } else {
            numOfPartners.addClass('hidden');
            $(numOfPartners.children('input')).val(null);
        }

    });

    $('#create_save_btn').on("click", function (event, messages) {
        if (login_or_new_acnt.val() !== ""){
            return true;
        }
        event.preventDefault();
        $('#myModal').modal('show');
        return true;
    });

});

function submitHandler() {
    $('#w0').append("<input type='hidden' name='keywords' value='" +
    cf.keywords + "' />");
    return true;
}
