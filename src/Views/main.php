<?php
?>
<div class="container">
  <h1 style="text-align: center;margin: 20px 0px 20px;">Search App</h1>
  <form action="/search">
    <div class="form-group row">
      <label for="inputKeyword" class="col-sm-2 col-form-label">Keywords</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputKeyword" name="keyword" value="<?=$_REQUEST['keyword']??''?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="inputURL" class="col-sm-2 col-form-label">URL to match</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="inputURL" name="url" value="<?=$_REQUEST['url']??''?>">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </form>
</div>

