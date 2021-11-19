$(document).ready(function() {
    // var dataRolescard = getDataRoleCard();
    // console.log(`$('.card.card-role')`, $('.card.card-role'));
    // $('.card.card-role').on('click', clickRoleCard)

});

function clickRoleCard() {
    console.log(this);

}

function openNewTab(url) {
    var win = window.open(url, '_blank');
    win.focus();
}