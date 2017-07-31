   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>

    function GetSuggestions(input_id,showingCol,table) {

    $('#'+input_id).select2({
           // theme: "bootstrap",
            minimumInputLength: 1,
            ajax: {
                url: '/suggest',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term),
                        c:showingCol,
                        t:table
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function(obj)
                        {
                             return { id: obj.id, text: obj.value };
                        })
                    };
                },
                cache: true
            }
        });


}

    function GetSingleValue (input_id,column,table,output_device) {
      var data;
      $.ajax({
          type:'GET',
          url: '/GetSingleValue',
          data:"?q="+input_id+"&c="+column+"&t="+table,
          success:function(data){
              $(output_device).val(data);
              $(output_device).html(data);
          }
      });
    }

    function GetLatestPrice(item_id,output_device) {
      var data;
      $.ajax({
          type:'GET',
          url: '/GetLatestPrice',
          data:"q="+item_id,
          success:function(data){
              $(output_device).val(data);
              $(output_device).html(data);
          }
      });
    }

    function getStoreQuantitiy (item_id,output_device) {

        $.ajax({
            type:'GET',
            url: '/checkquantity',
            data:'q='+item_id,
            success:function(data){

                $(output_device).val(data);
                $(output_device).html(data);
                return parseInt(data);
            }
        });
    }



    </script>
