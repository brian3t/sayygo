var login_or_new_acnt = $('input[name="login_or_new_acnt"]');
jQuery(document).ready(function($){
    $('#bucket_list_cr').on("click", function (event, messages) {
        if (login_or_new_acnt.val() !== ""){
            return true;
        }
        event.preventDefault();
        $('#myModal').modal('show');
        return true;
    });
});
login_clicked = function(){
    login_or_new_acnt.val('1');
    $('#active_form_as_guest').submit();
};
create_acnt_clicked = function(){
    login_or_new_acnt.val('0');
    $('#active_form_as_guest').submit();

};