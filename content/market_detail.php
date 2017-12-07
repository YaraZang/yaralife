
<main role="main">

        <div class="row featurette jumbotron">
          <div class="col-sm-12">
            <?php
             getMarketProductDetail();
             ?>
        </div>
      </div>
        <form action="./content/submitcomment.php" method="post">

          <div class="form-group col-sm-6 offset-sm-3">

            <label>How do you like this product? Please tell us!</label>
            <div class="rating" style="float: right;">
              <span class="glyphicon glyphicon-star"></span>
              <span class="glyphicon glyphicon-star"></span>
              <span class="glyphicon glyphicon-star"></span>
              <span class="glyphicon glyphicon-star"></span>
              <span class="glyphicon glyphicon-star-empty"></span>
            </div>
            <textarea rows="5" cols="2" class="form-control" name="comment" required>
            </textarea>
            <?php
                getHiddenInfo();
             ?>
            <br>
            <button type="submit" name="commentsubmit" style="float: right;" class="btn btn-primary">Submit</button>
          </div>

        </form>



</main>
