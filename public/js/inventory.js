/**
 * Created by okamiji on 16/6/6.
 */
$(document).ready(function () {
    /* show & hide commodity classifications */
    var isHidden = false;
    $(".classification").click(function () {
        if (!isHidden) {
            $(".commodity").slideUp();
            isHidden = true;
        }
        else {
            $(".commodity").slideDown();
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

    /* text area reset */
    $(".reset").click(function () {
        $(".classification-input").innerText = "";
    });

    $(".commodity-detail").click(function () {
        $
    });


});

