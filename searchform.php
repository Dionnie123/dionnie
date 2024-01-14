<form role="search" method="get" action="<?php echo esc_url(home_url('/')) ?>">


    <div class="input-group">
        <input class="form-control form-control-dark" type="search" name="s" placeholder="Search" value="<?php echo esc_attr(get_search_query()) ?>">



        <button class="btn btn-secondary clear" type="submit"> <i class="fa fa-search"></i> </button>
    </div>



</form>