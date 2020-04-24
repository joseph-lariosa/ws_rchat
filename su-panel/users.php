<div class="form-group">
          <div class="input-group">
            <span class="input-group-addon btn btn-info">Search</span>
            <input type="text" name="search_text" id="search_text" placeholder="Search user" class="form-control" />
          </div>
      </div>

      <div id="result"></div>

      <script>
              
      jQuery(function ($) {


      $(document).ready(function() {

        load_data();

        function load_data(query) {
          $.ajax({
            url: "fetch.php",
            method: "POST",
            data: {
              query: query
            },
            success: function(data) {
              $('#result').html(data);
            }
          });
        }
        $('#search_text').keyup(function() {
          var search = $(this).val();
          if (search != '') {
            load_data(search);
          } else {
            load_data();
          }
        });
      });

    });

      </script>

   