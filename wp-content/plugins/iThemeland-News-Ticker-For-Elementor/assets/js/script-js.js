jQuery(document).ready(function($){
    function getdate(){
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();


        if(m<10){
            m = "0"+m;
        }

        $(".itnt-hour").html(h);
        setTimeout(function(){getdate()}, 500);

        $(".itnt-min").html(m);
        setTimeout(function(){getdate()}, 500);

    }
    getdate();
});