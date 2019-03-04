<!-- This is the search form -->
<form method="GET">
    <div class="form-group row">
        <div class="col-lg-1">
            <label for="search_field" class="col-lg-1 col-form-label">Search: </label>
        </div>
        <div class="col-lg-3">
            <input name="search_field" value="<?php echo $search; ?>" class="form-control" placeholder="Any relevant keywords"/>
        </div>
        <div class="form-group text-center text-center">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </div>
</form>