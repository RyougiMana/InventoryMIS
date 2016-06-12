/**
 * Created by okamiji on 16/6/10.
 */

$(document).ready(function () {

    /* switch tabs */
    $(function () {
        $('#myTab li:eq(1) a').tab('show');
    });

    /* ajax post receipt item */
    //$("#receipt_add").click(function(){
    //    var commodity_name = document.getElementById('commodity_name').value;
    //    var commodity_count = document.getElementById('commodity_count').value;
    //    $.post("receipt/pending",
    //        {
    //            name: commodity_name,
    //            count: commodity_count
    //        },
    //        function(data){
    //            alert(data);
    //        });
    //});


    //$("#receipt_add").click(function(){
    //    var commodity_name = $("#commodity_name").val();
    //    var commodity_count = $("#commodity_count").val();
    //    $.ajax({
    //        url: "receipt/pending",
    //        type: 'POST',
    //        dataType: 'text',
    //        data:{'name': commodity_name, 'count': commodity_count},
    //        success:function(data){
    //            alert(data["result"]);
    //        },
    //        error:function(){
    //            alert("failed");
    //        }
    //    })
    //});
});