/**
 * Created by okamiji on 16/6/17.
 */

function makeComparison() {
    var id = document.getElementsByName('check_commodity');
    var value = new Array();
    for (var i = 0; i < id.length; i++) {
        if (id[i].checked)
            value.push(id[i].value);
    }
    window.location = '/mis/commodity/comparison/make/' + value.toString();
}
