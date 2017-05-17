jQuery(document).ready(function(){
    function create_dd(v){
        //create dropdown
        var dd = jQuery('<select class="custom_class"></select>');
        //create dropdown options
        //array with the options you want
        var classes = ["single-column","single-column dropleft","two-column","two-column dropleft"];
        jQuery.each(classes, function(i,val) {
            if (v == val){
                dd.append('<option value="'+val+'" selected="selected">'+val+'</option>');
            }else{
                dd.append('<option value="'+val+'">'+val+'</option>');
            }
        });
        return dd;
    }

    jQuery(".edit-menu-item-classes").each(function() {
        //add dropdown
        var t = create_dd(jQuery(this).val());
        jQuery(this).before(t);
        //hide all inputs
        jQuery(this).css("display","none");

    });
    //update input on selection
    jQuery(".custom_class").bind("change", function() {
        var v = jQuery(this).val();
        var inp = jQuery(this).next();
        inp.attr("value",v);
    });
});