function Bootstrap(){
    var engine = new Bloodhound({
        remote: {
            url: 'http://www.torrent-hunter.com/api/v1/search?query=%QUERY&offset=0&limit=10',
            filter: function(resp){
                return resp.torrents.map(function(t){
                    return {
                        value: t.title
                    }
                })
            }
        },
        datumTokenizer: function(d) {
            return Bloodhound.tokenizers.whitespace('value');
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });
    var promise = engine.initialize();
    promise.done(function(){
        $('.typeahead').typeahead(
            {
                highlight: true,
                hint: false
            },
            {
                displayKey: 'value',
                source: engine.ttAdapter()
            });
        $('.twitter-typeahead').addClass(function(){
            return 'small-12';
        });
        $('.tt-dropdown-menu').addClass(function(){
            return 'large content f-dropdown small-12';
        });
    });
}
