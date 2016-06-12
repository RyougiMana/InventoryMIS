/**
 * Created by okamiji on 16/6/12.
 */
$(document).ready(function () {
    /* show & hide commodity classifications */
    var isHidden = true;
    $("#open").click(function () {
        if (!isHidden) {
            $(".commodity").slideUp();
            isHidden = true;
            document.getElementById('open').innerHTML = "展开分类";
        }
        else {
            $(".commodity").slideDown();
            isHidden = false;
            document.getElementById('open').innerHTML = "收起分类";
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

    /* get commodity or its parent's is and information */
    $(".commodity").click(function () {
        document.getElementById('commodity_name').setAttribute("value", $(this).text());
    })

});
