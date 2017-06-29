   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
   
    function GetSuggestions(input_id, table) {
        
    $('#'+input_id).select2({
           // theme: "bootstrap",
            minimumInputLength: 1,
            ajax: {
                url: '/suggest',
                dataType: 'json',
                data: function (params) {
                    return {
                        q: $.trim(params.term),
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


        
    </script>