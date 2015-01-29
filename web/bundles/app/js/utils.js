function Utils(){
    return {
        stylingPagination: function(){
            var previous = 1;
            $(".pagination li:not('.arrow')").each(function(index){
                var current = parseInt($(this).find("a").html());
                if(current > (previous + 1)){
                    console.log($(this))
                    $(this).prepend('<a href="/">&hellip;</a>')
                    console.log('current ' + current)
                }
                previous = current;
            });
        },
        setCurrentPage: function(current){
            $(".pagination li:not('.arrow')").removeClass("current");
            $(".pagination li:not('.arrow')").each(function(index){
                if($(this).find("a").html() == current){
                    $(this).addClass("current");
                    return;
                }
            });
        }
    }
}
