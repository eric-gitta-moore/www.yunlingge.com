define(function(require){
    var o={};
    o.execute = function(domid){
		require("./grid").init('grid-div');
    };
    return o;
});
