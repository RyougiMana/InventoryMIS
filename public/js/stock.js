/**
 * Created by okamiji on 16/5/20.
 */
$(document).ready(function () {
    /* show & hide commodity classifications */
    var isHidden = false;
    $(".classification").click(function () {
        if (!isHidden) {
            $(".commodity").hide();
            isHidden = true;
        }
        else {
            $(".commodity").show();
            isHidden = false;
        }
    });

    /* change color when mouse enter the list */
    $(".classification").hover(function () {
        $(this).addClass("blue");
    }, function () {
        $(this).removeClass("blue");
    });
    $(".commodity").hover(function () {
        $(this).addClass("gray");
    }, function () {
        $(this).removeClass("gray");
    });

    /* modify and delete */
    $(".modify").click(function () {

    });

});

