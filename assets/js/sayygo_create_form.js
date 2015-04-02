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
sft.on('keypress', function () {
    cf.keywords = cf.getKeywords($(this).val(), cf.re);
    var keywordsHtml = $('<div>');
    _.each(cf.keywords, function (e, i, l) {
        keywordsHtml.append($('<span>').html(e));
    });
    $('#s2id_sayygo-keywordids .select2-search-field span').remove();
    $('#s2id_sayygo-keywordids .select2-search-field').append(keywordsHtml.html());
});

$(document).ready(function () {
    setTimeout(function(){sft.trigger('keypress');},500);
});

function submitHandler() {
    $('#w0').append("<input type='hidden' name='keywords' value='" +
    cf.keywords + "' />");
    return true;
}

