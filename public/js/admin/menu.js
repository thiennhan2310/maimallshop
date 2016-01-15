/**
 * Created by Thien Nhan on 1/14/2016.
 */
$("document").ready(function () {
    var currentUrl = window.location.href;
    var array = currentUrl.split("/");
    var controller=array[5]; //product
    var action=array[6];
    switch (controller) {
        case "product" :
            $("ul.sidebar-menu>li:nth-child(2)").addClass("active");
            if (action == "list") $("ul.treeview-menu>li:nth-child(1)").addClass("active");
            else  $("ul.treeview-menu>li:nth-child(2)").addClass("active");
            break;

    }
});